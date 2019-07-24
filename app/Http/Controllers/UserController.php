<?php

namespace App\Http\Controllers;

use App\Traits\UploadTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use UploadTrait;

    public function getAll()
    {

        $user = User::paginate(config('constant.pagintion.page'));
        User::paginate();
        $elements = User::all();
//        dd( User::paginate());
        return view('user.manager_user.index', compact('user', 'elements'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('user.manager_user.edit', compact('user'));
    }

    public function post($id, Request $request)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
//        $user->active_flg=strcasecmp($request->active,"Hoạt Động")?'1':'0';
//        $user->role_id=$request->role=="Admin"?'1':'2';
        $user->save();
        return redirect('user');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->active_flg = config('constant.UNACTIVE');
        $user->save();
        return redirect('/');
    }

    public function profile()
    {

        $user = Auth::user();
        return view('user.profile.index', compact('user'));
    }

    public function search(Request $request)
    {
        Session::put('name', $request->name);
        Session::put('email', $request->email);
        Session::put('role', $request->role);
        if($request->active==config('constant.VALUE')){
            Session::put('active',config('constant.UNACTIVE'));
        }else{
            Session::put('active',$request->active);
        }
        $users = DB::table('users')->where([['name', 'like', '%' . Session::get('name') . '%'],
            ['email', 'like', '%' . Session::get('email') . '%'],
            ['role_id', 'like', '%' . Session::get('role') . '%'],
            ['active_flg', 'like', '%' . Session::get('active') . '%']])->paginate(config('rules.pagintion.page'));
        $users->appends(['name' => Session::get('name'), 'email' => Session::get('email'), 'role' => Session::get('role'), 'active' => Session::get('active')]);
        return view('user.manager_user.index', ['user' => $users]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postProfile(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:20',
            'email' => 'required|email',
            'address' => 'required',
            'profile_image' => 'required|image|mimes:png,jpg,gif|max:2048'

        ]);

        if ($validator->fails()) {
            if ($request->has('profile_image') && $validator->errors()->get('profile_image')) {
                $image = $request->file('profile_image');
                $name = 'Fail' . '_' . time();
                $folder = 'uploads/fails_images/';
                $this->uploadOne($image, $folder, 'public', $name);
                return redirect()->back()->withInput()->withErrors($validator->errors()->all());

            } elseif ($request->has('profile_image') && !$validator->errors()->get('profile_image')) {
                $image = $request->file('profile_image');
                $name = str_slug($request->input('name')) . '_' . time();
                $folder = '/uploads/images/';
                $this->uploadOne($image, $folder, 'public', $name);
                Session::put('name', $name . '.' . $image->guessClientExtension());
                return redirect()->back()->with('data', Session::get('name'))
                    ->withErrors($validator->errors()->all())->withInput();
            } else if (!$request->has('profile_image')) {
                if ($request->name == '' || $request->email == '' || $request->address == '') {
                    return view('user.profile.index', compact('user'))->withErrors($validator);
                } else {
                    $data = $request->session()->get('name');

                    if (!empty($data)) {
                        $folder = '/uploads/images/';
                        $user->profile_image = $folder . $data;
                        $user->name = $request->name;
                        $user->email = $request->email;
                        $user->address = $request->address;
                        $user->save();
                        return redirect()->back()->with('data', Session::get('name'));
                    } else {
                        $user->name = $request->name;
                        $user->email = $request->email;
                        $user->address = $request->address;
                        $user->save();
                        return redirect()->back()->withInput()->withErrors([$validator->errors()->get('name'), $validator->errors()->get('email'), $validator->errors()->get('address')]);
                    }
                }
            }
        } else {
            $image = $request->file('profile_image');
            $folder = '/uploads/images/';
            $name = str_slug($request->input('name')) . '_' . time();
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->address = $request->address;
            $user->profile_image = $filePath;
            $user->save();
            return redirect()->back();
        }
//
    }
}


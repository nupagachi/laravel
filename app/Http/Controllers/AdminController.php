<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateStoreRequest;
use App\User;
use Dotenv\Regex\Result;
use Hash;
use Auth;
use App\Traits\UploadTrait;
use http\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Validation;



class AdminController extends Controller
{
    use UploadTrait;

//    public function index(Request $request){
//        if (is_post()) {
//            return $this->_indexPost($request);
//        }
//        return $this->_indexGet($request);
//    }

//    public function edit(Request $request){
//        if (is_post()) {
//            return $this->_editPost($request);
//        }
//        return $this->_editGet($request);
//    }

//    public function create(Request $request){
//        if (is_post()) {
//            return $this->_editPost($request);
//        }
//        return $this->_editGet($request);
//    }

    public function getAll()
    {
        $user = User::paginate(config('constant.pagintion.page'));
        return view('admin.manager_admin.index', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        Session::put('url', url()->previous());
        return view('admin.manager_admin.edit', compact('user'));
    }

    public function post($id, Request $request)
    {
        //dd($request->cookie('uCookie'));
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        if ($request->has('profile_image')) {
            $image = $request->file('profile_image');
            $name = str_slug($request->input('name')) . '_' . time();
            $folder = '/uploads/images/';
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
            $user->profile_image = $filePath;
        }
        $user->save();
        $url = Session::get('url');

        return redirect($url);
    }

    public function create()
    {
        return view('admin.manager_admin.create');
    }

    public function store(Request $request)
    {
        $validate=new Validation();
        $validator = Validator::make($request->all(),$validate->rule() ,$validate->messeger());
        if ($validator->fails()) {
             if ($request->has('profile_image') && $validator->errors()->get('profile_image')) {
                Session::forget('name');
                $image = $request->file('profile_image');
                $name = 'Fail' . '_' . time();
                $folder = 'uploads/fails_images/';
                $this->uploadOne($image, $folder, 'public', $name);
                return redirect()->back()
                    ->withInput()
                    ->with('data', $name . '.' . $image->getClientOriginalExtension())
                    ->withErrors($validator->errors()->get('profile_image'));
            } else if ($request->has('profile_image') && !$validator->errors()->get('profile_image')) {
                $image = $request->file('profile_image');
                $folder = '/uploads/fails_images/';
                $name = 'Fail' . '_' . time();
                //$filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                $this->uploadOne($image, $folder, 'public', $name);
                Session::put('name1', $name . '.' . $image->guessClientExtension());
                return redirect()->back()
                    ->withInput()
                    ->with('data', $name . '.' . $image->guessClientExtension())
                    ->withErrors($validator->errors());
            } else if (!$request->has('profile_image')) {
                $name = Session::get('name1');
                return redirect()->back()->with('data', $name)->withInput()
                    ->withErrors($validator->errors());
            }
            return back()->withInput()->withErrors($validator->errors());
        } else {
            $image = $request->file('profile_image');
            $folder = '/uploads/images/';
            $name = str_slug($request->input('name')) . '_' . time();
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('$request->password'),
                'address' => $request->address,
                'active_flg' => $request->active,
                'role_id' => $request->role,
                'profile_image' => $filePath
            ];
            User::create($data);
            Mail::send('emails.mail', $data, function ($message) {
                $user = User::where('role_id', config('constant.ROLE_ADMIN'))->get();
                foreach ($user as $user) {
                    $message->to($user->email);
                }
                $message->subject('Đăng kí thành viên');
                $message->from('nhucanh.paraline@gmail.com', 'Cảnh ParalineSS');
            });
            return redirect()->back();
        }
    }

    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }

    public function postProfile(Request $request)
    {
        $request->session()->flash('nameP',$request->name);
                $request->session()->flash('emailP',$request->email);
                $request->session()->flash('addressP',$request->address);

        $user = \Illuminate\Support\Facades\Auth::user();
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
                return redirect()->back()->withErrors($validator->errors()->all());

            } elseif ($request->has('profile_image') && !$validator->errors()->get('profile_image')) {
                $image = $request->file('profile_image');
                $name = str_slug($request->input('name')) . '_' . time();
                $folder = '/uploads/images/';
                $this->uploadOne($image, $folder, 'public', $name);
                Session::put('name1', $name . '.' . $image->guessClientExtension());
                return redirect()->back()->withInput()
                ->with('data', Session::get('name1'))
                    ->withErrors($validator->errors());
            } else if (!$request->has('profile_image')) {
                if ($request->name == '' || $request->email == '' || $request->address == '') {
                    return view('admin.profile.index')->withErrors($validator->errors());
                } else {
                    $data = $request->session()->get('name1');
                    if (!empty($data)) {
                        $folder = '/uploads/images/';
                        $user->profile_image = $folder . $data;
                        $user->name = $request->name;
                        $user->email = $request->email;
                        $user->address = $request->address;
                        $user->save();
                        return redirect()->back()->withInput()->with('data', Session::get('name1'));
                    } else {
                        $user->name = $request->name;
                        $user->email = $request->email;
                        $user->address = $request->address;
                        $user->save();
                        return redirect()->back()->withErrors([$validator->errors()->get('name'), $validator->errors()->get('email'), $validator->errors()->get('address')]);
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
            ['active_flg', 'like', '%' . Session::get('active') . '%']])->paginate(config('constant.pagintion.page'));
        $users->appends(['name' => Session::get('name'), 'email' => Session::get('email'), 'role' => Session::get('role'), 'active' => Session::get('active')]);
        return view('admin.manager_admin.index', ['user' => $users]);

    }

}

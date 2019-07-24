<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
define('TIME_REMEBER',60 * 24 * 30);
define('TIMECOOKIE',20);
define('TIME_OUT',3600);
class LoginController extends Controller
{

    public function login(Request $request)
    {

        $data = [
            'name' => $request->username,
            'password' => $request->password,
            'active_flg' => config('constant.ACTIVE'),
        ];
        $remeber_me = $request->remeber;
        $username = $request->username;
        $password = $request->password;
        if (Auth::attempt($data)) {
            if ($remeber_me) {
                Cookie::queue('uCookie', $username, TIME_REMEBER);
                Cookie::queue('pCookie', $password, TIME_REMEBER);
            } else {
                Cookie::queue('uCookie', $username, TIMECOOKIE);
                Cookie::queue('pCookie', $password, TIMECOOKIE);
            }

//            isAdmin()
//                isSuperAdmin

            $role_id = Auth::user()->role_id;
            if ($role_id == config('constant.ROLE_ADMIN')) {
                return redirect('admin');
            } else {
                return redirect('user');
            }
        } else {
            dd($data);
        }
    }

    public function logout()
    {
        setcookie('uCookie', '', time() - TIME_OUT);
        setcookie('pCookie', '', time() - TIME_OUT);
        Auth::logout();
        return redirect('/');
    }

    public function index()
    {
        return view('login.register');
    }

//    public function create(Request $request)
//    {
//
//        $data = [
//            'name' => $request->name,
//            'email' => $request->email,
//            'password' => $request->password,
//            'address' => $request->address,
//            'role_id' => $request->role,
//            'active_flg' => $request->active,
//        ];
//
//        Mail::send('emails.mail', $data, function ($message) {
//            $user = User::where('role_id', 1)->get();
//            foreach ($user as $user) {
//                $message->to($user->email);
//            }
//            $message->subject('Đăng kí thành viên');
//            $message->from('nhucanh.paraline@gmail.com', 'Cảnh ParalineSS');
//        });
//        Session::flash('flash_message', 'Send message successfully!');
//        return view('login.index');
//    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;

class UserController extends Controller{

    public function getLogin(){
      return view('public.login');
    }

    public function postLogin(Request $request){
        $this->validate($request, [
            'username' => 'required | alpha_spaces',
            'password' => ['required', 'min: 4' , 'max: 50', 'regex:  /^[a-zA-Z0-9!@#\$\^\&*\)\(._-]+$/' ]
        ]);

        if(!Auth::attempt(['username' => $request->username, 'password' => $request->password])){
            return response()->JSON([ 'fail' => 'نام کاربری یا رمزعبور اشتباه است' ]);
        }

        return redirect()->route('get_home');
    }

    public function getRegister(){
        return view('public.register');
    }

    public function postRegister(Request $request){
        $this->validate($request, [
            'fname' => 'required | alpha_spaces',
            'lname' => 'required | alpha_spaces',
            'username' => 'required | alpha_spaces',
            'password' => ['required', 'min: 4' , 'max: 50', 'regex:  /^[a-zA-Z0-9!@#\$\^\&*\)\(._-]+$/', 'confirmed'],
            'password_confirmation' => ['required', 'min: 4' , 'max: 50', 'regex:  /^[a-zA-Z0-9!@#\$\^\&*\)\(._-]+$/'],
            'email' => 'required | email'
        ]);

        $user = new User();
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = "member";
        $user->save();

        Auth::login($user);

        return redirect()->route('get_home');
    }

    public function getHome(){
        return view('user.home', [ 'user' => Auth::user() ]);
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->route('get_login');
    }
}

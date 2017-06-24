<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;

class UserController extends Controller{

    public function getLogin(){
      return view('user.login');
    }

    public function postLogin(Request $request){
        $this->validate($request, [
            'username' => 'alpha_spaces',
            'password' => ['required', 'min: 4' , 'max: 50', 'regex:  /^[a-zA-Z0-9!@#\$\^\&*\)\(._-]+$/' ]
        ]);

        if(!Auth::attempt(['username' => $request->username, 'password' => $request->password])){
            return response()->JSON([ 'fail' => 'نام کاربری یا رمزعبور اشتباه است' ]);
        }

    }
}

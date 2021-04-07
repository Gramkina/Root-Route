<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller{

    public function login(Request $request){
        $data = $request->all();
        try {
            if (Auth::attempt(['login' => $data['login'], 'password' => $data['password']]))
                return ['status' => 1, 'url' => route('navigation.home')];
            else
                return ['status' => 0, 'errors' => ['Неправильный логин и/или пароль']];
        }
        catch(\Exception $exception) {
            return ['status' => 0, 'errors' => ['Ошибка на сервере']];
        }
    }

    public function logout(){
        Auth::logout();
        return route('navigation.login');
    }

}

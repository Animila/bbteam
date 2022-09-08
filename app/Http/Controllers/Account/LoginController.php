<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'remember'=>''
        ]);
        $yes = isset($credentials['remember']);
        unset($credentials['remember']);

        if (Auth::attempt($credentials, $yes)) {
            $request->session()->regenerate();
            return [
                'status'=>True,
            ];
        } else {
            return [
                'status'=>False,
                'error'=>'Ошибка авторизации. Проверьте логин или пароль'
            ];
        }
    }
}

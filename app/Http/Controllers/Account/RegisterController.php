<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed'],
            'nickname' => ['required'],
            'name' => ['required'],
            'gender' => ['required'],
        ]);
        $request->validateWithBag('error', [
            'email.required' => 'Нет поля почты',
            'email.email' => 'В поле не почта',
            'email.unique' => 'Не уникальное значение',
            'password.required' => 'Нет пароля',
            'password.confirmed' => 'Нет подтверждения пароля',
            'nickname.required' => 'Нет никнейма',
            'name.required' => 'Нет имени',
            'gender.required' => 'Нет пола',
        ]);
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        if ($user) {
            $token = $user->createToken('authToken')->plainTextToken;
            $response = [
                'user'=>$user,
                'token'=>$token
            ];
            return response($response, 201);
        }
        return response([
            'error'=>'Ошибка регистрации'
        ], 400);
    }
}

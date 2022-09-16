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
            'email' => ['required', 'email'],
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
        if(User::where('email', $data['email'])->first() != null) {
            return [
                'status'=>false,
                'type'=>'email',
                'error'=>'Данная почта уже используется'
            ];
        }
        if(User::where('nickname', $data['nickname'])->first() != null) {
            return [
                'status'=>false,
                'type'=>'nickname',
                'error'=>'Данный никнейм уже занят'
            ];
        }
        $user = User::create($data);
        if ($user) {
            $token = $user->createToken('authToken')->plainTextToken;
            $response = [
                'status'=>true,
                'user'=>$user,
                'token'=>$token
            ];
            return response($response, 201);
        }
        return response([
            'status'=>false,
            'error'=>'Ошибка регистрации'
        ], 400);
    }
}

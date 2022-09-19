<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UpdatePasswordController extends Controller
{
    public function __invoke(Request $request, User $user)
    {

        $validate = Validator::make($request->all(), [
            'old_password'=>'',
            'password'=>'required|confirmed'
        ],[
            'password.confirmed' => 'Подтвердите пароль',
            'password.required' => 'Нет пароля'
        ] );

        if ($validate->fails()) {
            return redirect()->route('users.edit', $user->id)
                ->withErrors($validate)
                ->withInput();
        }
        $data = $validate->validated();

        if (Hash::check($data['old_password'], $user->password)) {
            unset($data['old_password']);
            auth()->user()->update([
                'password'=> Hash::make($data['password'])
            ]);
            return [
                'status'=>true,
            ];
        }
        return [
            'status'=>false,
            'error'=>'Неправильный пароль'
        ];

    }
}

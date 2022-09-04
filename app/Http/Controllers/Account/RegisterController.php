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
        $data['password'] = Hash::make($data['password']);
        if (User::create($data)) {
            return redirect('/');
        }
        return back(403, 'ошибка');
    }
}

<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function __invoke($provider)
    {
            $social_user = Socialite::driver($provider)->user();
            $user = $this->findOrCreateUser($provider, $social_user);
            Auth::login($user);
            return redirect()->route('main');

    }


    private function findOrCreateUser($provider, $social_user)
    {

        //если аккаунт был уже зареган на пользователя, возвращаем его
        if ($user = $this->findUserBySocialId($provider, $social_user->getId())) {return $user;}

        // если почта уже существует в базе данных, то добавляем запись в базу и возвращаем пользователя
        if ($user = $this->findUserByEmail($social_user->getEmail())) {
            $this->addSocialAccount($provider, $user, $social_user);

            return $user;
        }

        //создаем пользователя
        $user = User::create([
            'nickname' => $social_user->getNickname(),
            'name' => $social_user->getName(),
            'email' => $social_user->getEmail(),
            'gender'=>'не указано',
            'password' => '',
        ]);

        $this->addSocialAccount($provider, $user, $social_user);

        return $user;
    }

    public function findUserBySocialId($provider, $id)
    {
        $socialAccount = SocialAccount::where('provider', $provider)->where('provider_id', $id)->first();
        return $socialAccount ? $socialAccount->user : false;
    }

    public function findUserByEmail($email){return !$email ? null : User::where('email', $email)->first();}

    public function addSocialAccount($provider, $user, $socialiteUser)
    {
        SocialAccount::create([
            'user_id' => $user->id,
            'provider' => $provider,
            'provider_id' => $socialiteUser->getId(),
            'token' => $socialiteUser->token,
        ]);
}
}

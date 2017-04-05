<?php

namespace Myrtle\Core\Users\Auth;

use Illuminate\Support\Facades\Auth;

use Laravel\Socialite\SocialiteManager as LaravelSocialiteManager;

class SocialiteManager extends LaravelSocialiteManager
{
    public static function execute()
    {
        return Auth::attempt(request()->only('email', 'password'), request()->has('remember'));
    }
}
<?php

namespace Myrtle\Core\Users\Policies;

use App\User;
use Pseudo\Auth\Guest;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuthenticationPolicy
{
    use HandlesAuthorization;

    public function login(User $auth)
    {
        return $auth instanceof Guest;
    }

    public function logout(User $auth)
    {
        return ! $this->login($auth);
    }
}

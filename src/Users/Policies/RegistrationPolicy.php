<?php

namespace Myrtle\Core\Users\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Pseudo\Auth\Guest;

class RegistrationPolicy
{
    use HandlesAuthorization;

    public function register(User $user)
	{
		return $user instanceof Guest && (bool) config('docks.users.registration', false);
	}
}

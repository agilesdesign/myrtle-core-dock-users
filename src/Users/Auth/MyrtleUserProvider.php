<?php

namespace Myrtle\Core\Users\Auth;

use Myrtle\Core\Users\Models\UserEmail;
use Illuminate\Auth\EloquentUserProvider;

class MyrtleUserProvider extends EloquentUserProvider
{
	public function retrieveByCredentials(array $credentials)
	{
		if (empty($credentials))
		{
			return;
		}

		$email = UserEmail::where('address', $credentials['email'])->first();

		if (is_null($email) || $email->user->disabled_at)
		{
			return;
		}

		return $email->user;
	}
}
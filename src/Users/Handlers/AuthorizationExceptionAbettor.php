<?php

namespace Myrtle\Core\Users\Handlers;

use Exception;
use Flasher\Support\Notifier;
use Exceptum\Contracts\Abettor;
use Illuminate\Support\Facades\Auth;

class AuthorizationExceptionAbettor implements Abettor
{
	public function render($request, Exception $exception)
	{
		if (Auth::check())
		{
			flasher()->alert($exception->getMessage(), Notifier::DANGER);

			return back();
		}

		flasher()->alert('Please login', Notifier::INFO);

		return redirect()->guest('login');
	}
}
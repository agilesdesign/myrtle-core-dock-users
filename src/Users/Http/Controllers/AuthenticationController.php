<?php

namespace Myrtle\Core\Users\Http\Controllers;

use Myrtle\Core\Users\Http\Requests\AuthenticationForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Flasher\Support\Notifier;
use Myrtle\Core\Users\Policies\AuthenticationPolicy;

class AuthenticationController extends Controller
{
    public function login()
    {
        $this->authorize('login', AuthenticationPolicy::class);

        return view('auth::login');
    }

    public function authenticate(AuthenticationForm $form)
    {
        return $form->process();
    }

    public function logout()
    {
        $this->authorize('logout', AuthenticationPolicy::class);

        Auth::logout();

        return redirect(route('login'));
    }
}

<?php

namespace Myrtle\Core\Users\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Myrtle\Users\Http\Requests\StoreUserForm;
use Myrtle\Users\Models\User;

class RegistrationController extends Controller
{
    public function index(User $user)
    {
        $this->authorize('register');

        return view('auth::register', ['user' => $user]);
    }

    public function store(StoreUserForm $form)
    {
        $this->authorize('register');

		$user = $form->save();

        Auth::loginUsingId($user->id);

        return redirect(route('landing'));
    }
}

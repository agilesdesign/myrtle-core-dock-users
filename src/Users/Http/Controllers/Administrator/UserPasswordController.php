<?php

namespace Myrtle\Core\Users\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Myrtle\Core\Users\Models\User;

class UserPasswordController extends Controller
{
	public function edit(User $user)
	{
		$this->authorize('update', $user);

		return view('admin::users.password.edit')->withUser($user);
	}

	public function update(Request $request, User $user)
	{
		$this->authorize('update', $user);

		$user->update(['password' => bcrypt($request->password)]);

		return redirect(route('admin.users.show', $user->id));
	}
}

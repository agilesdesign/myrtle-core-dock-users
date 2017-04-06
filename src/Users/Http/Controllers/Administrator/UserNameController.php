<?php

namespace Myrtle\Core\Users\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Myrtle\Core\Users\Models\User;
use Myrtle\Core\Users\Http\Requests\UserNameUpdateForm;

class UserNameController extends Controller
{
	public function edit(User $user)
	{
		$this->authorize('editName', $user);

		return view('admin::users.name.edit')->withUser($user);
	}

	public function update(UserNameUpdateForm $form, User $user)
	{
		$this->authorize('editName', $user);

		$form->save();

		return redirect(route('admin.users.show', $user));
	}
}

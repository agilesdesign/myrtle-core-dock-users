<?php

namespace Myrtle\Core\Users\Http\Controllers\Administrator;

use Myrtle\Users\Models\User;
use App\Http\Controllers\Controller;
use Myrtle\Users\Http\Requests\EnableUserForm;

class UserEnableController extends Controller
{
	public function update(EnableUserForm $form, User $user)
	{
		$this->authorize('activate', $user);

		$form->update($user);

		return redirect(route('admin.users.index'));
	}
}

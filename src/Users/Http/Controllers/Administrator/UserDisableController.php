<?php

namespace Myrtle\Core\Users\Http\Controllers\Administrator;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Myrtle\Users\Http\Requests\DisableUserForm;
use Myrtle\Users\Models\User;

class UserDisableController extends Controller
{
	public function update(DisableUserForm $form, User $user)
	{
		$this->authorize('activate', $user);

		$form->update($user);

		return redirect(route('admin.users.index'));
	}
}

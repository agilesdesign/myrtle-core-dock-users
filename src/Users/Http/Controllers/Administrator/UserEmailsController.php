<?php

namespace Myrtle\Core\Users\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Myrtle\Users\Models\User;
use Myrtle\Users\Models\UserEmail;

class UserEmailsController extends Controller
{

	public function create(UserEmail $email, User $user)
	{
		$this->authorize('emailsCreate', $user);

		return view('admin::users.emails.create', [
			'user' => $user,
			'email' => $email,
		]);
	}

	public function store(Request $request, User $user)
	{
		$this->authorize('emailsCreate', $user);

		$user->emails()->create($request->toArray());

		return redirect(route('admin.users.show', $user->id));
	}

	public function edit(User $user, UserEmail $email)
	{
		$this->authorize('emailsEdit', $user);

		return view('admin::users.emails.edit', [
			'user' => $user,
			'email' => $email,
		]);
	}

	public function update(Request $request, User $user, UserEmail $email)
	{
		$this->authorize('emailsEdit', $user);

		$email->update($request->toArray());

		return redirect(route('admin.users.show', $user->id));
	}

    public function destroy(Request $request, User $user, UserEmail $email)
    {
        $this->authorize('deleteEmails', $user);

        $email->delete();

        flasher()->alert('Email removed successfully', 'success');

        return redirect(route('admin.users.show', $user));
    }
}

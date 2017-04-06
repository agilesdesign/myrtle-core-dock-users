<?php

namespace Myrtle\Core\Users\Http\Controllers\Administrator;

use Myrtle\Phones\Models\Phone;
use Myrtle\Core\Users\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserPhonesController extends Controller
{
	public function create(User $user, Phone $phone)
	{
		$this->authorize('phonesCreate', $user);

		return view('admin::users.phones.create', [
			'user' => $user,
			'phone' => $phone,
		]);
	}

	public function store(Request $request, User $user)
	{
		$this->authorize('phonesCreate', $user);

		$user->phones()->create($request->toArray());

		flasher()->alert('Phone added successfully', 'success');

		return redirect(route('admin.users.show', $user->id));
	}

	public function edit(User $user, Phone $phone)
	{
		$this->authorize('phonesEdit', $user);

		return view('admin::users.phones.edit', [
			'user' => $user,
			'phone' => $phone,
		]);
	}

	public function update(Request $request, User $user, Phone $phone)
	{
		$this->authorize('phonesEdit', $user);

		$phone->update($request->toArray());

		flasher()->alert('Phone updated successfully', 'success');

		return redirect(route('admin.users.show', $user->id));
	}
}

<?php

namespace Myrtle\Core\Users\Http\Controllers\Administrator;

use Flasher\Support\Notifier;
use Myrtle\Users\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Myrtle\Addresses\Models\Address;

class UserAddressesController extends Controller
{
	public function create(User $user, Address $address)
	{
		$this->authorize('addressesCreate', $user);

		return view('admin::users.addresses.create', [
			'user' => $user,
			'address' => $address,
		]);
	}

	public function store(Request $request, User $user)
	{
		$this->authorize('addressesCreate', $user);

		$user->addresses()->create($request->toArray());

		flasher()->alert('Addresses created successfully', Notifier::SUCCESS);

		return redirect(route('admin.users.show', $user->id));
	}

	public function edit(User $user, Address $address)
	{
		$this->authorize('addressesEdit', $user);

		return view('admin::users.addresses.edit', [
			'user' => $user,
			'address' => $address,
		]);
	}

	public function update(Request $request, User $user, Address $address)
	{
		$this->authorize('addressesEdit', $user);

		$address->update($request->toArray());

        flasher()->alert('Addresses updated successfully', Notifier::SUCCESS);

		return redirect(route('admin.users.show', $user->id));
	}
}

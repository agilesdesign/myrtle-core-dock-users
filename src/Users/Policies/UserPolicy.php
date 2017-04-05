<?php

namespace Myrtle\Core\Users\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
	use HandlesAuthorization;

	public function __construct()
	{
		//
	}

	public function before(User $user)
	{
		if ($this->admin($user))
		{
			return true;
		}
	}

	public function admin(User $auth)
	{
		return $auth->allPermissions->contains(function ($ability, $key)
		{
			return $ability->name === 'users.admin';
		});
	}

	public function accessAdmin(User $auth)
	{
		return $auth->allPermissions->contains(function ($ability, $key) use ($auth)
		{
			return $ability->name === 'users.access.admin';
		});
	}

	public function activate(User $auth)
	{
		return $auth->allPermissions->contains(function ($ability, $key) use ($auth)
		{
			return $ability->name === 'users.activate';
		});
	}

	public function create(User $auth)
	{
		return $auth->allPermissions->contains(function ($ability, $key) use ($auth)
		{
			return $ability->name === 'users.create';
		});
	}

	public function list(User $auth)
	{
		return $auth->allPermissions->contains(function ($ability, $key) use ($auth)
		{
			return $ability->name === 'users.list' || $ability->name === 'users.view';
		});
	}

	public function view(User $auth, User $user = null)
	{
		return $auth->allPermissions->contains(function ($ability, $key) use ($auth, $user)
		{
			return
				$ability->name === 'users.view'
				|| ($user && $ability->name === 'users.' . $user->id . '.view');
		});
	}


	public function update(User $auth, User $user)
	{
		return $auth->allPermissions->contains(function ($ability, $key) use ($auth, $user)
		{
			return $ability->name === 'users.' . $user->id . '.edit'
			|| $ability->name === 'users.edit';
		});
	}

	public function dashboard(User $auth)
	{
		return $auth->allPermissions->contains(function ($ability, $key) use ($auth)
		{
			return $this->admin($auth) || $ability->name === 'users.dashboard';
		});
	}

	public function addressesCreate(User $auth, User $user)
	{
		return $auth->allPermissions->contains(function ($ability, $key) use ($auth, $user)
		{
			return $ability->name === 'users.addresses.create';
		});
	}

	public function addressesEdit(User $auth, User $user)
	{
		return $auth->allPermissions->contains(function ($ability, $key) use ($auth, $user)
		{
			return $ability->name === 'users.addresses.edit';
		});
	}

	public function addressesView(User $auth, User $user)
	{
		return $auth->allPermissions->contains(function ($ability, $key) use ($auth, $user)
		{
			return $ability->name === 'users.addresses.edit'
			|| $ability->name === 'users.addresses.view'
			|| $ability->name === 'users.' . $user->id . '.addresses.view';
		});
	}

	public function biographEdit(User $auth, User $user)
	{
		return $auth->allPermissions->contains(function ($ability, $key) use ($auth, $user)
		{
			return $ability->name === 'users.biograph.edit';
		});
	}

	public function biographView(User $auth, User $user)
	{
		return $auth->allPermissions->contains(function ($ability, $key) use ($auth, $user)
		{
			return $ability->name === 'users.biograph.edit'
			|| $ability->name === 'users.biograph.view'
			|| $ability->name === 'users.' . $user->id . '.biograph.view';
		});
	}

	public function emailsCreate(User $auth, User $user)
	{
		return $auth->allPermissions->contains(function ($ability, $key) use ($auth, $user)
		{
			return $ability->name === 'users.emails.create';
		});
	}

	public function emailsEdit(User $auth, User $user)
	{
		return $auth->allPermissions->contains(function ($ability, $key) use ($auth, $user)
		{
			return $ability->name === 'users.emails.edit';
		});
	}

	public function emailsDelete(User $auth, User $user)
	{
		return $auth->allPermissions->contains(function ($ability, $key) use ($auth, $user)
		{
			return $ability->name === 'users.emails.delete';
		});
	}

	public function emailsView(User $auth, User $user)
	{
		return $auth->allPermissions->contains(function ($ability, $key) use ($auth, $user)
		{
			return $ability->name === 'users.emails.edit'
			|| $ability->name === 'users.emails.view';
		});
	}

	public function nameEdit(User $auth, User $user)
	{
		return $auth->allPermissions->contains(function ($ability, $key) use ($auth, $user)
		{
			return $ability->name === 'users.name.edit';
		});
	}

	public function nameView(User $auth, User $user)
	{
		return $auth->allPermissions->contains(function ($ability, $key) use ($auth, $user)
		{
			return $ability->name === 'users.list'
			|| $ability->name === 'users.' . $user->id . '.view';
		});
	}

	public function phonesCreate(User $auth, User $user)
	{
		return $auth->allPermissions->contains(function ($ability, $key) use ($auth, $user)
		{
			return $ability->name === 'users.phones.create';
		});
	}

	public function phonesEdit(User $auth, User $user)
	{
		return $auth->allPermissions->contains(function ($ability, $key) use ($auth, $user)
		{
			return $ability->name === 'users.phones.edit';
		});
	}

	public function phonesDelete(User $auth, User $user)
	{
		return $auth->allPermissions->contains(function ($ability, $key) use ($auth, $user)
		{
			return $ability->name === 'users.phones.delete';
		});
	}

	public function phonesView(User $auth, User $user)
	{
		return $auth->allPermissions->contains(function ($ability, $key) use ($auth, $user)
		{
			return $ability->name === 'users.phones.edit'
			|| $ability->name === 'users.phones.view';
		});
	}
}

<?php

namespace Myrtle\Core\Users\Http\Controllers\Administrator;

use Flasher\Support\Notifier;
use Illuminate\Http\Request;
use Myrtle\Docks\UsersDock;
use Myrtle\Ethnicities\Models\Ethnicity;
use Myrtle\Genders\Models\Gender;
use App\Http\Controllers\Controller;
use Myrtle\MaritalStatuses\Models\MaritalStatus;
use Myrtle\Religions\Models\Religion;
use Myrtle\Roles\Models\Role;
use Myrtle\Core\Users\Models\User;
use Myrtle\Core\Users\Policies\UserPolicy;
use Myrtle\Core\Users\Http\Requests\StoreUserForm;
use Myrtle\Core\Users\Http\Requests\UpdateUserForm;

class UsersController extends Controller
{
	public function dashboard(User $policytype)
	{
		$this->authorize('dashboard', UserPolicy::class);

		return view('admin::users.dashboard', ['policytype' => $policytype]);
	}

	public function index()
	{
		$this->authorize('list', UsersDock::class);

		// when a user is authenticated the model \Myrtle\Core\Users\Models\User is booted
        // authentication happens before the custom configurations are loaded
        // since models are only booted once in the life cycle of the app
        // we need to clear this booted model to ensure it adheres to
        // configuration overrides like paginate
        User::clearBootedModels();

        $genders = Gender::pluck('name', 'id');
        $roles = Role::assignable()->get()->pluck('name', 'id');
        $users = User::searched()->filtered()->canView()->paginate();

		return view('admin::users.index')->withGenders($genders)->withRoles($roles)->withUsers($users);
	}

	public function show(User $user)
	{
		$this->authorize($user);

		return view('admin::users.show', ['user' => $user]);
	}

	public function create(User $user)
	{
		$this->authorize($user);

		return view('admin::users.create', [
			'user' => $user,
			'genders' => Gender::pluck('name', 'id'),
			'ethnicities' => Ethnicity::pluck('name', 'id'),
			'religions' => Religion::pluck('name', 'id'),
			'maritalstatuses' => MaritalStatus::pluck('name', 'id'),
		]);
	}

	public function store(StoreUserForm $form, User $user)
	{
		$this->authorize('create', User::class);

		$user = $form->save();

		flasher()->alert('User created successfully', Notifier::SUCCESS);

		return redirect(route('admin.users.show', $user->id));
	}

	public function edit(User $user)
	{
		$this->authorize($user);

		return view('admin::users.edit', [
			'user' => $user,
			'genders' => Gender::pluck('name', 'id'),
			'ethnicities' => Ethnicity::pluck('name', 'id'),
			'religions' => Religion::pluck('name', 'id'),
			'maritalstatuses' => MaritalStatus::pluck('name', 'id'),
		]);
	}

	public function update(UpdateUserForm $form, User $user)
	{
		$this->authorize($user);

		$form->save($user);

        flasher()->alert('User updated successfully', Notifier::SUCCESS);

		return redirect(route('admin.users.show', $user->id));
	}

    public function destroy(Request $request, User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        flasher()->alert('User deleted successfully', Notifier::SUCCESS);

        return redirect(route('admin.users.index'));
    }

}

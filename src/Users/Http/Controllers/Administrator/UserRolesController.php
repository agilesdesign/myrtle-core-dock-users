<?php

namespace Myrtle\Core\Users\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Myrtle\Roles\Models\Role;
use Myrtle\Roles\Policies\RolesPolicy;
use Myrtle\Users\Models\User;

class UserRolesController extends Controller
{
    public function edit(User $user)
    {
        $this->authorize('admin', RolesPolicy::class);

        $roles = Role::assignable()->get()->pluck('name', 'id');

        return view('admin::users.roles.edit')
            ->withUser($user)
            ->withMembership($user->roles->pluck('id')->toArray())
            ->withRoles($roles);
    }

    public function update(Request $form, User $user)
    {
        $this->authorize('admin', RolesPolicy::class);

        $user->roles()->sync($form->roles);

        return redirect(route('admin.users.show', $user));
    }
}

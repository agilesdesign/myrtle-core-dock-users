<?php

namespace Myrtle\Core\Users\Http\Controllers\Administrator;

use Myrtle\Docks\Dock;
use Myrtle\Permissions\Models\Ability;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Myrtle\Roles\Models\Role;
use Myrtle\Core\Users\Models\User;

class UserPermissionsController extends Controller
{
    public function edit(User $user)
    {
        $this->authorize('users.admin');

        $users = User::all()->keyBy('id')->map(function ($user, $key) {
            return '(#' . $user->id . ')' . ' ' . $user->name->lastFirst;
        })->toArray();
        $roles = Role::permissionable()->pluck('name', 'id');

        return view('admin::users.permissions.edit')
            ->withRoles($roles)
            ->withUser($user)
            ->withUsers($users);
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('users.admin');

        $permissionabletypes = collect(Dock::PERMISSIONABLE_TYPES)->keyBy(function ($type, $key) {
            return $type;
        })->transform(function ($type, $key) {
            return [];
        })->toArray();

        $user->abilities->keyBy(function ($ability, $key) {
            return $ability->name;
        })->transform(function ($ability, $name) use ($request, $permissionabletypes) {
            $fieldName = (str_replace('.', '_', $ability->name));
            $form = $request->{$fieldName} ?? [];

            return array_replace_recursive($form, $permissionabletypes);
        })->each(function ($types, $name) {
            collect($types)->each(function ($objectIds, $key) use ($name) {
                $ability = Ability::where('name', $name)->first();
                $ability->{$key}()->sync($objectIds);
            });
        });

        flasher()->alert('Permissions updated successfully', 'success');

        return redirect(route('admin.users.show', $user->id));
    }
}

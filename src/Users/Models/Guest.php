<?php

namespace Myrtle\Core\Users\Models;

use Myrtle\Roles\Models\Role;
use Pseudo\Auth\Guest as PseudoGuest;
use Myrtle\Users\Models\Traits\UserPermissions;

class Guest extends PseudoGuest
{
	use UserPermissions;

	public function getPermissionsAttribute()
	{
		return collect([]);
	}

	public function getRolesAttribute()
	{
		return Role::where('id', 2)->get();
	}

	public function getAllRolesAttribute()
    {
        return collect([]);
    }
}

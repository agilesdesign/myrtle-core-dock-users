<?php

namespace Myrtle\Core\Users\Models\Traits;

trait UserPermissions
{
    public function getAllPermissionsAttribute()
	{
		return $this->permissions
			->merge($this->inheritedPermissions);
	}

	public function getInheritedPermissionsAttribute()
	{
		return $this->allRoles->flatMap(function($role, $key) {
			return $role->permissions;
		});
	}
}
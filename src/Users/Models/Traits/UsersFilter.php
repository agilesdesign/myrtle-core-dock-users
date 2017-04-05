<?php

namespace Myrtle\Core\Users\Models\Traits;

use Illuminate\Support\Facades\Request;
use Myrtle\Users\Models\Scopes\UsersFilterScope;

trait UsersFilter
{
    public function getFiltersAttribute()
    {
        return Request::only('biograph', 'roles');
    }

    public static function bootUsersFilter()
    {
        static::addGlobalScope(new UsersFilterScope);
    }
}
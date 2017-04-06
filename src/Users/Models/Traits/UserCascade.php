<?php

namespace Myrtle\Core\Users\Models\Traits;

use Myrtle\Core\Users\Models\Observers\UserCascadeObserver;
use Myrtle\Core\Users\Models\User;

trait UserCascade
{
	public static function bootUserCascade()
    {
        User::observe(UserCascadeObserver::class);
    }
}
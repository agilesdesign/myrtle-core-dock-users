<?php

namespace Myrtle\Core\Users\Models\Traits;

use Myrtle\Users\Models\Observers\UserCascadeObserver;
use Myrtle\Users\Models\User;

trait UserCascade
{
	public static function bootUserCascade()
    {
        User::observe(UserCascadeObserver::class);
    }
}
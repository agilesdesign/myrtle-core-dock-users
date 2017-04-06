<?php

namespace Myrtle\Core\Users\Models\Traits;

use Myrtle\Core\Users\Models\Observers\UserCascadeObserver;
use Myrtle\Core\Users\Models\Observers\UserMustHaveOneEmailObserver;
use Myrtle\Core\Users\Models\User;

trait UserMustHaveOneEmail
{
	public static function bootUserMustHaveOneEmail()
    {
        static::observe(UserMustHaveOneEmailObserver::class);
    }
}
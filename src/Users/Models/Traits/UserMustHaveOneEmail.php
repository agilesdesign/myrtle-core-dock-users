<?php

namespace Myrtle\Core\Users\Models\Traits;

use Myrtle\Users\Models\Observers\UserCascadeObserver;
use Myrtle\Users\Models\Observers\UserMustHaveOneEmailObserver;
use Myrtle\Users\Models\User;

trait UserMustHaveOneEmail
{
	public static function bootUserMustHaveOneEmail()
    {
        static::observe(UserMustHaveOneEmailObserver::class);
    }
}
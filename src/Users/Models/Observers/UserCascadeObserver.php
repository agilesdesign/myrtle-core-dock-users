<?php

namespace Myrtle\Core\Users\Models\Observers;

use Myrtle\Users\Models\User;

class UserCascadeObserver
{
    public function created(User $user)
    {
        $user->biograph()->create([]);
    }

    public function deleted(User $user)
    {
        $method = $user->isForceDeleting() ? 'forceDelete' : 'delete';

        $user->name()->withTrashed()->$method();
        $user->biograph()->withTrashed()->$method();
        $user->addresses->each(function ($address, $key) use ($method)
        {
            $address->$method();
        });
        $user->emails->each(function ($email, $key) use ($method)
        {
            $email->$method();
        });
        $user->phones->each(function ($phone, $key) use ($method)
        {
            $phone->$method();
        });
//        $user->websites->each(function ($website, $key) use ($method)
//        {
//            $website->$method();
//        });

        if ($method === 'forceDelete')
        {
            $user->permissions()->sync([]);
            $user->roles()->sync([]);
        }
    }

    public function restoring(User $user)
    {
        $user->name()->withTrashed()->restore();

        $user->biograph()->withTrashed()->restore();

        $user->addresses()->withTrashed()->get()->each(function ($address, $key)
        {
            $address->restore();
        });
        $user->emails()->withTrashed()->get()->each(function ($email, $key)
        {
            $email->restore();
        });
        $user->phones()->withTrashed()->get()->each(function ($phone, $key)
        {
            $phone->restore();
        });
//        $user->websites()->withTrashed()->get()->each(function ($website, $key)
//        {
//            $website->restore();
//        });
    }
}

<?php

namespace Myrtle\Core\Users\Models\Observers;

use Myrtle\Core\Users\Models\UserEmail;

class UserMustHaveOneEmailObserver
{
    public function deleting(UserEmail $email)
    {
        if($email->user && $email->user->emails->count() === 1)
        {
            flasher()->alert('User must have at least one email', 'danger');

            return false;
        }
    }
}

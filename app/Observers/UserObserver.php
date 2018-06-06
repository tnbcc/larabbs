<?php

namespace App\Observers;

use App\Models\User;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class UserObserver
{
    public function creating(User $user)
    {
       //$user->name = clean($user->name, 'user_topic_body');
    }

    public function updating(User $user)
    {
        //
    }
}
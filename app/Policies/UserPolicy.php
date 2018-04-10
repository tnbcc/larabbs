<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

   /*
    *只能编辑自己的个人信息
	*/
	public function update(User $currentUser, User $user){
		return $currentUser->id === $user->id;
}
}

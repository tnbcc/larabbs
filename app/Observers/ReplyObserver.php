<?php

namespace App\Observers;

use App\Models\Reply;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    
	/*
	 *回复数+1
	 */
	public function created(Reply $reply)
    {
        $reply->topic->increment('reply_count', 1);
    }
	 /*
	  *防止XXS攻击
	  */
	public function creating(Reply $reply)
    {
        $reply->content = clean($reply->content, 'user_topic_body');
    }
}
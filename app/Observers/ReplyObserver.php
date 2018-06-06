<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\TopicReplied;
// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{

	/*
	 *回复数+1
	 */
	public function created(Reply $reply)
    {
	    $topic = $reply->topic;
        $reply->topic->increment('reply_count', 1);

		//通知作者话题被回复了
		$topic->user->notify(new TopicReplied($reply));
    }
	 /*
	  *防止XXS攻击
	  */
	public function creating(Reply $reply)
    {
        $reply->content = clean($reply->content, 'user_topic_body');
    }

	/*
	 *删除评论后评论数减一
	 */
	public function deleted(Reply $reply)
    {
        $reply->topic->decrement('reply_count', 1);
    }


}

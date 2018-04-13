<?php

namespace App\Observers;

use App\Models\Topic;
use App\Handlers\SlugTranslateHandler;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function creating(Topic $topic)
    {
        //
    }

    public function updating(Topic $topic)
    {
        //
    }
	 public function saving(Topic $topic)
    {   
	    //Xss过滤
        $topic->body = clean($topic->body, 'user_topic_body');
        
		//自动生成摘要
        $topic->excerpt = make_excerpt($topic->body);
		
		//如 slug 字段无内容就使用翻译器对title 进行翻译
		if ( ! $topic->slug) {
            $topic->slug = app(SlugTranslateHandler::class)->translate($topic->title);
        }
    }
}
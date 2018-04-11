<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body','category_id', 'excerpt', 'slug'];
    
	/*
	 *跟user表的id 存在一一对应的关联 使用belongsTo
	 */
	public function user(){
		return $this->belongsTo(User::class);
	}
	
	/*
	 *跟栏目表Category表id也是一一对应的关系 同样使用belongsTo
	 */
	 
	 public function category(){
		 return $this->belongsTo(Category::class);
	 }
	 
	 public function scopeWithOrder($query,$order){
		 //不同的排序，使用不同的数据读取逻辑
		 switch($order){
		     case 'recent':
			      $query = $this->recent();
		          break;
			 
			 default:
			      $query = $this->recentReplied();
				  break;
		 }
		  //预加载防止N+1 问题
		   return $query->with('user','category');
	 }
	 public function scopeRecentReplied($query)
    {
        // 当话题有新回复时，我们将编写逻辑来更新话题模型的 reply_count 属性，
        // 此时会自动触发框架对数据模型 updated_at 时间戳的更新
        return $query->orderBy('updated_at', 'desc');
    }

    public function scopeRecent($query)
    {
        // 按照创建时间排序
        return $query->orderBy('created_at', 'desc');
    }
}

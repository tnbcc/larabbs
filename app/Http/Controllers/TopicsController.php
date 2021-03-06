<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\Category;
use Auth;
use App\Handlers\ImageUploadHandler;
use App\Services\OSS;
use App\Models\User;
use App\Models\Link;

class TopicsController extends Controller
{
    public function __construct()
    {
		//未登录用户限制
        $this->middleware('auth', ['except' => ['index', 'show','testup']]);
    }

	 public function index(Request $request, Topic $topic, User $user,Link $link)
    {
        $topics = $topic->withOrder($request->order)->paginate(10);
        $active_users = $user->getActiveUsers();
		$links = $link->getAllCached();
        //dd($active_users);
        return view('topics.index', compact('topics', 'active_users','links'));
    }

    public function show(Request $request,Topic $topic)
    {
		 // URL 矫正
        if ( ! empty($topic->slug) && $topic->slug != $request->slug) {
            return redirect($topic->link(), 301);
        }
        return view('topics.show', compact('topic'));
    }

	public function create(Topic $topic)
	{  
		$categories = Category::all();
		return view('topics.create_and_edit', compact('topic','categories'));
	}

	
	
	public function store(TopicRequest $request,Topic $topic)
	{  
		//自动将提交过来的表单转换成数组
		$topic->fill($request->all());
        $topic->user_id = Auth::id();
        $topic->save();
		return redirect()->to($topic->link())->with('success', '成功创建新话题!');
	}

	public function edit(Topic $topic)
	{
		//所有分类
		$categories = Category::all();
        return view('topics.create_and_edit', compact('topic', 'categories'));
	}

	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());

		return redirect()->to($topic->link())->with('success', '更新话题成功！');
	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('success', '删除话题成功！');
	}
	
	 /**
     * @api {post} uploadImage 话题图片上传至阿里云OSS[uploadImage]
     * @apiVersion 2.0.0
     * @apiName uploadImage
     * @apiGroup upload
     * @apiSampleRequest upload_image
     *
     * @apiParam {date} Request 图片上传file信息
     *   
     *
     * 
     * @apiSuccess {Array} data  返回数据内容.
	 * 
     *   
     */
	 public function uploadImage(Request $request)
    {
		 // 初始化返回数据，默认是失败的
        $data = [
            'success'   => false,
            'msg'       => '上传失败!',
            'file_path' => ''
        ];
        // 判断是否有上传文件，并赋值给 $file
        if ($file = $request->upload_file) {
            // 保存图片到阿里云oss
			$pic = $file->getRealPath();
            $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';
			$key = \Auth::id() . '_' . time() . '_' . str_random(10) . '.' . $extension;
            $result = OSS::upload($key,$pic);
			$path = 'https://larabbs.oss-cn-beijing.aliyuncs.com/'.$key;
			// 图片保存成功的话
            if ($result) {
                $data['file_path'] = $path;
                $data['msg']       = "上传成功!";
                $data['success']   = true;
            }
        }
        return $data;
    }
}
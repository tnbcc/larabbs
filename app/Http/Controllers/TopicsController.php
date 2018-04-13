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

class TopicsController extends Controller
{
    public function __construct()
    {
		//未登录用户限制
        $this->middleware('auth', ['except' => ['index', 'show','testup']]);
    }

	public function index(Request $request,Topic $topic)
	{
		 $topics = $topic->withOrder($request->order)->paginate(10);
        return view('topics.index', compact('topics'));
	}

    public function show(Topic $topic)
    {
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
		return redirect()->route('topics.show', $topic->id)->with('success', '成功创建新话题!');
	}

	public function edit(Topic $topic)
	{
        $this->authorize('update', $topic);
		//所有分类
		$categories = Category::all();
        return view('topics.create_and_edit', compact('topic', 'categories'));
	}

	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());

		return redirect()->route('topics.show', $topic->id)->with('success', '更新话题成功！');
	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('message', '删除话题成功！');
	}
	
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
			$path = OSS::getUrl($key);
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
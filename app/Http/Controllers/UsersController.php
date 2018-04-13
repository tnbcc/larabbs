<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;
use App\Services\OSS;

class UsersController extends Controller
{
	public function __construct(){
		$this->middleware('auth',[
		        'excpt' => ['show'],
		]);
	}
	
    /*
	 *用户展示页
	 */
	public function show(User $user){
		return view('users.show',compact('user'));
	}
	
	/*
	 *个人资料编辑展示页
	 */
	public function edit(User $user){
		if(\Auth::user()->can('update',$user)){
		return view('users.edit',compact('user')); 
		}else{
			return redirect()->route('users.edit', $user->id)->with('danger', '无权编辑别人的信息！');
		}
	}
	
	/*
	 *个人资料更新
	 */
	public function update(UserRequest $request,User $user){
		$data = $request->all();
		//如果上传了头像
		if($file = $request->avatar){
			$pic = $file->getRealPath();
			//dd($pic);
			//$result = $uploader->save($file,'avatar',$user->id,362);
			//$data['avatar'] = $result['path'];
			$extension = strtolower($file->getClientOriginalExtension()) ?: 'png';
			$key = $user->id . '_' . time() . '_' . str_random(10) . '.' . $extension;
			    //$key = $result['filename']; 
			      $res = OSS::upload($key,$pic);
			if($res){
				  $data['avatar'] = OSS::getUrl($key);
				 
				//$a = Storage::disk('oss')->putFile('/',$result['path']);
				//dd($a);
				//Storage::move($result['path'],$result['path']);
			}
		}
		$user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
	}
	
}

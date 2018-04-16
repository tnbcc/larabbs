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
	public function update(UserRequest $request,User $user,ImageUploadHandler $uploader){
		 $data = $request->all();

        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
	}
	
}

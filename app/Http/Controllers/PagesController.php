<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/*
 *用来处理所有自定义页面的逻辑
 */
class PagesController extends Controller
{
	/*
	 *首页
	 */
    public function root(){
		return view('pages.root');
	}
	
	 public function permissionDenied()
    {
        // 如果当前用户有权限访问后台，直接跳转访问
        if (config('administrator.permission')()) {
            return redirect(url(config('administrator.uri')), 302);
        }
        // 否则使用视图
        return view('pages.permission_denied');
    }
}

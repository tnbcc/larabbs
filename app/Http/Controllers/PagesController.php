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
}

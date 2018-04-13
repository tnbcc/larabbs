<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class BaiduController extends Controller
{
    public function index($text){
		//实例化 HTTP 客户端
		$http = new Client;
		
		//配置初始信息
		$api = 'http://api.fanyi.baidu.com/api/trans/vip/translate?';
	    $appid = config('services.baidu_translate.appid');
		$key = config('services.baidu_translate.key');
		$salt = time();
		
		//按要求生成appid+q+salt+密钥 的MD5值
		
		$sign = md5($appid.$text.$salt.$key);
		
		//构建请求参数
		$query = http_build_query([
		      'q' => $text,
			  'from' => 'zh',
			  'to'  => 'en',
			  'appid' => $appid,
			  'salt' => $salt,
			  'sign' => $sign,
		]);
		
		//发送 HTTP Get 请求
		$response = $http->get($api.$query);
		
		$result = json_decode($response->getBody(),true);
		
		dd($result);
		
	}
}

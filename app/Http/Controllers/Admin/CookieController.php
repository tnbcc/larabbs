<?php

namespace App\Http\Controllers\Admin;
require_once app_path().'/Services/Tools/Test.php';

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Cookie;
use App\Services\Tools;

class CookieController extends Controller
{
    public function index(){
		$test = new \MyTest();
		return $test->test();
	}
}

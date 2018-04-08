<?php
/*
 *将单前请求的路由名称转化为css类名称
 */
function route_class(){
	 return str_replace('.','-',Route::currentRouteName());	
}
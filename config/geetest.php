<?php

return [
    /*
    |--------------------------------------------------------------------------
    | 极验 - 行为验证 3.0.0 配置
    |--------------------------------------------------------------------------
    |
    | id 与 key 请在控制台获取
    |
    */
    'id' => env('GEETEST_ID', null),
    'key' => env('GEETEST_KEY', null),

    /*
    |--------------------------------------------------------------------------
    | 路由前缀配置
    |--------------------------------------------------------------------------
    |
    | 默认值：''
    | 如果与其它 Composer 包路由产生冲突时可以设置
    |
    */
    'prefix' => '',

    /*
    |--------------------------------------------------------------------------
    | 路由别名前缀配置
    |--------------------------------------------------------------------------
    |
    | 默认值：'geetest'
    | 一般不需要改动
    |
    */
    'as' => 'geetest',

    /*
    |--------------------------------------------------------------------------
    | 路由中间件配置
    |--------------------------------------------------------------------------
    |
    | 默认值：['web']
    | 一般不需要改动
    |
    */
    'middleware' => [
        'web',
    ],

    /*
    |--------------------------------------------------------------------------
    | 表单验证规则
    |--------------------------------------------------------------------------
    |
    | 默认值：'captcha'
    | 如果与其它 Composer 包验证规则名称产生冲突时可以设置
    |
    */
    'captcha' => 'captcha',
];

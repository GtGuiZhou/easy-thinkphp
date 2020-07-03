<?php

return [
    'official' => [
        'app_id' => env('wechat.official_appid'),
        'secret' => env('wechat.official_secret'),
        'token' => env('wechat.official_token'),
        'response_type' => 'array',
        // 管理员后台登陆的token有效期,也就是微信回调后通过 token => openid 的方式存储在缓存中，等待前端轮询来查询。
        'admin_login_token_expire' => 60,
        'scopes' => ['snsapi_base']
    ],
    'mini_program' => [
        'app_id' => env('wechat.mini_appid'),
        'secret' => env('wechat.mini_secret'),

        // 下面为可选项
        // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
        'response_type' => 'array',
    ]
];

<?php

return [
    'official' => [
        'app_id' => env('wechat.official_appid'),
        'secret' => env('wechat.secret'),
        'token' => env('wechat.token'),
        'response_type' => 'array',
        // 管理员后台登陆的token有效期,也就是微信回调后通过 token => openid 的方式存储在缓存中，等待前端轮询来查询。
        'admin_login_token_expire' => 60
    ]
];

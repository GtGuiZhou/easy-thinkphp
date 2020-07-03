<?php

use think\facade\Route;


Route::group('home', function () {
    Route::post('login-phone', 'user.home/loginPhone');
    Route::any('home/login-wechat-web', 'user.home/loginWechatWeb');
});



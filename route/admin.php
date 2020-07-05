<?php


use think\facade\Route;

// 需要鉴权的接口
Route::group('admin', function () {

})->middleware(\app\middleware\AdminAuth::class);

// 无需鉴权的接口
Route::group('admin', function () {
    Route::group('home', function () {
        Route::post('login-username', 'admin.home/loginUsername');
    });
    Route::get('test', 'admin.home/test');
});



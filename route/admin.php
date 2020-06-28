<?php


use think\facade\Route;
Route::group('',function (){
    // 需要鉴权的接口
    Route::group('admin',function (){
        Route::group('home',function (){
            Route::post('login-username','admin.home/loginUsername');
        });
    })->middleware(\app\middleware\AdminAuth::class);

    // 无需鉴权的接口
    Route::group('admin',function (){
        Route::get('test','admin.home/test');
    });

})->middleware(\app\middleware\AdminResponseHandle::class);


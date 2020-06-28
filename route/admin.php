<?php


use think\facade\Route;

Route::group('admin',function (){
    Route::group('home',function (){
        Route::post('login-username','admin.home/loginUsername');
    });
    Route::get('test','admin.home/test')
        ->middleware(\app\middleware\AdminAuthMiss::class);
})->middleware(\app\middleware\AdminResponseHandle::class)
    ->middleware(\app\middleware\AdminAuth::class);


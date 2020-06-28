<?php

use think\facade\Route;


Route::group('home', function () {
    Route::post('login-phone', 'user.home/loginPhone');
});



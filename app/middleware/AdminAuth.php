<?php
declare (strict_types = 1);

namespace app\middleware;

use app\controller\AdminController;
use think\Response;
use think\Route;

class AdminAuth
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure $next
     * @return void
     */
    public function handle($request, \Closure $next)
    {
        // 不需要检测权限的方法
        if (in_array(AdminAuthMiss::class,app()->middleware->all())){
            return;
        }

        $admin = AdminController::admin();

        return $next($request);

    }
}

<?php
declare (strict_types = 1);

namespace app\middleware;

use app\controller\AdminController;
use app\exceptions\CheckException;
use think\Request;
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

        // 检测路由规则
        $this->checkRule($request);
        return $next($request);

    }

    public function checkRule(Request $request)
    {
        $admin = AdminController::admin();
        foreach ($admin->auth_rule as $rule){
            if (trim($rule->rule,'/') == trim($request->baseUrl(),'/')){
                return;
            }
        }

        throw new CheckException('您无权访问');
    }
}

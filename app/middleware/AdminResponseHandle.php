<?php
declare (strict_types = 1);

namespace app\middleware;

use app\ExceptionHandle;
use think\Response;

class AdminResponseHandle
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        $response = $next($request);
        if (ExceptionHandle::$HasException)
            return  $response;

        // 强制格式为json格式
        return json([
            'data' => $response->getData(),
            'time' => time()
        ]);
    }
}

<?php
declare (strict_types=1);

namespace app\middleware;

use app\ExceptionHandle;
use think\Response;

class ResponseHandle
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        $response = $next($request);

        return $response;

    }
}

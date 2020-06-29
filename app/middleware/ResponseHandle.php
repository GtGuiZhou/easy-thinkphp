<?php
declare (strict_types = 1);

namespace app\middleware;

use app\ExceptionHandle;
use think\Response;

class ResponseHandle
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
        // 强制格式为json格式
        if (get_class($response) == Response::class){
            return json([
                'data' => $response->getData(),
                'time' => time()
            ]);
        } else {
            return $response;
        }
    }
}

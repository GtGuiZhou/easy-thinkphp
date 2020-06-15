<?php
namespace app;

use app\exceptions\CheckException;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\Handle;
use think\exception\HttpException;
use think\exception\HttpResponseException;
use think\exception\ValidateException;
use think\facade\Env;
use think\facade\Log;
use think\Response;
use Throwable;

/**
 * 应用异常处理类
 */
class ExceptionHandle extends Handle
{
    /**
     * 不需要记录信息（日志）的异常类列表
     * @var array
     */
    protected $ignoreReport = [
        HttpException::class,
        HttpResponseException::class,
        ModelNotFoundException::class,
        DataNotFoundException::class,
        ValidateException::class,
        CheckException::class
    ];

    /**
     * 记录异常信息（包括日志或者其它方式记录）
     *
     * @access public
     * @param  Throwable $exception
     * @return void
     */
    public function report(Throwable $exception): void
    {
        // 使用内置的方式记录异常日志
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @access public
     * @param \think\Request   $request
     * @param Throwable $e
     * @return Response
     */
    public function render($request, Throwable $e): Response
    {
        // 添加自定义异常处理机制
        // 由于tp默认是关闭错误提示的，但是如果当前文件的代码有问题的话，是无法打印出错误的，当出现没有任何内容的500错误时，路由打开下面两行代码
        // ini_set("display_errors", "On");//打开错误提示
        // ini_set("error_reporting",E_ALL);//显示所有错误

//        if ($e instanceof ValidateException) {
//            return json($e->getError(), 422);
//        }

        if ($e instanceof ModelNotFoundException){
            return output_warp(null,'访问数据不存在',400);
        }

        if ($e instanceof CheckException){
            return output_warp(null,$e->getMessage(),$e->getCode());
        }

        if (!Env::get('APP_DEBUG')){
            // 生产模式,不展示错误详细信息
            return output_warp(null,'服务器内部错误',500);
        } else {
            // 开发模式,展示详细信息便于调试
            return Response::create($this->renderExceptionContent($e))->code(500);
        }
    }
}

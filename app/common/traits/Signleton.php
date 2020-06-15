<?php
namespace app\common\traits;

trait Signleton
{
    /**
     * @author gt
     * @return self
     */
    public static function instance()
    {
        return app()->make(self::class,func_get_args());
    }
}
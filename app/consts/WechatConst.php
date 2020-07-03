<?php


namespace app\consts;


class WechatConst
{
    public static function officialConfig()
    {
        return config('wechat.official');
    }

    public static function miniProgram()
    {
        return config('wechat.mini_program');
    }
}
<?php


namespace app\consts;


class CacheConst
{
    public static function adminWechatLoginToken($token)
    {
        return new CacheConstConfig("admin:login:token:$token", env('wehcat.official.admin_login_token_expire'));
    }
}
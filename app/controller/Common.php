<?php


namespace app\controller;


use app\consts\WechatConst;
use EasyWeChat\Factory;

class Common
{
    /**
     * 微信需要验证服务器的时候填这个接口就行了
     * @author gt
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \EasyWeChat\Kernel\Exceptions\BadRequestException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function wechatServerValidate()
    {
        $app = Factory::officialAccount(WechatConst::officialConfig());
        $app->server->serve()->send();
        exit();
    }

}
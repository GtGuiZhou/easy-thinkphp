<?php


namespace app\controller\admin;


use app\consts\CacheConst;
use app\consts\WechatConst;
use app\model\AdminModel;
use app\controller\AdminController;
use app\exceptions\CheckException;
use app\Request;
use EasyWeChat\Factory;
use think\facade\Cache;

class Home extends AdminController
{
    protected static $noNeedAuth = ['loginUsername'];

    public function loginUsername(string $username, string $password)
    {
        $admin = AdminModel::where('username', $username)->find();
        if (!$admin)
            throw new CheckException('管理员不存在');

        if ($admin->password != AdminModel::generateEncryptPassword($password)) {
            throw new CheckException('密码错误');
        }

        return AdminModel::login($admin);
    }




    public function wechatLoginCallback(string $token)
    {
        $openId = $this->wechatOfficial()->oauth->user()->getId();
        $config = CacheConst::adminWechatLoginToken($token);
        Cache::set($config->getKey(),$openId,$config->getExpire());
        return 'success';
    }


    public function test(Request $request)
    {
        $route = $request->baseUrl();
        return $route;
    }


    private function wechatOfficial()
    {
        return Factory::officialAccount(WechatConst::officialConfig());
    }
}
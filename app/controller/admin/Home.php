<?php


namespace app\controller\admin;


use app\model\AdminModel;
use app\controller\AdminController;
use app\exceptions\CheckException;
use app\Request;

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

    public function test(Request $request)
    {
        $route = $request->route();
        return $route;
    }
}
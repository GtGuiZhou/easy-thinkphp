<?php


namespace app\controller;


use app\consts\HttpCodeConst;
use app\exceptions\CheckException;
use app\middleware\AdminAuth;
use app\middleware\ResponseHandle;
use app\model\AdminModel;

abstract class AdminController extends BaseController
{

    /**
     * @var AdminModel 当前登录管理员
     */
    private static $admin;


    /**
     * 获取当前登录管理员
     * @return AdminModel|array|\think\Model|null
     * @throws CheckException
     */
    public static function admin()
    {
        if (self::$admin)
            return self::$admin;

        if (!$admin = AdminModel::getSessionAdmin())
            throw new CheckException('请先登录', HttpCodeConst::UN_LOGIN);

        if ($admin->is_locked) {
            throw new CheckException('该账号已被封禁');
        }

        self::$admin = $admin;
        return self::$admin;
    }
}
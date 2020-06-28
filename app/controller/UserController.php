<?php


namespace app\controller;

use app\common\model\MemberTokenModel;
use app\consts\HttpCodeConst;
use app\exceptions\CheckException;
use app\model\UserModel;
use tests\model\User;

abstract class UserController extends BaseController
{
    public function user()
    {

        if (!$user = UserModel::getSessionUser())
            throw new CheckException('请先登录',HttpCodeConst::UN_LOGIN);

        if ($user->is_locked){
            throw new CheckException('该账号已被封禁');
        }

        return $user;
    }
}
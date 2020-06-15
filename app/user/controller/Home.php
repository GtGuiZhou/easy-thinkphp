<?php


namespace app\user\controller;



use app\common\exceptions\CheckException;
use app\common\model\MemberTokenModel;
use app\common\model\UserModel;

class Home extends UserController
{
    public function loginByPhone(string $phone,string $password)
    {
        $user = UserModel::getByPhone($phone);
        if (!$user)
            throw new CheckException('用户不存在');

        if ($user->password != UserModel::generateEncryptPassword($password)){
            throw new CheckException('密码错误');
        }

        return MemberTokenModel::generateToken($user->id,$this->memberChannel);
    }

}
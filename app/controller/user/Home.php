<?php


namespace app\controller\user;



use app\common\model\MemberTokenModel;
use app\common\model\UserModel;
use app\controller\UserController;
use app\exceptions\CheckException;

class Home extends UserController
{
    public function loginByPhone(string $phone,string $password)
    {
        $user = UserModel::where("phone",$phone)->find();
        if (!$user)
            throw new CheckException('用户不存在');

        if ($user->password != UserModel::generateEncryptPassword($password)){
            throw new CheckException('密码错误');
        }

        $user->token =

re
        return MemberTokenModel::generateToken($user->id,$this->memberChannel);
    }

}
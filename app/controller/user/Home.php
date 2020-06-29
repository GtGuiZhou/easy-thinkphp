<?php


namespace app\controller\user;



use app\controller\UserController;
use app\exceptions\CheckException;
use app\model\UserModel;

class Home extends UserController
{
    public function loginPhone(string $phone,string $password)
    {
        $user = UserModel::where("phone",$phone)->find();
        if (!$user)
            throw new CheckException('用户不存在');

        if ($user->password != UserModel::generateEncryptPassword($password)){
            throw new CheckException('密码错误');
        }

        return UserModel::login($user);
    }


    
    public function loginWechatWeb()
    {
        
    }

    public function loginWechatMiniProgram()
    {
        
    }


}
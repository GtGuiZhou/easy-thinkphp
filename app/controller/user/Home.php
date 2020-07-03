<?php


namespace app\controller\user;



use app\consts\WechatConst;
use app\controller\UserController;
use app\exceptions\CheckException;
use app\model\UserModel;
use common\exceptions\ServiceException;
use EasyWeChat\Factory;
use Overtrue\Socialite\User;

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
        return $this->wechatOfficial()
            ->oauth->scopes(config('wechat.official.scopes',['snsapi_base']))
            ->setRedirectUrl(url('home/login-wechat-web'))
            ->redirect()->send();
    }

    /**
     * @author gt
     * @param string $code
     * @param string $iv 解码密钥
     * @param string $encrypted_data  用户加密信息
     * @throws CheckException
     * @throws \EasyWeChat\Kernel\Exceptions\DecryptException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function loginWechatMiniProgram(string $code,string $iv, string $encrypted_data)
    {
        $res = $this->wechatMiniProgram()
            ->auth->session($code);
        if (isset($res['errcode']))
            throw new CheckException($res['errmsg']);

        $wechatUser = $this->wechatMiniProgram()
            ->encryptor->decryptData($res['session_key'], $iv, $encrypted_data);

        $dbUser = UserModel::where('mini_open_id',$wechatUser['openId'])->find();
        if (!$dbUser){
            $dbUser = new UserModel();
            $dbUser->mini_open_id = $wechatUser['openId'];
        }
        $dbUser->nickname = $wechatUser['nickName'];
        $dbUser->avatar = $wechatUser['avatarUrl'];
        return UserModel::login($dbUser);
    }

    public function callbackWechatWeb()
    {
        $wechatUser = $this->wechatOfficial()->oauth->user();
        $dbUser =  UserModel::where('official_open_id',$wechatUser->getId())
            ->find();
        if (!$dbUser){
            $dbUser = new UserModel();
            $dbUser->official_open_id = $wechatUser->getId();
        }
        $dbUser->nickname = $wechatUser->getNickname();
        $dbUser->avatar = $wechatUser->getAvatar();
        return UserModel::login($dbUser);
    }




}
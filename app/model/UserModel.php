<?php


namespace app\model;





use app\consts\SessionConst;
use think\facade\Session;

/**
 * Class UserModel
 *
 * @property int $id
 * @property string $username 用户名
 * @property string $password 密码
 * @property string $email 邮箱
 * @property string $phone 手机号
 * @property string $create_time 创建时间
 * @property int $is_locked 锁定账号
 * @property string $nickname 昵称
 * @property string $avatar 头像
 * @property string $token 登陆标识
 * @property string $login_time 登陆时间
 */
class UserModel extends BaseModel
{
    protected $table = 'user';

    protected function filedRules()
    {
        // TODO: Implement filedRules() method.
    }


    public static function generateEncryptPassword($password)
    {
        return md5($password);
    }

    public static function login(UserModel $user)
    {
        // 保存用户登录信息
        $user->login_time = date('Y-m-d H:i:s');
        $user->save();
        Session::set(SessionConst::USER_ID,$user->id);
        return $user;
    }

    public static function getSessionUser()
    {
        $userId = Session::get(SessionConst::USER_ID,false);
        if (!$userId || ! is_int($userId) || $userId < 1){
            return null;
        }
        return self::getById($userId);
    }

}
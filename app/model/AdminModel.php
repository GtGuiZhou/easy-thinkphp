<?php


namespace app\model;


use app\consts\SessionConst;
use think\facade\Session;
use think\Model;

/**
 * Class AdminModel
 *
 * @property int $id
 * @property string $username 用户名
 * @property string $password 密码
 * @property string $create_time
 * @property int $role_id 角色
 * @property string $update_time
 * @property string $root 超级管理员
 * @property string $avatar
 * @property string $token 登录token
 * @property string $login_time 登录时间
 * @property-read mixed $all_auth_rule
 */
class AdminModel extends BaseModel
{

    protected $table = 'admin';

    protected function filedRules()
    {
        // TODO: Implement filedRules() method.
    }

    public static function generateEncryptPassword($password)
    {
        return md5($password);
    }

    public static function login(self $admin)
    {
        // 保存用户登录信息
        $admin->login_time = date('Y-m-d H:i:s');
        $admin->save();
        Session::set(SessionConst::USER_ID,$admin->id);
        return $admin;
    }

    public static function getSessionAdmin()
    {
        $admin = Session::get(SessionConst::ADMIN_ID,false);
        if (!$admin || ! is_int($admin) || $admin < 1){
            return null;
        }
        return self::getById($admin);
    }

    public function rule()
    {

    }

    public function adminRole()
    {
//        return $this->hasMany()
    }

    public function getAllAuthRuleAttr()
    {
        // 超级管理员
        if ($this->root){
            return '*';
        }

    }
}
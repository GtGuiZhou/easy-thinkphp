<?php


namespace app\common\model;




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
 */
class UserModel extends MemberModel
{
    protected $table = 'user';

    protected function filedRules()
    {
        // TODO: Implement filedRules() method.
    }
}
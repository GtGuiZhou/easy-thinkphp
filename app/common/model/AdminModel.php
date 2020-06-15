<?php


namespace app\common\model;


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
 */
class AdminModel extends MemberModel
{

    protected $table = 'admin';

    protected function filedRules()
    {
        // TODO: Implement filedRules() method.
    }
}
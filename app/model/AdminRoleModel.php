<?php
declare (strict_types = 1);

namespace app\model;

use think\Model;

/**
 * 
 *
 * @mixin think\Model
 * @property int $id
 * @property string $name 角色名称
 * @property int $pid
 */
class AdminRoleModel extends BaseModel
{
    protected $table = 'admin_role';
}

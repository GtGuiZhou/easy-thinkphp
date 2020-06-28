<?php
declare (strict_types = 1);

namespace app\model;

use think\Model;

/**
 * 
 *
 * @mixin think\Model
 * @property int $role_id
 * @property string $rule
 * @property int $id
 * @property string $name 规则名称
 */
class AdminRoleRuleModel extends BaseModel
{
    protected $table = 'admin_role_rule';


}

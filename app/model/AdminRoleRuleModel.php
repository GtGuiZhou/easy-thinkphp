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
 */
class AdminRoleRuleModel extends BaseModel
{
    protected $table = 'admin_role_rule';


}

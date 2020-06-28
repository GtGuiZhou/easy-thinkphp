<?php
declare (strict_types = 1);

namespace app\model;

use think\Model;
use think\model\relation\BelongsToMany;

/**
 * 
 *
 * @mixin think\Model
 * @property int $id
 * @property string $name 角色名称
 * @property int $pid
 * @property-read \app\model\AdminRoleRuleModel[] $rules 角色规则
 */
class AdminRoleModel extends BaseModel
{
    protected $table = 'admin_role';

    public function rules()
    {
        return $this->belongsToMany(AdminRoleRuleModel::class,'admin_role_rule_mid','role_id','id');
    }

}

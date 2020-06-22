<?php
namespace app\common\model;

use think\exception\ValidateException;
use think\Model;
use think\Validate;

abstract class BaseModel extends Model
{

    
    public static function onBeforeWrite(self $model)
    {
        $model->validateSaveFields();
    }

    /**
     * 校验自己的保存字段
     * @author gt
     */
    public function validateSaveFields(){
        $v = new Validate();
        $v->rule($this->filedRules());
        $v->failException(true)->check($this->toArray());
    }

    /**
     * 返回字段规则
     * @author gt
     * @return array
     */
    abstract protected function filedRules();


    /**
     * 为后续做缓存优化做准备
     * @author gt
     * @param int $id
     * @return static
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public static function getById(int $id)
    {
        return self::find($id);
    }


    /**
     * 获取主键的值
     * @author gt
     * @return mixed
     */
    public function getPkValue()
    {
        return $this->getAttr($this->getPk());
    }


    /**
     * 通过某个字段去获取值
     * @author gt
     * @param $field
     * @param $value
     * @return static
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    protected static function getByField($field,$value)
    {
        return self::where($field,$value)->find();
    }
}
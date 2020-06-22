<?php


namespace app\common\model;

/**
 * Class MemberModel
 * @property string $password
 * @property int $is_locked
 * @package model
 */
abstract class MemberModel extends BaseModel
{

    public static function getByPhone(string $phone)
    {
        return self::getByField('phone',$phone);
    }

    /**
     * 是否登陆
     * @author gt
     * @return array|\think\Model|null
     */
    public function logged()
    {
        return MemberTokenModel::getMemberEffectiveToken($this->getPkValue());
    }

    public static function generateEncryptPassword($password)
    {
        return md5($password);
    }

}
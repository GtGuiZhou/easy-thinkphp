<?php
namespace app\service;

use model\MemberModel;
use model\MemberTokenModel;


class MemberService extends BaseService
{
    /**
     * @var MemberModel
     */
    private $memberModel;

    public function member()
    {

    }

    public function loginByMobile()
    {

    }

    /**
     * 判断帐号是否锁定
     * @author gt
     * @return mixed
     */
    public function locked()
    {
        return $this->is_locked;
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
}
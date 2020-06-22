<?php


namespace app\common\model;


/**
 * 
 *
 * @property int $id
 * @property string $token
 * @property int $member_id
 * @property string $ create_time
 * @property string $ channel
 * Class MemberTokenModel
 * @package model
 * @property string $create_time
 * @property string $channel
 */
class MemberTokenModel extends BaseModel
{
    protected $table = 'member_token';
    protected $sessionExpire = 3600;

    const CHANNEL_ADMIN = 'admin';
    const CHANNEL_USER = 'user';


    /**
     * @author gt
     * @param string $token
     * @return static
     */
    public static function getByToken(string $token)
    {
        return self::where('token',$token)->find();
    }


    public static function getMemberEffectiveToken(int $memberId)
    {
        return self::where('member_id',$memberId)
            ->where('create_time','>',date('Y-m-d H:i:s'))
            ->find();
    }

    public static function generateToken(int $memberId,string $channel)
    {
        $model = new self();
        $model->token = md5($memberId."|".$channel.'|'.uniqid());
        $model->channel = $channel;
        $model->member_id = $memberId;
        $model->save();
        return $model;
    }

    function filedRules()
    {
        return [
            'token' => 'require|length:32',
            'member_id' => 'require|integer|>:0',
            'channel' => 'require|enum|in:admin,user'
        ];
    }
}
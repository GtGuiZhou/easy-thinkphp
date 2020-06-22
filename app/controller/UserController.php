<?php


namespace app\controller;

use app\BaseController;
use app\common\model\MemberTokenModel;

abstract class UserController extends BaseController
{
    protected $memberChannel = MemberTokenModel::CHANNEL_USER;
}
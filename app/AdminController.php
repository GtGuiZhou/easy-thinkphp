<?php


namespace app;




use app\common\model\MemberTokenModel;

abstract class AdminController extends BaseController
{
    protected $memberChannel = MemberTokenModel::CHANNEL_ADMIN;
}
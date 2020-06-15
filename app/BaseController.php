<?php
declare (strict_types = 1);

namespace app;

use app\exceptions\CheckException;
use app\exceptions\InternalException;
use model\AdminModel;
use model\BaseModel;
use model\MemberModel;
use model\MemberTokenModel;
use model\UserModel;
use think\App;
use think\exception\ValidateException;
use think\Validate;

/**
 * 控制器基础类
 */
abstract class BaseController
{
    /**
     * 当前登陆用户模型
     * @author gt
     * @var MemberModel
     */
    private $member;

    /**
     * 当前用户登陆的通道，用于区分admin和user
     * @var null
     */
    protected $memberChannel = null;

    /**
     * Request实例
     * @var \think\Request
     */
    protected $request;

    /**
     * 应用实例
     * @var \think\App
     */
    protected $app;

    /**
     * 是否批量验证
     * @var bool
     */
    protected $batchValidate = false;

    /**
     * 控制器中间件
     * @var array
     */
    protected $middleware = [];

    /**
     * 构造方法
     * @access public
     * @param  App  $app  应用对象
     */
    public function __construct(App $app)
    {
        $this->app     = $app;
        $this->request = $this->app->request;

        // 控制器初始化
        $this->initialize();
    }

    // 初始化
    protected function initialize()
    {}

    /**
     * 验证数据
     * @access protected
     * @param  array        $data     数据
     * @param  string|array $validate 验证器名或者验证规则数组
     * @param  array        $message  提示信息
     * @param  bool         $batch    是否批量验证
     * @return array|string|true
     * @throws ValidateException
     */
    protected function validate(array $data, $validate, array $message = [], bool $batch = false)
    {
        if (is_array($validate)) {
            $v = new Validate();
            $v->rule($validate);
        } else {
            if (strpos($validate, '.')) {
                // 支持场景
                [$validate, $scene] = explode('.', $validate);
            }
            $class = false !== strpos($validate, '\\') ? $validate : $this->app->parseClass('validate', $validate);
            $v     = new $class();
            if (!empty($scene)) {
                $v->scene($scene);
            }
        }

        $v->message($message);

        // 是否批量验证
        if ($batch || $this->batchValidate) {
            $v->batch(true);
        }

        return $v->failException(true)->check($data);
    }



    /**
     * 获取当前登录用户
     * @author gt
     * @return MemberModel
     * @throws CheckException
     */
    public function member()
    {
        $token = $this->request->header('token');
        if (!$this->member) {
            if (!$token) throw new CheckException('请先登录');
            $tokenModel = MemberTokenModel::getByToken($token);
            if (!$tokenModel) throw new CheckException('请先登录');

            $member = $this->loadMemberModel($tokenModel);

            if ($member->locked())
                throw new CheckException('帐号被锁定');

            $this->member = $member;
        }

        return $this->member;
    }

    /**
     * 根据通道来选择用户模型进行登陆
     * @author gt
     * @param MemberTokenModel $memberTokenModel
     * @return BaseModel
     * @throws InternalException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    private function loadMemberModel(MemberTokenModel $memberTokenModel){
        switch ($memberTokenModel->channel){
            case MemberTokenModel::CHANNEL_USER:
                $member = UserModel::getById($memberTokenModel->member_id);
                break;
            case MemberTokenModel::CHANNEL_ADMIN:
                $member = AdminModel::getById($memberTokenModel->member_id);
                break;
            default:
                throw new InternalException("[未知登陆通道] [token: $memberTokenModel->token]");
        }
        if (!$member)
            throw new InternalException("[存在token，但登陆用户不存在] [token: $memberTokenModel->token]");
        return $member;
    }


}

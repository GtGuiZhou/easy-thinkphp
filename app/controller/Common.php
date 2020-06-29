<?php


namespace app\controller;


use app\consts\WechatConst;
use app\exceptions\CheckException;
use app\model\FileModel;
use EasyWeChat\Factory;
use think\facade\Cache;
use think\facade\Filesystem;

class Common
{
    /**
     * 微信需要验证服务器的时候填这个接口就行了
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \EasyWeChat\Kernel\Exceptions\BadRequestException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @author gt
     */
    public function wechatServerValidate()
    {
        $app = Factory::officialAccount(WechatConst::officialConfig());
        $app->server->serve()->send();
        exit();
    }

    public function fileUpload()
    {
        $file = request()->file('file');
        $fileModel = FileModel::where('md5', $file->md5())->find();
        if (!$fileModel) {
            $path = Filesystem::putFile('upload', $file, 'md5');
            $fileModel = new FileModel();
            $fileModel->type = $file->getType();
            $fileModel->driver = 'local'; // 请务必跟随filesystem配置，防止文件在下载的时候找不到正确的驱动设备
            $fileModel->url = $path;
            $fileModel->md5 = $file->md5();
            $fileModel->local_url = $path;
            $fileModel->save();
        }

        return "/file/" . $file->md5(); // 对齐下面的fileRead接口
    }

    /**
     *
     * @param string $md5
     * @param int $content 当 content 为 0 的时候就可以下载文件了
     * @return string|\think\response\File
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function fileRead(string $md5, int $content = 1)
    {
        $file = FileModel::where('md5', '=', $md5)->find();
        if ($file) {
            $rootPath = Filesystem::getDiskConfig($file->driver)['root'];
            return download($rootPath . DIRECTORY_SEPARATOR . $file->url,pathinfo($file->url,PATHINFO_FILENAME), !!$content);
        } else {
            throw new CheckException('文件不存在');
        }
    }

}
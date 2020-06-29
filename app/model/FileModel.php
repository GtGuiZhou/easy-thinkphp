<?php
declare (strict_types = 1);

namespace app\model;

use think\Model;

/**
 * 
 *
 * @mixin think\Model
 * @property int $id
 * @property string $md5
 * @property string $url 保存路径
 * @property string $create_time 创建时间
 * @property string $driver
 * @property string $local_url 本地存储路径
 */
class FileModel extends BaseModel
{
    //
    protected $table = 'file';
}

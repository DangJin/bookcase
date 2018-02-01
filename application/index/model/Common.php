<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/1/23
 * Time: 下午3:38
 */

namespace app\index\model;

use think\Model;

class Common extends Model
{

    protected $resultSetType = 'collection';
    protected $hidden
        = ['create_user', 'create_time', 'modify_user', 'modify_time', 'isdel'];

}

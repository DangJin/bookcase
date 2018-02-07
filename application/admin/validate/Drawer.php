<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/2/3
 * Time: 上午11:05
 */

namespace app\admin\validate;


use think\Validate;

class Drawer extends Validate
{
    protected $rule = [
        'number' => 'require',
        'pid' => 'require'
    ];

    protected $message = [
        'number.require' => '编号不能为空',
        'pid.require' => '所属柜子编号ID不能为空'
    ];

    protected $scene = [
        'update' => [''],
    ];
}
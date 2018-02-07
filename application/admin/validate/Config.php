<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/2/7
 * Time: 下午2:43
 */

namespace app\admin\validate;


use think\Validate;

class Config extends Validate
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
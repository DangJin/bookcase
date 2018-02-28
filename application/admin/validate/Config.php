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
        'title' => 'require',
        'body' => 'require',
        'type' => 'require',
    ];

    protected $message = [
        'title.require' => '名称不能为空',
        'body.require' => '内容不能为空',
        'type.require' => '类型不能为空',
    ];

    protected $scene = [
        'update' => [''],
    ];
}
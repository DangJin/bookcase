<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/2/7
 * Time: 下午11:14
 */

namespace app\admin\validate;


use think\Validate;

class BanImg extends Validate
{
    protected $rule = [
        'name' => 'require',
    ];

    protected $message = [
        'name.require'  =>  '图片名称不能为空',
    ];

    protected $scene = [
        'update' => [''],
    ];
}
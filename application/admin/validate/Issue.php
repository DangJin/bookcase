<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/3/5
 * Time: 下午4:53
 */

namespace app\admin\validate;


use think\Validate;

class Issue extends Validate
{
    protected $rule = [
        'type' => 'require',
    ];

    protected $message = [
        'type.require'  =>  '问题类型不能为空',
    ];

    protected $scene = [
        'update' => [''],
    ];
}
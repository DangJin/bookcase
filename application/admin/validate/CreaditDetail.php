<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/2/1
 * Time: 上午12:46
 */

namespace app\admin\validate;


use think\Validate;

class CreaditDetail extends Validate
{
    protected $rule = [
        'uid' => 'require',
    ];

    protected $message = [
        'uid.require'  =>  '用户ID不能为空',
    ];

    protected $scene = [
        'update' => [''],
    ];
}
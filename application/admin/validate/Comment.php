<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/2/1
 * Time: 下午8:52
 */

namespace app\admin\validate;


use think\Validate;

class Comment extends Validate
{
    protected $rule = [
        'uid' => 'require',
        'bid' => 'require',
    ];

    protected $message = [
        'uid.require'  =>  '用户ID不能为空',
        'bid.require'  =>  '图书ID不能为空',
    ];

    protected $scene = [
        'update' => [''],
    ];
}
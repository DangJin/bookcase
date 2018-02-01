<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/1/26
 * Time: 下午3:44
 */

namespace app\admin\validate;


use think\Validate;

class User extends Validate
{
    protected $rule = [
        'type' => 'require',
        'phone' => 'require|unique:user,isdel=0&phone=:phone',
    ];

    protected $message = [
        'type.require'  =>  '用户类型不能为空',
        'phone.require'  =>  '手机号码不能为空',
        'phone.unique'  => '此号码已被使用',
    ];

    protected $scene = [
        'update' => ['phone'],
    ];
}
<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/1/30
 * Time: 下午10:23
 */

namespace app\admin\validate;


use think\Validate;

class Order extends Validate
{
    protected $rule = [
        'number' => 'require|unique:order,isdel=0&number=:number',
        'uid' => 'require',
        'amount' => 'require',
        'type' => 'require',
    ];

    protected $message = [
        'number.require'  =>  '订单号不能为空',
        'number.unique'  =>  '订单号已经存在',
        'uid.require'  =>  '用户ID不能为空',
        'amount.require'  =>  '金额不能为空',
        'type.require'  =>  '订单类型不能为空',
    ];

    protected $scene = [
        'update' => ['number'],
    ];
}
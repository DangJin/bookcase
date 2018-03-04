<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/3/3
 * Time: 下午3:57
 */

namespace app\admin\validate;


use think\Validate;

class Memcard extends Validate
{
    protected $rule = [
        'day' => 'require',
        'name' => 'require',
        'money' => 'require',
        'num' => 'require',
    ];

    protected $message = [
        'day.require'  =>  '有效天数不能为空',
        'name.require'  =>  '阅读卡名称不能为空',
        'money.require'  =>  '阅读卡金额不能为空',
        'num.require'  =>  '可借数量不能为空',
    ];

    protected $scene = [
        'update' => [''],
    ];
}
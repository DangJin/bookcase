<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/2/2
 * Time: 上午10:48
 */

namespace app\admin\validate;


use think\Validate;

class Btype extends Validate
{
    protected $rule = [
        'name' => 'require|unique:btype,isdel=0&name=:name',
        'day' => 'require',
        'money' => 'require',
    ];

    protected $message = [
        'name.require'  =>  '名称不能为空',
        'name.unique'  =>  '名称已存在',
        'day.require' => 'require',
        'money.require' => 'require',
    ];

    protected $scene = [
        'update' => [''],
    ];
}
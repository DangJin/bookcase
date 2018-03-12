<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/1/30
 * Time: 下午5:06
 */

namespace app\admin\validate;


use think\Validate;

class Rtype extends Validate
{
    protected $rule = [
        'name' => 'require|unique:rtype,isdel=0&name=:name',
    ];

    protected $message = [
        'name.require'  =>  '名称不能为空',
        'name.unique'  =>  '名称已存在',
    ];

    protected $scene = [
        'update' => ['name'],
    ];
}
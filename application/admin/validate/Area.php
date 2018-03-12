<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/2/6
 * Time: 下午10:30
 */

namespace app\admin\validate;


use think\Validate;

class Area extends Validate
{
    protected $rule = [
        'number' => 'require',
        'name' => 'require|unique:area,isdel=0&name=:name',
        'pname' => 'require',
    ];

    protected $message = [
        'number.require'  =>  '地区编号不能为空',
        'name.require' => '地区名称不能为空',
        'name.unique' => '地区名称已存在',
        'pname.require' => '上一级地区名称不能为空',
    ];

    protected $scene = [
        'update' => [''],
    ];
}
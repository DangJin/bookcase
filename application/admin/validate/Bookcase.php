<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/2/2
 * Time: 下午10:12
 */

namespace app\admin\validate;


use think\Validate;

class Bookcase extends Validate
{
    protected $rule = [
        'name' => 'require',
        'number' => 'require',
        'province' => 'require',
        'city' => 'require',
        'county' => 'require',
        'area' => 'require',
        'lat' => 'require',
        'lng' => 'require',
    ];

    protected $message = [
        'name.require'  =>  '名称不能为空',
        'number.require'  =>  '编号不能为空',
        'province.require'  =>  '省不能为空',
        'city.require'  =>  '市不能为空',
        'county.require'  =>  '县不能为空',
        'area.require'  =>  '区域不能为空',
        'lat.require'  =>  '经度不能为空',
        'lng.require'  =>  '纬度不能为空',
    ];

    protected $scene = [
        'update' => [''],
    ];
}
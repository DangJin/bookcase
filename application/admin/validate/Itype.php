<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/3/3
 * Time: 下午4:53
 */

namespace app\admin\validate;


use think\Validate;

class Itype extends Validate
{
    protected $rule = [
        'name' => 'require',
        'imgid' => 'require',
        'imgurl' => 'require',
    ];

    protected $message = [
        'name.require'  =>  '类型名称不能为空',
        'imgid.require'  =>  '图片ID不能为空',
        'imgurl.require'  =>  '图片url不能为空',
    ];

    protected $scene = [
        'update' => [''],
    ];
}
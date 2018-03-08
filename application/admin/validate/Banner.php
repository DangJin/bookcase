<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/3/6
 * Time: 下午1:04
 */

namespace app\admin\validate;


use think\Validate;

class Banner extends Validate
{
    protected $rule = [
        'symbol' => 'require',
        'imgid' => 'require',
        'imgurl' => 'require',
    ];

    protected $message = [
        'symbol.require'  =>  'symbol不能为空',
        'imgid.require'  =>  '图片ID不能为空',
        'imgurl.require'  =>  '图片url不能为空',
    ];

    protected $scene = [
        'update' => [''],
    ];
}
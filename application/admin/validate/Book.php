<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/2/2
 * Time: 上午11:48
 */

namespace app\admin\validate;


use think\Validate;

class Book extends Validate
{
    protected $rule = [
        'title' => 'require',
        'type' => 'require',
        'isbn' => 'require|unique:book',
        'inventory' => 'number',
        'price' => 'number',
        'buyout' => 'number',
    ];

    protected $message = [
        'title.require'  =>  '书名不能为空',
        'type.require'  =>  '类型已存在',
        'isbn.require' => 'isbn不能为空',
        'isbn.unique' => '此书已存在',
        'inventory.number' => '库存量必须为整数',
        'price.number' => '价格必须为整数',
        'buyout.number' => '买断价格必须为整数',
    ];

    protected $scene = [
        'update' => [''],
    ];
}
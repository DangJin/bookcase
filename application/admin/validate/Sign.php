<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/2/1
 * Time: 上午12:54
 */

namespace app\admin\validate;


use think\Validate;

class Sign extends Validate
{
    protected $rule = [
    ];

    protected $message = [
    ];

    protected $scene = [
        'update' => [''],
    ];
}
<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/3/9
 * Time: 上午9:43
 */

namespace app\admin\validate;


use think\Validate;

class BcImg extends Validate
{
    protected $scene = [
        'update' => [''],
    ];
}
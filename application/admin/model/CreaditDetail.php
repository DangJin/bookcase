<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/1/29
 * Time: 下午7:56
 */

namespace app\admin\model;


class CreaditDetail extends Common
{
    protected $parent = ['user' => 'uid|name,id'];
}
<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/1/29
 * Time: 下午7:57
 */

namespace app\admin\model;


class Order extends Common
{
    protected $addallow = ['uid', 'amount', 'type', 'number', 'sort', 'state', 'bid'];
    protected $parent = ['user' => 'uid'];
}
<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/1/29
 * Time: 下午7:55
 */

namespace app\admin\model;


class Comment extends Common
{
    protected $parent =[
        'book' => 'bid|title,author,press'
    ];

    
}
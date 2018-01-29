<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/1/26
 * Time: 下午3:44
 */

namespace app\admin\model;


class User extends Common
{
    protected $manyToMany = [
        'wishs' => 'wish,create_user',
    ];

    protected $oneToMany = [
        'order'         => 'uid',
        'repair'        => 'uid',
        'credit_detail' => 'uid',
        'sign'          => 'create_user',
        'comment'       => 'create_user',
    ];

    protected $parent;

    public function wishs()
    {
        return $this->belongsToMany('Book', 'wish', 'bid', 'create_user');
    }

}
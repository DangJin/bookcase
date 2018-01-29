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
    protected $addallow = ['type', 'phone', 'name', 'gender', 'state', 'sort'];

    protected $upallow = ['phone', 'name', 'gender', 'state', 'sort'];

    protected $manyToMany = [
        'book'       => 'wish,create_user', #心愿单
        'books'      => 'borrow,create_user', #借阅
        'memcards'   => 'use_mem,uid', #会员卡
    ];

    protected $oneToMany = [
        'order'         => 'uid',
        'repair'        => 'uid',
        'credit_detail' => 'uid',
        'sign'          => 'create_user',
        'comment'       => 'create_user',
    ];

    protected $parent = ["wish" => 'type'];

    public function book()
    {
        $tmparr = explode(',', $this->manyToMany['book']);
        return $this->belongsToMany('Book',$tmparr[0], 'bid', $tmparr[1]);
    }

    public function books()
    {
        $tmparr = explode(',', $this->manyToMany['books']);
        return $this->belongsToMany('Books',$tmparr[0], 'bid', $tmparr[1]);
    }

    public function memcards()
    {
        $tmparr = explode(',', $this->manyToMany['memcards']);
        return $this->belongsToMany('Memcard',$tmparr[0], 'mid', $tmparr[1]);
    }

}
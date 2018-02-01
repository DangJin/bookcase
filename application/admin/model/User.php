<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/1/26
 * Time: 下午3:44
 */

namespace app\admin\model;


use think\Db;

class User extends Common
{
    protected $addallow = ['type', 'phone', 'name', 'gender', 'state', 'sort'];

    protected $upallow = ['phone', 'name', 'gender', 'state', 'sort'];

    protected $manyToMany = [
        'book'       => 'wish,create_user', #心愿单
        'books'      => 'borrow,create_user', #借阅
        'memcards'   => 'use_mem,create_user', #会员卡
    ];

    protected $oneToMany = [
        'order'         => 'uid',
        'repair'        => 'uid',
        'creadit_detail' => 'uid',
        'sign'          => 'create_user',
        'comment'       => 'create_user',
    ];

//    protected $parent = [];

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

    public function borrows($data, $page = 1, $limit = 10) {
        if (empty($data['uid'])) {
            return returnJson(607, '400', '缺少用户ID');
        }

        $result = Db::table('borrow')->alias('a')
            ->join('books bs', 'bs.id=a.bid', 'LEFT')
            ->join('book b', 'b.id=bs.pid', 'LEFT')
            ->where('a.create_user', $data['uid'])
            ->field('b.title,b.cover,b.author,b.press,bs.number,a.create_time,a.modify_time,b.state');

        if (!empty($data['state'])) {
            $result = $result->where('a.state', $data['state']);
        }

        $result = $result->paginate($limit, false, ['page' => $page]);

        return returnJson(701, 200, $result);
    }
}
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

    protected $addallow = ['uid', 'amount', 'type', 'number', 'sort', 'state', 'bid', 'modify_time', 'modify_user', 'create_time', 'create_user'];

    protected $parent = ['user' => 'uid|id,name'];

    public function getbuybook($data) {
        $page = empty($data['page']) ? 1 : $data['page'];
        $limit = empty($data['limit']) ? 10 : $data['limit'];

        $result = $this->alias('a')->where('a.type', 1)
            ->field('a.number ord_number, a.amount,a.time')
            ->join('user u', 'a.uid=u.id', 'LEFT')
            ->field('u.name user_name, u.id user_id')
            ->join('books bs', 'a.bid=bs.id', 'LEFT')
            ->join('book b', 'bs.pid=b.id', 'LEFT')
            ->field('b.title book_name, b.press book_press, b.borrow book_bornum')
            ->join('btype', 'btype.id=b.type', 'LEFT')
            ->field('btype.name type_name')
            ->paginate($limit, false, ['page' => $page]);

        return returnJson(701, 200, $result);
    }
}
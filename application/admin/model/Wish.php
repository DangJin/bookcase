<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/1/29
 * Time: 下午8:04
 */

namespace app\admin\model;


class Wish extends Common
{
    public function getwishs($data)
    {
        $page = empty($data['page']) ? 1 : $data['page'];
        $limit = empty($data['limit']) ? 10 : $data['limit'];

        $result = $this->alias('a')->field('a.create_time')
            ->join('user u', 'u.id=a.create_user', 'LEFT')
            ->field('u.name user_name, u.id user_id')
            ->join('book b', 'b.id=a.bid', 'LEFT')
            ->field('b.title book_name,b.press book_press, b.author book_author')
            ->paginate($limit, false, ['page' => $page]);

        return returnJson(701, 200, $result);
    }
}
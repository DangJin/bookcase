<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/1/29
 * Time: 下午7:54
 */

namespace app\admin\model;


class Borrow extends Common
{
    public function getborrows($data)
    {
        $page = empty($data['page']) ? 1 : $data['page'];
        $limit = empty($data['limit']) ? 10 : $data['limit'];

        $result = $this->alias('a')
            ->field('a.state bor_state')
            ->join('user u', 'a.create_user=u.id', 'LEFT')
            ->field('u.name user_name,u.id user_id')
            ->join('drawer d', 'a.bid=d.bid', 'LEFT')
            ->join('bookcase b', 'd.pid=b.id', 'LEFT')
            ->field('b.name bookcase_name, b.number bookcase_number')
            ->join('books bs', 'bs.id=a.bid', 'LEFT')
            ->field('bs.name book_name,bs.press')
            ->join('area', 'area.id=b.area', 'LEFT')
            ->field('area.name area_name,area.number area_number')
            ->paginate($limit, false, ['page' => $page]);

        return returnJson(701, 200, $result);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/1/29
 * Time: 下午7:56
 */

namespace app\admin\model;


class Drawer extends Common
{
    protected $parent = ['bookcase' => 'pid'];

    public function getOperate($data)
    {
        if (empty($data['id'])) {
            return returnJson(607, 400, '缺少id');
        }

        $result = $this->alias('a')
            ->where('a.pid', $data['id'])
            ->join('books bs', 'bs.id=a.bid', 'LEFT')
            ->join('book b', 'b.id=bs.pid', 'LEFT')
            //->field('distinct b.id')
            ->field('b.isbn, b.author,b.press,b.title')
            ->join('btype bt', 'bt.id=b.type')
            ->field('a.num, a.state, a.number')->field('bt.name tname')
            ->order('a.num desc')
            ->select();
        return returnJson(701, 200, $result);
    }
}
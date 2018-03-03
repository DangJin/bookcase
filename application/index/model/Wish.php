<?php

namespace app\index\model;

use think\Model;

class Wish extends Common
{


    /**
     * @param $uid
     * @param $bookid
     *
     * @return array|bool|false|int
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function addBook2wish($uid, $bookid)
    {
        if (empty($bookid) || empty($uid)) {
            return false;
        }

        $book = new Book();
        if ( ! $book->hasBook($bookid)) {
            return false;
        }
        $data = [
            'create_user' => $uid,
            'bid'         => $bookid,
        ];
        $data = $this->data($data)->save();

        return $data;
    }

    /**
     * 是否已经此心愿
     *
     * @param $uid
     * @param $bookid
     *
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function hasWish($uid, $bookid)
    {
        if (empty($bookid) || empty($uid)) {
            return false;
        }

        $book = new Book();
        $data = [
            'create_user' => $uid,
            'bid'         => $bookid,
        ];
        $data = $this->where($data)->find();
        if (empty($data)) {
            return true;
        }

        return false;
    }
}

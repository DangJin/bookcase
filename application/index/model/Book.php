<?php

namespace app\index\model;

use think\Model;

class Book extends Common
{

    //
    public function __construct($data = [])
    {
        parent::__construct($data);
    }


    /**
     * @param $book_id
     *
     * @return array|bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function bookInfo($book_id)
    {
        if ( ! empty($book_id) || $book_id != null) {
            // 查询图书信息
            $data = $this->where('id', $book_id)->select()->toArray();

            return $data;
        }

        return false;
    }
}

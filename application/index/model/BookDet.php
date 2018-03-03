<?php

namespace app\index\model;

use think\Model;

class BookDet extends Common
{

    //
    public function __construct($data = [])
    {
        parent::__construct($data);
    }


    /**
     * 获取图书目录
     *
     * @param $book_id
     *
     * @return array|bool
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function catelog2book($book_id)
    {
        if (empty($book_id)) {
            return false;
        }
        $data = $this->where('pid', $book_id)->find();
        if ( ! empty($data)) {
            return $data->toArray();
        }

        return false;
    }
}

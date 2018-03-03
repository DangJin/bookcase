<?php

namespace app\index\model;

use think\Model;

class Comment extends Common
{


    /**
     * @param $book_id
     *
     * @return array|bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function comment2book($book_id)
    {
        if (empty($book_id)) {
            return false;
        }
        $data = $this->where('bid', $book_id)->select()->toArray();
        if (empty($data)) {
            return false;
        }

        return $data;
    }
}

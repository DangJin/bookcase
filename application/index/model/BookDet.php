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

    public function bookMoreInfo($book_id)
    {
        if ( ! empty($book_id) || $book_id != null) {
            // 查询详细信息

        }
    }
}

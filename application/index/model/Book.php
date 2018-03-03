<?php

namespace app\index\model;

use think\Model;

class Book extends Common
{


    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
    }


    /**
     * @param $book_id
     *
     * @return array|bool
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function bookInfo($book_id)
    {
        if ( ! empty($book_id)) {
            // 查询图书信息
            $data = $this->where('id', $book_id)->find()->toArray();

            if ( ! empty($data)) {
                $comment = new Comment();
                $data['comments'] = $comment->comment2book($book_id);
            }

            return $data;
        }

        return false;
    }

    /**
     * @param $book_id
     *
     * @return array|bool
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function bookPrice($book_id)
    {
        if ( ! empty($book_id)) {
            // 查询图书信息
            $data = $this->where('id', $book_id)->field(
                "id,title,isbn,author,press,price,buyout,cover"
            )->find()->toArray();
            return $data;
        }
        return false;
    }


    /**
     * 查看是否存在
     *
     * @param $book_id
     *
     * @return array|bool|false|\PDOStatement|string|\think\Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function hasBook($book_id)
    {
        if (empty($book_id)) {
            return false;
        }
        $data = $this->where('id', $book_id)->find();
        if (empty($data)) {
            return false;
        }

        return $data;
    }
}
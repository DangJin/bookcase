<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/1/29
 * Time: 下午7:55
 */

namespace app\admin\model;


class Comment extends Common
{
    protected $parent =[
        'book' => 'bid|title,author,press'
    ];

    public function searchByName($data, $page = 1, $limit = 10)
    {
        if (empty($data['isbn'])) {
            return returnJson(607, 400, 'isbn不能为空');
        }

        $book = $this->table('book')->where('isbn', $data['isbn'])->find();
        if (is_null($book)) {
            return returnJson(607, 400, '没有此书');
        }
        $comment = $this->where('bid', $book->getAttr('id'))->paginate($limit, false, ['page' => $page]);
        $comment = $comment->toArray();

        $tmp = [
            'title' => $book->getAttr('title'),
            'isbn' => $book->getAttr('isbn'),
            'press' => $book->getAttr('press'),
            'author' => $book->getAttr('author')
        ];

        foreach ($comment['data'] as &$item) {
            $item['bid'] = $tmp;
        }

        return returnJson(701, 200, $comment);
    }
}
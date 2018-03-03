<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/1/29
 * Time: 下午7:52
 */

namespace app\admin\model;


class Book extends Common
{

    protected $upallow = ['title', 'type', 'isbn', 'cover', 'details', 'buyout', 'price', 'author', 'press', 'pubdate', 'modify_time', 'modify_user'];
    protected $parent = [
        'btype' => 'type'
    ];

    public function add($data)
    {
        if (empty($data)) {
            return returnJson(602, 400, '添加参数不能为空');
        }
        if (!empty($data['inventory']) && (!is_numeric($data['inventory']) || (int)$data['inventory'] > 1000)) {
            dump($data['inventory']);
            return returnJson(602, 400, '库存量为整数且不能大于1000');
        }

        if (empty($data['price'])) {
            return returnJson(602, 400, '价格不能为空');
        }

        if (empty($data['sacle'])) {
            return returnJson(602, 400, '折扣不能为空');
        } elseif (preg_match('/^\d+$/i', $data['sacle']) && ((int)$data['sacle'] < 1 || (int)$data['sacle'] > 100)) {
            return returnJson(602, 400, '折扣按百分比计算且折扣区间为[1,100]');
        }
        $data['buyout'] = (int)$data['price'] * (int)$data['sacle'];

        $data['create_user'] = session('sId');
        $data['modify_user'] = session('sId');

        $this->startTrans();
        try {
            //添加主表
            $result = $this->validate(true)->allowField($this->addallow)->validate(true)->save($data);
            if ($result == false)
                return returnJson(603, 400, $this->getError());
            if (!empty($data['inventory'])) {
                $tmpData = [
                    'pid' => $this->getAttr('id'),
                    'name' => $this->getAttr('title'),
                    'press' =>  $this->getAttr('press'),
                    'author' =>  $this->getAttr('author')
                ];
                $this->table('books')->insertAll($this->createBooks($tmpData, (int)$data['inventory']));
            }
            $this->commit();
        } catch (\Exception $e) {
            $this->rollback();
            return returnJson(603, 400, $e->getMessage());
        }  catch (\Error $e) {
            $this->rollback();
            return returnJson(603, 400, $e->getMessage());
        }
        return returnJson(702, 200, $this->toArray());
    }

    public function addinv($data) {
        if (empty($data['id'])) {
            return returnJson(602, 400, 'id不能为空');
        }

        if (empty($data['num'])) {
            return returnJson(602, 400, '数量不能为空');
        } elseif (preg_match('/^\d+$/i', $data['num']) && ((int)$data['num'] < 1 || (int)$data['num'] > 1000)) {
            return returnJson(602, 400, '数量为整数且不超过1000');
        }

        $book = $this->where('id', $data['id'])->field('title,author,press')->find();
        if (is_null($book)) {
            return returnJson(602, 400, '没有此书');
        }

        $book->inventory += $data['num'];
        $book->isUpdate(true)->save();
        
        $tmpData = [
            'name' => $book->getAttr('title'),
            'author' => $book->getAttr('author'),
            'press' => $book->getAttr('press')
        ];
        $books = new Books;
        $result = $books->insertAll($this->createBooks($tmpData, (int)$data['num']));
        if (false === $result)
            return returnJson(603, 400, $books->getError());

        return returnJson(702, 200, $book->toArray());
    }

    private function createBooks($data, $num)
    {
        $books = [];
        $no = 'bk';
        $time = strtotime('now');
        $date = date('Y-m-d H:i:s', $time);
        for ($i = 0; $i < $num; $i++) {
            $tmp = $data;
            $tmp['number'] = $no.$time.$this->num2str($i, 3);
            $tmp['create_user'] = session('id');
            $tmp['modify_user'] = session('id');
            $tmp['create_time'] = $date;
            $tmp['modify_time'] = $date;
            array_push($books, $tmp);
        }
        return $books;
    }

    private function num2str($num,$length)
    {
        $num_str = (string)$num;
        $num_strlength = count($num_str);
        if ($length > $num_strlength) {
            $num_str=str_pad($num_str,$length,"0",STR_PAD_LEFT);
        }
        return $num_str;
    }

    public function getDateRank($data)
    {
        $page = empty($data['page']) ? 1 : $data['page'];
        $limit = empty($data['limit']) ? 10 : $data['limit'];
        $stime = empty($data['stime']) ? false : strtotime($data['stime']);
        $etime = empty($data['stime']) ? false : strtotime($data['etime']);

        if (!$stime || !$etime) {
            return returnJson(608, 400, '时间参数错误');
        }

        $borrow = new Borrow;

        $result = $borrow->alias('a')
            ->whereTime('a.create_time', 'between', [$stime, $etime])
            ->group('a.pid')
            ->field('count(a.pid) num')
            ->order('num desc')
            ->join('book b', 'b.id=a.pid')
            ->field('b.title, b.author, b.press, b.id book_id')
            ->paginate($limit, false, ['page' => $page]);

        return returnJson('702', '200', $result);
    }

    public function getTimeRank($data)
    {
        $page = empty($data['page']) ? 1 : $data['page'];
        $limit = empty($data['limit']) ? 10 : $data['limit'];

        $order = new Order;
        $result = $order->alias('a')
            ->where('a.type', 4)
            ->group('a.pid')
            ->field('sum(a.time) total_time')
            ->order('total_time desc')
            ->join('book b', 'b.id=a.pid')
            ->field('b.title, b.author, b.press, b.id book_id')
            ->paginate($limit, false, ['page' => $page]);

        return returnJson('702', '200', $result);
    }

    public function getAmountRank($data)
    {
        $page = empty($data['page']) ? 1 : $data['page'];
        $limit = empty($data['limit']) ? 10 : $data['limit'];

        $order = new Order;
        $result = $order->alias('a')
            ->where('a.type', 4)
            ->group('a.pid')
            ->field('sum(a.amount) total_amount')
            ->order('total_amount desc')
            ->join('book b', 'b.id=a.pid')
            ->field('b.title, b.author, b.press, b.id book_id')
            ->paginate($limit, false, ['page' => $page]);

        return returnJson('702', '200', $result);
    }

    public function getBuyRank($data)
    {
        $page = empty($data['page']) ? 1 : $data['page'];
        $limit = empty($data['limit']) ? 10 : $data['limit'];

        $order = new Order;
        $result = $order->alias('a')
            ->where('a.type', 1)
            ->group('a.pid')
            ->field('count(a.pid) total_num')
            ->order('total_num desc')
            ->join('book b', 'b.id=a.pid')
            ->field('b.title, b.author, b.press, b.id book_id')
            ->paginate($limit, false, ['page' => $page]);

        return returnJson('702', '200', $result);
    }

}
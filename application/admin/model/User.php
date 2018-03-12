<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/1/26
 * Time: 下午3:44
 */

namespace app\admin\model;


use think\Db;

class User extends Common
{
    protected $addallow = ['type', 'phone', 'name', 'gender', 'state', 'sort', 'modify_time', 'modify_user', 'create_time', 'create_user'];

    protected $upallow = ['phone', 'name', 'gender', 'state', 'sort', 'modify_time', 'modify_user'];

    protected $manyToMany = [
        'book'       => 'wish,create_user', #心愿单
        'books'      => 'borrow,create_user', #借阅
        'memcards'   => 'use_mem,create_user', #会员卡
    ];

    protected $oneToMany = [
        'order'         => 'uid',
        'repair'        => 'uid',
        'creadit_detail' => 'uid',
        'sign'          => 'create_user',
        'comment'       => 'create_user',
    ];

//    protected $parent = [];

    public function book()
    {
        $tmparr = explode(',', $this->manyToMany['book']);
        return $this->belongsToMany('Book',$tmparr[0], 'bid', $tmparr[1]);
    }

    public function books()
    {
        $tmparr = explode(',', $this->manyToMany['books']);
        return $this->belongsToMany('Books',$tmparr[0], 'bid', $tmparr[1]);
    }

    public function memcards()
    {
        $tmparr = explode(',', $this->manyToMany['memcards']);
        return $this->belongsToMany('Memcard',$tmparr[0], 'mid', $tmparr[1]);
    }

    public function borrows($data, $page = 1, $limit = 10) {
        if (empty($data['uid'])) {
            return returnJson(607, '400', '缺少用户ID');
        }

        $result = Db::table('borrow')->alias('a')
            ->join('books bs', 'bs.id=a.bid', 'LEFT')
            ->join('book b', 'b.id=bs.pid', 'LEFT')
            ->where('a.create_user', $data['uid'])
            ->field('b.title,b.cover,b.author,b.press,bs.number,a.create_time,a.modify_time,b.state');

        if (!empty($data['state'])) {
            $result = $result->where('a.state', $data['state']);
        }

        $result = $result->paginate($limit, false, ['page' => $page]);

        return returnJson(701, 200, $result);
    }

    public function add($data)
    {

        if (empty($data)) {
            return returnJson(602, 400, '添加参数不能为空');
        }

        $data['create_user'] = session('id');
        $data['modify_user'] = session('id');

        if (!empty($data['type']) && $data['type'] == 2) {
            if (empty($data['phone'])) {
                return returnJson(602, 400, '管理员必须填写手机号');
            }
            $count = $this->where('phone', $data['phone'])->where('type', 2)->count();
            if ($count > 0)
                return returnJson(602, 400, '此手机号已经存在');
        }

        if (!empty($data['type']) && $data['type'] == 3) {
            if (empty($data['phone'])) {
                return returnJson(602, 400, '巡检员必须填写手机号');
            }
            $count = $this->where('phone', $data['phone'])->where('type', 3)->count();
            if ($count > 0)
                return returnJson(602, 400, '此手机号已经存在');
        }

        $this->startTrans();
        try {
            //添加主表
            $result = $this->validate(true)->allowField($this->addallow)->validate(true)->save($data);
            if ($result == false)
                return returnJson(603, 400, $this->getError());
            //添加关联中间表
            if (!empty($this->manyToMany)) {
                foreach (array_keys($this->manyToMany) as $c) {
                    if (in_array($c, array_keys($data))) {
                        $tmpArr = explode(',', $data[$c]);
                        $tmpArr = array_filter($tmpArr);
                        $tmpArr = array_unique($tmpArr);
                        $this->$c()->saveAll($tmpArr);
                    }
                }
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
}
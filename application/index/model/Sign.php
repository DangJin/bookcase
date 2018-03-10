<?php

namespace app\index\model;

use think\Model;

class Sign extends Common
{


    /**
     * @param $uid
     *
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function isSign($uid)
    {
        $data = $this->whereTime('create_time', 'd')->where('create_user', $uid)
            ->find();
        if (empty($data)) {
            return 0;
        }
        return 1;
    }


    /**
     * @param $uid
     *
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function lastIsSign($uid)
    {
        $data = $this->whereTime('create_time', 'yesterday')->where(
            'create_user', $uid
        )
            ->find();
        if (empty($data)) {
            return false;
        }

        return true;
    }

    /**
     * @param $uid
     *
     * @return false|int
     */
    public function sign($uid)
    {
        $sign = [
            'create_user' => $uid,
        ];
        $data = $this->data($sign)->save();

        return $data;
    }
}

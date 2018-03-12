<?php

namespace app\index\model;

use think\Model;

class Config extends Common
{


    /**
     * @param $type
     *
     * @return array|bool
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getSignRule($type)
    {
        $data = $this->field('body')->where('title', $type)->find();
        if ( ! empty($data)) {
            return $data->getAttr('body');
        }

        return false;
    }


    /**
     * @return bool|mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getPayNum()
    {
        $data = $this->field('id,body')->where('type', 'RECHARGE')->select();
        if ( ! empty($data)) {
            return returnJson(888, 200, $data);
        }

        return false;
    }

    public function getDeposit()
    {
        $data = $this->field('id,body')->where('type', 'DEPOSIT')->select();
        if ( ! empty($data)) {
            return returnJson(888, 200, $data);
        }

        return false;
    }


}

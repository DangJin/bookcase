<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/1/23
 * Time: 下午3:38
 */

namespace app\index\model;


use think\Exception;

class User extends Common
{

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
    }


    /**
     * @param $uid
     * @param $coin
     * @param $sign
     *
     * @return bool
     * @throws \think\exception\PDOException
     */
    public function upSignService($uid, $coin, $sign)
    {
        $this->startTrans();
        try {
            // 修改阅读币
            $this->where('id', $uid)->setInc('coin', $coin);
            if ($sign) {
                $this->where('id', $uid)->setInc('sign', $sign);
            } else {
                $this->where('id', $uid)->setField('sign', 1);
            }
            $this->commit();

            return true;
        } catch (Exception $exception) {
            $this->rollback();

            return false;
        }
    }

    public function resetSign($uid)
    {
        $this->where('id', $uid)->setField('sign', 0);
    }
}
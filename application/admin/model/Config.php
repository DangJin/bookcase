<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/1/29
 * Time: 下午7:55
 */

namespace app\admin\model;


class Config extends Common
{
    public function upcredit($data)
    {
        if (empty($data['id'])) {
            return returnJson(606, 400, '缺少主键');
        }

        $config = Config::get($data['id']);

        if ($config->getAttr('type') != 'CREDIT') {
            return returnJson(606, 400, '修改类型错误');
        }

        if (!empty($data['body']))
            $config->body = $data['body'];

        $result = $config->save();

        if (false === $result)
            return returnJson(606, 400, $config->getError());

        return returnJson(704, 200, '更新成功');
    }

    public function addDeposit($data)
    {
        if (empty($data['money'])) {
            return returnJson(607, 400, '缺少押金参数');
        }

        if (empty($data['num'])) {
            return returnJson(607, 400, '缺少可借数量参数');
        }

        $data['body'] = $data['money'].','.$data['num'];
        $data['type'] = 'DEPOSIT';
        $this->validate(true)->allowField(true)->save($data);
        return returnJson(702, 200, $this);
    }

    public function updateDeposit()
    {

    }

}
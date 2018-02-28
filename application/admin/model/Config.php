<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/1/29
 * Time: 下午7:55
 */

namespace app\admin\model;


use think\Request;

class Config extends Common
{
    public function upcredit($data)
    {
        if (empty($data['id'])) {
            return returnJson(606, 400, '缺少主键');
        }

        $config = Config::get($data['id']);
        if (is_null($config))
            return returnJson(607, 400, '没有此数据');

        if ($config->getAttr('type') != 'CREDIT') {
            return returnJson(606, 400, '修改类型错误');
        }

        if (!empty($data['body']))
            $config->body = $data['body'];

        $result = $config->isUpdate(true)->save();

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
        $result = $this->validate(true)->allowField(true)->save($data);
        if ($result == false)
            return returnJson(603, 400, $this->getError());
        return returnJson(702, 200, $this);
    }

    public function upDeposit($data)
    {
        if (empty($data['id'])) {
            return returnJson(606, 400, '缺少主键');
        }

        $config = Config::get($data['id']);

        if (is_null($config))
            return returnJson(607, 400, '没有此数据');

        if ($config->getAttr('type') != 'DEPOSIT') {
            return returnJson(606, 400, '修改类型错误');
        }

        if ((!empty($data['num']) && empty($data['money'])) || (empty($data['num']) && !empty($data['money']))) {
            return returnJson(606, 400, 'money和num必须统一传入');
        }

        if (!empty($data['num'])) {
            $config->body = $data['money'].','.$data['money'];
        }

        if (!empty($data['title'])) {
            $config->title = $data['title'];
        }
        $result = $config->isUpdate(true)->save();
        if (false === $result)
            return returnJson(606, 400, $config->getError());
        return returnJson(704, 200, '更新成功');
    }

    public function delDeposit($data) {
        if (empty($data['id'])) {
            return returnJson(604, 400, '缺少id');
        }

        $config = Config::get($data['id']);
        if (is_null($config))
            return returnJson(607, 400, '没有此数据');

        if ($config->getAttr('type') != 'DEPOSIT') {
            return returnJson(606, 400, '删除类型错误');
        }

        $config->delete();
        return returnJson(703, 200, '删除成功');
    }

    public function sesame($data)
    {
        if (empty($data['id'])) {
            return returnJson(604, 400, '缺少id');
        }

        $config = Config::get($data['id']);
        if (is_null($config))
            return returnJson(607, 400, '没有此数据');

        if ($config->getAttr('type') != 'SESAME') {
            return returnJson(606, 400, '删除类型错误');
        }

        $config->isUpdate(true)->allowField(true)->save($data);
        return returnJson(704, 200, '修改成功');
    }


}
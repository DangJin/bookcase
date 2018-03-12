<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/1/29
 * Time: 下午7:53
 */

namespace app\admin\model;


class Books extends Common
{
    public function del($data, $softdel = true)
    {
        if (!isset($data['ids']) && empty($data['ids']))
        {
            return returnJson(604, 400, '缺少删除参数');
        }
        $this->where('id', 'in', $data['ids'])->delete();
        return returnJson(703, 200, '删除成功');
    }

    public function delall($data)
    {
        if (empty($data['pid']))
        {
            return returnJson(604, 400, '缺少删除参数');
        }

        $this->table('book')->where('id', $data['pid'])->update([
            'inventory' => 0
        ]);
        $this->where('pid', $data['pid'])->delete();

        return returnJson(703, 200, '删除成功');
    }
}
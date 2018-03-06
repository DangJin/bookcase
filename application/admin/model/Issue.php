<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/3/2
 * Time: 下午3:41
 */

namespace app\admin\model;


class Issue extends Common
{
    protected $parent = [
        'itype' => 'type'
    ];

    public function del($data, $softdel = true)
    {
        if (!isset($data['ids']) && empty($data['ids'])) {
            return returnJson(604, 400, '缺少删除参数');
        }

        $this->where('id', 'in', $data['ids'])->delete();

        return returnJson(703, 200, '删除成功');

    }
}
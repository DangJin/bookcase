<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/3/3
 * Time: 下午4:42
 */

namespace app\admin\model;


class Itype extends Common
{
    public function del($data, $softdel = true)
    {
        if (!isset($data['ids']) && empty($data['ids']))
        {
            return returnJson(604, 400, '缺少删除参数');
        }

        $arr = explode(',', $data['ids']);
        $arr = array_filter($arr);
        $arr = array_unique($arr);

        foreach ($arr as $item) {
            $itype = Itype::get($item);
            if (!is_null($itype)) {
                $img = ItypeImg::get($itype->getAttr('imgid'));
                unlink($img->getAttr('path'));
                $img->delete();
                $itype->delete();
            }
        }
    }
}
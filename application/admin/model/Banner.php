<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/3/6
 * Time: 上午10:29
 */

namespace app\admin\model;


class Banner extends Common
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
            $banner = Banner::get($item);
            if (!is_null($banner)) {
                $img = BanImg::get($banner->getAttr('imgid'));
                unlink($img->getAttr('path'));
                $img->delete();
                $banner->delete();
            }
        }
    }
}
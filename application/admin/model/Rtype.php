<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/1/29
 * Time: 下午8:02
 */

namespace app\admin\model;


class Rtype extends Common
{
    protected $oneToMany = [
        'repair'   => 'type',
    ];

//    public function del($data, $softdel = true)
//    {
//        if (!isset($data['ids']) && empty($data['ids']))
//        {
//            return returnJson(604, 400, '缺少删除参数');
//        }
//
//        $arr = explode(',', $data['ids']);
//        $arr = array_filter($arr);
//        $arr = array_unique($arr);
//
//        foreach ($arr as $item) {
//            $rtype = Rtype::get($item);
//            if (!is_null($rtype)) {
//                $img = RepImg::get($rtype->getAttr('imgid'));
//                unlink($img->getAttr('path'));
//                $img->delete();
//                $rtype->delete();
//            }
//        }
//    }
}
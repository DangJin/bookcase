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

    public function select($data, $page = 1, $limit = 10, $all = '')
    {
        if (!empty($data['order'])) {
            $result = $this->order($data['order']);
        } else {
            $result = $this->order('sort desc');
        }

        //多条件查询
        $map = [];
        if (isset($data['search']) && !empty($data['search'])) {
            if (preg_match('/^[0-9]+$/', $data['search'])) {
                $condi = (int)$data['search'];
            } else {
                $condi = ['like', '%'.$data['search'].'%'];
            }
            if (isset($data['searchForField']) && !empty($data['searchForField'])) {
                $tmp = explode(',', $data['searchForField']);
                $tmp = array_unique($tmp);
                $tmp = array_filter($tmp);
                foreach ($tmp as $item) {
                    $map[$item] = $condi;
                }
                $result->where(function ($query) use ($map) {
                    $query->whereOr($map);
                });
            }
        }

        //筛选条件数组
        $map = [];
        if (!empty($data)) {
            foreach (array_keys($data) as $key) {
                if (in_array($key, $this->getTableFields())) {
                    $pos = stripos($data[$key], ',');
                    if ($pos && $pos != strlen($data[$key])) {
                        $map[$key] = explode(',', $data[$key]);
                    } else {
                        $map[$key] = $data[$key];
                    }
                }
            }
        }


        //查询条件形式
        if (!empty($map)) {
            if (isset($data['and']) && $data['and'] == 1) {
                $result = $result->where(function ($query) use ($map) {
                    $query->where($map);
                });
            } else {
                $result = $result->whereOr(function ($query) use ($map) {
                    $query->whereOr($map);
                });
            }
        }

        $result = $result->where('isdel', '<>', '1');

        try {
            //查询全部数据（不分页）
            if (isset($data['all']) && $data['all'] == 1) {
                if (empty($all)) {
                    $count = $result->count();
                    return $this->select($data, $page, $limit, $count + 1);
                }
                $result = $result->paginate($all - 1, false, ['page' => 1]);
            } else {
                $result = $result->paginate($limit, false, ['page' => $page]);
            }
            $result = $result->toArray();

            //查询父表数据
            foreach ($result['data'] as &$item) {
                $iarr = explode(',', $item['imgid']);
                $iarr = array_filter($iarr);
                $iarr = array_unique($iarr);
                foreach ($iarr as $itemImg) {
                    $item['imgid'] = $this->table('ban_img')->where('id', $itemImg)->field('id,imgurl')->find();
                }
            }


            return returnJson(701, 200, $result);
        } catch (Exception $e) {
            return returnJson(601,400, $e->getMessage());
        }
    }

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
                $iarr = explode(',', $banner->getAttr('imgid'));
                $iarr = array_filter($iarr);
                $iarr = array_unique($iarr);
                foreach ($iarr as $itemImg) {
                    $img = BanImg::get($itemImg);
                    unlink($img->getAttr('path'));
                    $img->delete();
                }
                $banner->delete();
            }
        }
    }
}
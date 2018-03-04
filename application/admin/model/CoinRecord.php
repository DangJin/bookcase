<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/3/2
 * Time: 下午2:47
 */

namespace app\admin\model;


class CoinRecord extends Common
{
    public function getDetails($page, $limit)
    {
        $result = $this->alias('cr')
            ->field('cr.num, cr.type')
            ->join('user u', 'u.id=cr.uid')
            ->field('u.name, u.phone, u.coin')
            ->paginate($limit, false, ['page' => $page]);
        $result = $result->toArray();
        $result['send'] = $this->whereTime('create_time', 'm')
            ->whereTime('type', 1)->count();
        $result['used'] = $this->whereTime('create_time', 'm')
            ->whereTime('type', 2)->count();
        return returnJson(701, 200, $result);
    }
}
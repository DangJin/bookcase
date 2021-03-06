<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function returnJson($code, $status, $value = '')
{
    if ($status > 300) {
        return json(
            [
                'code'   => $code,
                'status' => $status,
                'msg'    => $value,
            ]
        );
    } else {
        return json(
            [
                'code'   => $code,
                'status' => $status,
                'data'   => $value,
            ]
        );
    }
}

function array_get($array, $key)
{
    if (array_key_exists($key, $array)) {
        return $array[$key];
    }
}

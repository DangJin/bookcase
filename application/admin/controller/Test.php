<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/2/1
 * Time: 上午12:23
 */

namespace app\admin\controller;


class Test
{
    public function test(){
        $a = ['wang' => 1];
        $b = ['zhang' => 2];
        $c = array_merge($a, $b);
        dump($c);
    }
}
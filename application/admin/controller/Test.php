<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/2/1
 * Time: 上午12:23
 */

namespace app\admin\controller;


use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use think\Db;
use think\Request;

class Test extends Common
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
    }

    public function test()
    {
        $micro = microtime();
        echo  $micro;
        $micro = explode(' ', $micro);
        echo $micro[1] . substr(explode('.', $micro[0])[1], 0, -2);
    }

    public function createQrcode()#$filename, $data)
    {
        $result = Db::table('book')->alias('b')->where('title', 'like', '123'.'%')
            ->join('drawer d', 'd.book=b.id')
            ->join('bookcase bc', 'bc.id=d.pid')
            ->field('bc.*');
        return json($result);
    }
}

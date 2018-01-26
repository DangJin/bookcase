<?php
/**
 * Created by PhpStorm.
 * User: wry
 * Date: 18/1/26
 * Time: 下午3:40
 */

namespace app\admin\controller;


use think\Request;

class User extends Common
{
    private $user;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->user = new \app\admin\model\User();
    }

    public function select()
    {
        return $this->user->select([]);
    }
}
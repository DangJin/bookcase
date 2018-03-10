<?php
/**
 * Created by PhpStorm.
 * User: DangJin
 * Date: 2018-03-10
 * Time: 21:32
 */

namespace app\wechat\controller;


use think\Request;

class Menu extends Common
{

    public function __construct(\think\Request $request = null)
    {
        parent::__construct($request);
    }

    public function currentMenu()
    {
        $menu = $this->app->menu->current();

        if (array_key_exists("errcode", $menu)) {
            if ($menu['errcode'] === 46003) {
                return returnJson(200, 200, ['button' => []]);
            }
        }

        return returnJson(200, 200, $menu);
    }

    public function addMenu(Request $request)
    {
        $menu = $request->param("menus");

        $res = $this->app->menu->create($menu);

        return returnJson(200, 200, $res);
    }

    public function delMenu(Request $request)
    {
        $mId = $request->param("mid");
        if ($mId) {
            $res = $this->app->menu->delete($mId);

            return returnJson(200, 200, $res);
        }

        $res = $this->app->menu->delete();

        return returnJson(200, 200, $res);
    }
}
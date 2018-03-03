<?php
/**
 * Created by PhpStorm.
 * User: DangJin
 * Date: 2018-01-29
 * Time: 23:11
 */

namespace app\wechat\controller;


use think\Request;

class JsSdk extends Common
{

    public function __construct(\think\Request $request = null)
    {
        parent::__construct($request);
    }


    /**
     * 获取jssdk
     *
     * @param \think\Request $request
     *
     * @return \think\response\Json
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getWxConfig(Request $request)
    {
        $jsApiList = $request->param('jsApiList');
        $url       = $request->param('url');
        $debug     = $request->param('debug');
        if (empty($debug)) {
            $debug = 0;
        }
        if (empty($jsApiList) || empty($url)) {
            return returnJson(400, 400, 'jsApiList 不得为空 / NULL');
        }
        $this->app->jssdk->setUrl($url);
        $config = $this->app->jssdk->buildConfig(
            explode(",", $jsApiList),
            $debug
        );

        return returnJson(200, 200, json_decode($config));
    }
}
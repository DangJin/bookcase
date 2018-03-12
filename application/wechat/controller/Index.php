<?php

namespace app\wechat\controller;

use app\wechat\handler\TextHandler;
use think\Log;

class Index extends Common
{

    public function __construct(\think\Request $request = null)
    {
        parent::__construct($request);
    }


    /**
     * @throws \EasyWeChat\Kernel\Exceptions\BadRequestException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function index()
    {
        // 得到服务端应用实例
        $server = $this->app->server;
//                $server->push(TextHandler::class);
        $server->push(
            function ($message) {
                Log::info("消息回复");
                Log::info($message);
                return "你发一条消息";
            }
        );
        $response = $server->serve();
        $response->send();
        return $response;
    }
}

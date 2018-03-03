<?php

namespace app\index\controller;

use app\index\model\Config;
use app\index\model\User;
use BaconQrCode\Common\Mode;
use think\Controller;
use think\Request;
use think\Session;

class Sign extends Common
{


    /**
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function sign()
    {
        //        $uid=Session::get('user_id');
        $uid         = 4;
        $config      = new \app\index\model\Config();
        $sign        = new \app\index\model\Sign();
        $signService = new User();
        if ($sign->isSign($uid)) {
            return returnJson(200, 200, '今日已打卡');
        }
        if ($sign->sign($uid)) {
            if ($sign->lastIsSign($uid)) {
                if ($signService->upSignService(
                    $uid, $config->getSignRule('sign_days'), true
                )
                ) {
                    return returnJson(
                        200,
                        200,
                        '打卡成功，获取'.$config->getSignRule(
                            'sign_days'
                        ).'阅读币'

                    );
                }
            }

            if ($signService->upSignService(
                $uid, $config->getSignRule('sign_day'), false
            )
            ) {
                return returnJson(
                    200,
                    200,
                    '打卡成功，获取'.$config->getSignRule('sign_day').'阅读币'
                );
            }
        } else {
            return returnJson(
                400,
                400,
                '打卡失败'
            );
        }
    }
}

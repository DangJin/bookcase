<?php
/**
 * Created by PhpStorm.
 * User: DangJin
 * Date: 2018-01-29
 * Time: 22:20
 */

namespace app\wechat\handler;


use EasyWeChat\Kernel\Contracts\EventHandlerInterface;
use think\Log;

class TextHandler implements EventHandlerInterface {

	/**
	 * @param null $payload
	 *
	 * @return string
	 */
	public function handle( $payload = NULL ) {
		// TODO: Implement handle() method.
		Log::info( "发送消息" );
		return "你发一条消息";
	}
}
<?php

namespace app\util\controller;

use think\Config;
use think\Controller;
use think\Request;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend;
use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use think\exception\ErrorException;

class Alidayu extends Common {

	private $alidy_config;
	private $alidy_params;

	public function __construct( Request $request = NULL ) {
		parent::__construct( $request );
		$this->alidy_config = Config::get( 'alidayu.config' );
		$this->alidy_params = Config::get( 'alidayu.params' );
	}

	/**
	 * 发送验证码
	 *
	 * @param \think\Request $req
	 *
	 * @return \think\response\Json
	 */
	public function sendCode( Request $req ) {
		$phone    = input( 'post.phone' );
		$rand_num = $this->validCode();
		if ( empty( $phone ) || $phone === NULL ) {
			return returnJson( 400, 400, '参数为空' );
		}
		if ( $this->alidy_config === NULL || empty( $this->alidy_config ) ) {
			return returnJson( 400, 400, 'alidy_config 参数为空/NULL' );
		}
		if ( $this->alidy_params === NULL || empty( $this->alidy_params ) ) {
			return returnJson( 400, 400, 'alidy_params 参数为空/NULL' );
		}
		try {
			$client = new Client( new App( $this->alidy_config ) );
			$req    = new AlibabaAliqinFcSmsNumSend;
			$req->setRecNum( input( 'post.phone' ) )->setSmsParam( [
				$this->alidy_params['sms_param'] => $rand_num,
			] )->setSmsFreeSignName( $this->alidy_params['sign_name'] )
			    ->setSmsTemplateCode( $this->alidy_params['template_code'] );
			$resp = $client->execute( $req );
			if ( $resp->result->success ) {
				return returnJson( 200, 200, $rand_num );
			}
		} catch ( \Exception $e ) {
			if ( $resp->sub_code === "isv.AMOUNT_NOT_ENOUGH" ) {
				// 更新状态
				$this->global_status->updateStatus( 'alidayu', 400,
					'因余额不足未能发送成功，请登录管理中心充值后重新发送' );
			}
			return returnJson( 400, 400, $resp->msg );
		}
	}

	/**
	 * 生成验证码
	 *
	 * @return int
	 */
	public function validCode() {
		$rand_num = rand( 100000, 999999 );
		session( 'valid_code', $rand_num );

		return $rand_num;
	}
}

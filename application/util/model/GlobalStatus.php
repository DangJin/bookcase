<?php

namespace app\util\model;

use think\exception\DbException;
use think\Model;

class GlobalStatus extends Model {

	//
	protected $pk = 'id';

	public function updateStatus( $name, $status, $msg ) {
		return $this->save( [ 'status' => $status, 'msg' => $msg ],
			[ 'name' => $name ] );
	}

	public function getStatus( $name ) {
		try {
			$data = $this->where( 'name', $name )->field( 'name,status,msg' )
			             ->find()->getData();

			// 组建数据结构
			$ret_obj = [
				$name => [
					'status' => $data['status'],
					'msg'    => $data['msg'],
				],
			];

			return $ret_obj;
		} catch ( DbException $e ) {
			throw new Exception( $e );
		}
	}
}

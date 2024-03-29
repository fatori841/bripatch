<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('get_redis_conn')) {
	function get_redis_conn($conn_name)
	{
		$ci   =& get_instance();
		
		$config['brimo_redis'] = array(
			'host' => 'brimo-dbs-clsrds-prd.bri.co.id',
			'port' => '11000',
			'auth' => 'redis123'
		);
		
		try{
			$redis = new Redis();
			$redis->connect($config[$conn_name]['host'],$config[$conn_name]['port']);
			$redis->auth($config[$conn_name]['auth']);
			
			return $redis;
		}
		catch(Exception $e){
			return 'Error Message : '.$e->getMessage();
		}

	}
}
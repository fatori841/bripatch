<?php 	
defined('BASEPATH') OR exit('No direct script access allowed');

class Tes_redis extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index()
	{		
		$this->load->helper('redis_conn');
		$redis = get_redis_conn('brimo_redis');
		
		echo $redis->ping();
		//echo $redis->get("ibank.tbl_parameters:BRIMO_INSURANCE_ALL");
		//echo $redis->delete("ibank.tbl_bank:ALL");
		//echo $redis->keys("*");
	}


}

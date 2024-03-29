<?php 	
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	public function page_404()
	{		
		$this->load->view('errors/html/error_404');
	}


}

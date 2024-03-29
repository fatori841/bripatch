<?php 	
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Menu_model');
	}

	public function index()
	{
		if (!$this->session->has_userdata('ibo_is_login')) {
			redirect('User/login');
		} else {
			redirect('Home/beranda');
		}
	}
	
	public function beranda()
	{
		if (!$this->session->has_userdata('ibo_is_login')) {
			$message = 'Session has expired, please re-login';
			echo "<SCRIPT>alert('$message');window.location='".site_url('User/login')."';</SCRIPT>";
		}

		$data_menu = $this->Menu_model->get_menu_beranda();
		$data_menu_result = $data_menu->result();

		$arr_data = array(
			'menu'=>$data_menu_result
		);
		$data['isi'] = $this->load->view('home/beranda', $arr_data, true);
		
		$this->load->view('template/template_beranda',$data);
	}


}

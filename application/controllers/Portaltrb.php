<?php 	
defined('BASEPATH') OR exit('No direct script access allowed');

class Portaltrb extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Menu_model');
		//$this->load->model('Portaltrb_model');
		$this->load->model('Micro_model');
	}

	public function index()
	{
		if (!$this->session->has_userdata('ibo_is_login')) {
			redirect('User/login');
		} else {
			$data_menu = $this->Menu_model->get_menu_apps(69);
			$data_menu_result = $data_menu->result();
			
			$arr_data = array();
			$arr_data['menu'] = 'Portal TRB';
			$data['sidemenu'] = $data_menu_result;
			$data['isi'] = $this->load->view('welcome_default_menu', $arr_data, true);
			
			$this->load->view('template/template_isi',$data);
		}
	}
	public function page_validation()
	{
		if (!$this->session->has_userdata('ibo_is_login')) {
			$message = 'Session has expired, please re-login';
			echo "<SCRIPT>alert('$message');window.location='".site_url('User/login')."';</SCRIPT>";
		}
		if (!$this->Menu_model->is_auth_team())
		{
			$message = 'Maaf Anda Tidak Boleh Mengakses Page ini. Please Kontak Administrator.';
			echo "<SCRIPT>alert('$message');window.location='".site_url('Home/beranda')."';</SCRIPT>";
		}
	}
	
}

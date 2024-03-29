<?php 	
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Menu_model');
		$this->load->model('Cms_model');
	}

	public function index()
	{
		if (!$this->session->has_userdata('ibo_is_login')) {
			redirect('User/login');
		} else {
			$data_menu = $this->Menu_model->get_menu_apps(3);
			$data_menu_result = $data_menu->result();
			
			$arr_data = array();
			$arr_data['menu'] = 'CMS';
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
	//template show data
	public function template_show_data($link_view)
	{
		$this->page_validation();

		$data_menu = $this->Menu_model->get_menu_apps(3);
		$data_menu_result = $data_menu->result();
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('cms/'.$link_view.'/'.$link_view, $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	
	
	//all about show data menu show
	public function show_data_user()
	{
		$this->template_show_data('show_data_user');
	}
	
	public function show_data_sft()
	{
		$this->template_show_data('show_data_sft');
	}
	
	public function show_data_sch()
	{
		$this->template_show_data('show_data_sch');
	}
	
	public function show_trx_sft()
	{
		$this->template_show_data('show_trx_sft');
	}
	
	public function show_data_trx()
	{
		$this->template_show_data('show_data_trx');
	}
	
	public function show_data_remit()
	{
		$this->template_show_data('show_data_remit');
	}
	
	
	//all about show data menu patching
	public function patching_login_session()
	{
		$this->template_show_data('patching_login_session');
	}
	
	public function patching_sch_not_update() {
		$this->template_show_data('patching_sch_not_update');
	}
	public function patching_sch_bifast() {
		$this->template_show_data('patching_sch_bifast');
	}
	public function patching_sch_booking() {
		$this->template_show_data('patching_sch_booking');
	}
	public function patching_trx_pasarjaya() {
		$this->template_show_data('patching_trx_pasarjaya');
	}
	
	
	
	// all about get data
	public function search_data_user()
	{
		$datapost = $this->input->post();
		
		$data_return = $this->Cms_model->get_data_user($datapost);
		
		echo $this->load->view('cms/show_data_user/show_data_user_result', $data_return, true);
	}
	
	public function search_data_sch()
	{
		$datapost = $this->input->post();
		
		$data_return = $this->Cms_model->get_data_sch($datapost);
		
		echo $this->load->view('cms/show_data_sch/show_data_sch_result', $data_return, true);
	}
	
	public function search_data_sch_bifast()
	{
		$datapost = $this->input->post();
		$data_return = $this->Cms_model->get_data_sch($datapost);
		
		echo $this->load->view('cms/patching_sch_bifast/patching_sch_bifast_result', $data_return, true);
	}
	
	public function search_data_sch_booking()
	{
		$datapost = $this->input->post();
		$data_return = $this->Cms_model->get_data_sch_booking();
		
		echo $this->load->view('cms/patching_sch_booking/patching_sch_booking_result', $data_return, true);
	}
	public function search_data_trx_sft()
	{
		$datapost = $this->input->post();
		
		$data_return = $this->Cms_model->get_data_trx_sft($datapost);
		
		echo $this->load->view('cms/show_data_trx/show_data_trx_sft_result', $data_return, true);
	}
	public function search_data_trx_cft()
	{
		$datapost = $this->input->post();
		
		$data_return = $this->Cms_model->get_data_trx_cft($datapost);
		
		echo $this->load->view('cms/show_data_trx/show_data_trx_cft_result', $data_return, true);
	}
	
	public function search_data_trx()
	{
		$datapost = $this->input->post();
		
		if ($datapost["fid"] == 80)
		{
			echo $this->load->view('cms/show_data_trx/show_data_trx_sft', '', true);
		}
		if ($datapost["fid"] == 85)
		{
			echo $this->load->view('cms/show_data_trx/show_data_trx_cft', '', true);
		}
		
	}
	
	public function search_sch_not_update()
	{
		$data_return = $this->Cms_model->get_sch_not_update();
		
		echo $this->load->view('cms/patching_sch_not_update/patching_sch_not_update_result', $data_return, true);
	}
	public function search_trx_pasarjaya()
	{
		$data['sch_mftpost'] = $this->Cms_model->get_data_sch_mftpost();
		
		$data['get_trx_pasjay'] = $this->Cms_model->get_Pasarjaya()->row();
			
		echo $this->load->view('cms/patching_trx_pasarjaya/patching_trxpasjay_result', $data, true);
		
	}
	public function search_data_remit()
	{
		$datapost = '';
		
		$data_return = $this->Cms_model->get_data_remit($datapost);
		//$this->template_show_data('show_data_remit_result');
		echo $this->load->view('cms/show_data_remit_result', $data_return, true);
		//$data_menu = $this->Menu_model->get_menu_apps(3);
		//$data_menu_result = $data_menu->result();
		
		//$arr_data = array();
		//$data['sidemenu'] = $data_menu_result;
		//$data['isi'] = $this->load->view('cms/show_data_remit_result', $arr_data, true);
		
		//$this->load->view('template/template_isi',$data);
		
		//$this->template_show_data('show_data_remit_result');
	}


	//all about patching
	public function update_clear_session()
	{
		$datapost = $this->input->post();
		$data_return = $this->Cms_model->update_clear_session($datapost);
		
		echo $data_return;
	}
	
	public function update_sch()
	{
		$datapost = $this->input->post();
		$data_return = $this->Cms_model->update_sch($datapost);
		
		echo $data_return;
	}
	public function close_bifast_all()
	{
		$data_return = $this->Cms_model->close_bifast_all();
		
		echo $data_return;
	}
	public function open_bifast_all()
	{
		$data_return = $this->Cms_model->open_bifast_all();
		
		echo $data_return;
	}
	public function close_booking_all()
	{
		$data_return = $this->Cms_model->close_booking_all();
		
		echo $data_return;
	}
	public function open_booking_all()
	{
		$data_return = $this->Cms_model->open_booking_all();
		
		echo $data_return;
	}
	public function close_mft_all()
	{
		$data_return = $this->Cms_model->close_mft_all();
		
		echo $data_return;
	}
}

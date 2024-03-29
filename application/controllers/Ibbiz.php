<?php 	
defined('BASEPATH') OR exit('No direct script access allowed');

class Ibbiz extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Menu_model');
		$this->load->model('Ibbiz_model');
		$this->load->model('Micro_model');
	}

	public function index()
	{
		if (!$this->session->has_userdata('ibo_is_login')) {
			redirect('User/login');
		} else {
			$data_menu = $this->Menu_model->get_menu_apps(2);
			$data_menu_result = $data_menu->result();
			
			$arr_data = array();
			$arr_data['menu'] = 'iBBIZ';
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
	
	// show data client
	public function show_data_client()
	{
		$this->page_validation();

		$data_menu = $this->Menu_model->get_menu_apps(2);
		$data_menu_result = $data_menu->result();
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('ibbiz/show_data_client', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	
	public function search_data_client()
	{		
		$datapost = $this->input->post();
		
		$data_return = $this->Ibbiz_model->get_data_client($datapost);
		
		echo $this->load->view('ibbiz/show_data_client_result', $data_return, true);
	}
	// show data client end
	
	// show data Token
	public function show_data_token()
	{
		$this->page_validation();

		$data_menu = $this->Menu_model->get_menu_apps(2);
		$data_menu_result = $data_menu->result();
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('ibbiz/show_data_token', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	
	public function search_data_token()
	{		
		$datapost = $this->input->post();
		
		$data_return = $this->Ibbiz_model->get_data_token($datapost);
		
		echo $this->load->view('ibbiz/show_data_token_result', $data_return, true);
	}
	// show data Token end
		
	// patch data payment stuck
	public function patch_data_payment_stuck()
	{
		$this->page_validation();

		$data_menu = $this->Menu_model->get_menu_apps(2);
		$data_menu_result = $data_menu->result();
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('ibbiz/patch_data_payment_stuck', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	
	public function search_data_payment_stuck()
	{		
		$datapost = $this->input->post();
		
		$data_return = $this->Ibbiz_model->get_data_payment_stuck($datapost);
		
		echo $this->load->view('ibbiz/patch_data_payment_stuck_result', $data_return, true);
	}
	
	public function gagalkan_data_payment_stuck()
	{		
		$datapost = $this->input->post();
		
		$data_return = $this->Ibbiz_model->patch_data_payment_stuck($datapost);
		
		echo $data_return;
	}
	// patch data payment stuck end
	
	// patch data tipe rekening
	public function patch_data_client_account()
	{
		$this->page_validation();

		$data_menu = $this->Menu_model->get_menu_apps(2);
		$data_menu_result = $data_menu->result();
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('ibbiz/patch_data_client_account', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	
	public function search_data_client_account()
	{		
		$datapost = $this->input->post();
		
		$data_return = $this->Ibbiz_model->get_data_client_account($datapost);
		
		echo $this->load->view('ibbiz/patch_data_client_account_result', $data_return, true);
	}
	
	public function ubah_data_client_account()
	{		
		$datapost = $this->input->post();
		
		$data_return = $this->Ibbiz_model->patch_data_client_account($datapost);
		
		echo $data_return;
	}
	// patch data tipe rekening end
	
	// insert data Client Account
	public function show_form_data_client_account()
	{
		$this->page_validation();

		$data_menu = $this->Menu_model->get_menu_apps(2);
		$data_menu_result = $data_menu->result();
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('ibbiz/patch_insert_client_account', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	
	public function insert_data_client_account()
	{		
		
		$datapost = $this->input->post();
		
		$data_return = $this->Ibbiz_model->insert_data_client_account($datapost);
		
		echo $data_return;
	}
	// Insert data Client Account end
	
	// get data Do Pertamina
	//public function show_data_do_pertamina()
	//{
	//	$this->page_validation();
	//
	//	$data_menu = $this->Menu_model->get_menu_apps(2);
	//	$data_menu_result = $data_menu->result();
	//	
	//	$arr_data = array();
	//	$data['sidemenu'] = $data_menu_result;
	//	$data['isi'] = $this->load->view('ibbiz/get_data_do_pertamina', $arr_data, true);
	//	
	//	$this->load->view('template/template_isi',$data);
	//}
	//
	//public function get_data_do_pertamina()
	//{		
	//	
	//	$datapost = $this->input->post();
	//	
	//	$data_return = $this->Ibbiz_model->get_data_do_pertamina($datapost);
	//	
	//	echo $this->load->view('ibbiz/get_data_do_pertamina_result', $data_return, true);
	//}
	// get data Do Pertamina end
	
	// show client_account_matrix
	public function show_data_client_account_matrix()
	{
		$this->page_validation();

		$data_menu = $this->Menu_model->get_menu_apps(2);
		$data_menu_result = $data_menu->result();
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('ibbiz/show_data_client_account_matrix', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	
	public function search_data_client_account_matrix()
	{		
		$datapost = $this->input->post();
		
		$data_return = $this->Ibbiz_model->get_data_client_account_matrix($datapost);
		
		echo $this->load->view('ibbiz/show_data_client_account_matrix_result', $data_return, true);
	}
	// show data client_account_matrix end
	
	// show payment
	public function show_data_payment()
	{
		$this->page_validation();

		$data_menu = $this->Menu_model->get_menu_apps(2);
		$data_menu_result = $data_menu->result();
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('ibbiz/show_data_payment', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	
	public function search_data_payment()
	{		
		$datapost = $this->input->post();
		
		$data_return = $this->Ibbiz_model->get_data_payment($datapost);
		
		echo $this->load->view('ibbiz/show_data_payment_result', $data_return, true);
	}
	// show payment end
	
	// show transfer
	public function show_data_transfer()
	{
		$this->page_validation();

		$data_menu = $this->Menu_model->get_menu_apps(2);
		$data_menu_result = $data_menu->result();
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('ibbiz/show_data_transfer', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	
	public function search_data_transfer()
	{		
		$datapost = $this->input->post();
		
		$data_return = $this->Ibbiz_model->get_data_transfer($datapost);
		
		echo $this->load->view('ibbiz/show_data_transfer_result', $data_return, true);
	}
	// show transfer end
	
	// show email
	public function show_data_email()
	{
		$this->page_validation();

		$data_menu = $this->Menu_model->get_menu_apps(2);
		$data_menu_result = $data_menu->result();
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('ibbiz/show_data_email', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	
	public function search_data_email()
	{		
		$datapost = $this->input->post();
		
		$data_return = $this->Ibbiz_model->get_data_email($datapost);
		
		echo $this->load->view('ibbiz/show_data_email_result', $data_return, true);
	}
	// show email end
	
	// bifast
	public function show_bifast()
	{
		$this->page_validation();

		$data_menu = $this->Menu_model->get_menu_apps(2);
		$data_menu_result = $data_menu->result();
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('ibbiz/show_bifast', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	
	public function show_bifast_result()
	{		
		$datapost = $this->input->post();
		
		$data_return = $this->Ibbiz_model->get_data_table_bankbifast();
		
		echo $this->load->view('ibbiz/show_bifast_result', $data_return, true);
	}
	
	public function close_bifast_all()
	{		
		
		$data_return = $this->Ibbiz_model->close_bifast_all();
		
		echo $this->load->view('ibbiz/show_bifast_result', $data_return, true);
	}
	
	public function open_bifast()
	{		
		
		$data_return = $this->Ibbiz_model->open_bifast();
		
		echo $this->load->view('ibbiz/show_bifast_result', $data_return, true);
	}
	
	public function buka_tutup_bifast_satuan()
	{		
		$datapost = $this->input->post();
		$data_return = $this->Ibbiz_model->buka_tutup_bifast_satuan($datapost);
		
		//echo $this->load->view('ibbiz/show_bifast_result', $data_return, true);
	}
	
	
	// bifast end
	
	
	// patch data do Pertamina
	public function patch_data_do_pertamina()
	{
		$this->page_validation();

		$data_menu = $this->Menu_model->get_menu_apps(2);
		$data_menu_result = $data_menu->result();
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('ibbiz/patch_data_do_pertamina', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	
	public function search_data_do_pertamina()
	{		
		$datapost = $this->input->post();
		
		$data_return = $this->Ibbiz_model->get_data_do_pertamina($datapost);
		
		echo $this->load->view('ibbiz/patch_data_do_pertamina_result', $data_return, true);
	}
	
	public function ubah_data_do_pertamina()
	{		
		$datapost = $this->input->post();
		
		$data_return = $this->Ibbiz_model->patch_data_do_pertamina($datapost);
		
		echo $data_return;
	}
	// patch data do Pertamina end
	
	//capture micro
	public function capture_micro()
	{
		$this->page_validation();
		

		$data_menu = $this->Menu_model->get_menu_apps(2);
		$data_menu_result = $data_menu->result();
		
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('ibbiz/micro/capture_micro', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	public function capture_micro_result()
	{		
		$datapost = $this->input->post();
		if(!isset($datapost['flag'])){
			$out = $this->Micro_model->add_capture_micro($datapost);
		
			if($out['status'] == 1){
				$alert = 'success';
			}else{
				$alert = 'failed';
			}
			
			$this->session->set_userdata('ibo_msg_notif', $out['msg']);
			$this->session->set_userdata('ibo_msg_alert', $alert);
		}
		
		$data_micro = array('namespace'=>'ibbiz');
		$data_return['micro_list'] = $this->Micro_model->get_capture_micro($data_micro);
		
		echo $this->load->view('ibbiz/micro/capture_micro_result', $data_return, true);
	}
	public function download_capture_micro($capture_id)
	{
		$datapost = array('capture_id'=>$capture_id);
		$out_detail = $this->Micro_model->get_capture_micro_detail($datapost);
		
		$datapost = array('id'=>$capture_id);
		$out_parent = $this->Micro_model->get_capture_micro($datapost);
		
		$zip_name = "";
		$zip = new ZipArchive;
		if(sizeof($out_parent) > 0){
			foreach($out_parent as $d){
				$zip_name = "/var/www/html/capture_micro_zip/".str_replace("-","",substr($d->capture_start_time,0,10))."_".strtoupper($d->namespace)."_".$d->deployment.".zip";
			}
			$zip->open($zip_name, ZipArchive::CREATE);
			foreach($out_detail as $r){
				$zip->addFile($r->location, basename($r->location));
			}
		}
		$zip->close();
		
		header('Content-Type: application/zip');
		header('Content-Disposition: attachment; filename='.basename($zip_name));
		header('Content-Length: '.filesize($zip_name));
		ob_flush();
		flush();
		readfile($zip_name);
	}
	
	//compare micro
	public function compare_micro()
	{
		$this->page_validation();
		

		$data_menu = $this->Menu_model->get_menu_apps(2);
		$data_menu_result = $data_menu->result();
		
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('ibbiz/micro/compare_micro', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	public function capture_micro_compare_result()
	{		
		$datapost = $this->input->post();
		
		$data_micro = array('capture_status'=>0, 'namespace'=>'ibbiz', 'deployment'=>$datapost['deployment_txt']);
		$data_return['micro_list'] = $this->Micro_model->get_capture_micro($data_micro);
		
		echo $this->load->view('ibbiz/micro/capture_micro_compare_result', $data_return, true);
	}
	public function compare_micro_result()
	{
		$datapost = $this->input->post();
		
		$arr_id = $datapost['radio_compare'];
		sort($arr_id);
		
		$out_before = $this->Micro_model->get_capture_micro(array("id"=>$arr_id[0]));
		$out_after = $this->Micro_model->get_capture_micro(array("id"=>$arr_id[1]));
		
		$out_before_detail = $this->Micro_model->get_capture_micro_detail(array("capture_id"=>$arr_id[0]));
		$out_after_detail = $this->Micro_model->get_capture_micro_detail(array("capture_id"=>$arr_id[1]));
		
		$arr_compare = array("before"=>NULL,"after"=>NULL);
		$arr_dropdown_hostname = array();
		$arr_dropdown_manifest = array();
		$selected_hostname = isset($datapost['selected_hostname'])?$datapost['selected_hostname']:'';
		$selected_manifest = isset($datapost['selected_manifest'])?$datapost['selected_manifest']:'';
		
		foreach($out_before as $o){
			$arr_compare_detail = array();
			foreach($out_before_detail as $od){
				if($selected_hostname == ''){
					$selected_hostname = $od->hostname;
				}
				if($selected_manifest == ''){
					$selected_manifest = $od->manifest_type.'|'.$od->manifest_name;
				}
				if($od->hostname == $selected_hostname && ($od->manifest_type.'|'.$od->manifest_name) == $selected_manifest){
					array_push($arr_compare_detail,array(
						"hostname"=>$od->hostname,
						"manifest_type"=>$od->manifest_type,
						"manifest_name"=>$od->manifest_name,
						"location"=>$od->location
					));
				}
				$arr_dropdown_hostname[$od->hostname] = $od->hostname;
				$arr_dropdown_manifest[$od->manifest_type.'|'.$od->manifest_name] = $od->manifest_type.' - '.$od->manifest_name;
			}
			$arr_compare['before'] = array(
					"capture_id"=>$o->id,
					"capture_start_time"=>$o->capture_start_time,
					"namespace"=>$o->namespace,
					"deployment"=>$o->deployment,
					"path_folder"=>$o->location,
					"detail"=>$arr_compare_detail
			);	
		}
		
		foreach($out_after as $o){
			$arr_compare_detail = array();
			foreach($out_after_detail as $od){
				if($od->hostname == $selected_hostname && ($od->manifest_type.'|'.$od->manifest_name) == $selected_manifest){
					array_push($arr_compare_detail,array(
						"hostname"=>$od->hostname,
						"manifest_type"=>$od->manifest_type,
						"manifest_name"=>$od->manifest_name,
						"location"=>$od->location
					));
				}
				$arr_dropdown_hostname[$od->hostname] = $od->hostname;
				$arr_dropdown_manifest[$od->manifest_type.'|'.$od->manifest_name] = $od->manifest_type.' - '.$od->manifest_name;
			}
			$arr_compare['after'] = array(
					"capture_id"=>$o->id,
					"capture_start_time"=>$o->capture_start_time,
					"namespace"=>$o->namespace,
					"deployment"=>$o->deployment,
					"path_folder"=>$o->location,
					"detail"=>$arr_compare_detail
			);
		}
		
		$data_view = array();
		$data_view['arr_id'] = $arr_id;
		$data_view['arr_compare'] = $arr_compare;
		$data_view['arr_dropdown_hostname'] = $arr_dropdown_hostname;
		$data_view['arr_dropdown_manifest'] = $arr_dropdown_manifest;
		$data_view['selected_hostname'] = $selected_hostname;
		$data_view['selected_manifest'] = $selected_manifest;
		
		$path_before = isset($arr_compare['before']['detail'][0]['location'])?$arr_compare['before']['detail'][0]['location']:'/dev/null';
		$path_after = isset($arr_compare['after']['detail'][0]['location'])?$arr_compare['after']['detail'][0]['location']:'/dev/null';

		
		

		exec("diff -rq ".$arr_compare['before']['path_folder']." ".$arr_compare['after']['path_folder']." | sort -r", $data_view['diff_string_summary']);

		$manifest_type = [
			'deployment' => 'Deployment',
			'configmap' => 'ConfigMap',
			'secret' => 'Secret',
			'hpa' => 'HPA'
		];
	
		foreach($data_view['diff_string_summary'] as &$diff_string_summary_element) {
			if (preg_match('/^Files/', $diff_string_summary_element)) {
				$summary_explode = explode(' ', $diff_string_summary_element);
				preg_match('/(\/.*)\/([^\/]*).yaml/', $summary_explode[1], $config_matches);
				
				$config_strings = explode('_', $config_matches[2]);
				if (isset($manifest_type[$config_strings[1]])) {
					$config_strings[1] = $manifest_type[$config_strings[1]];
				}
	
				$diff_string_summary_element = ' - <div class="col-sm-3">'.implode(' - ', $config_strings).'</div><div class="col-sm-4">: <strong class="text-danger">BERBEDA</strong></div>'; 
			} elseif (preg_match('/^Only in/', $diff_string_summary_element)) {
				$summary_explode = explode(' ', $diff_string_summary_element);
				$location = rtrim($summary_explode[2], ':');
				$config_strings = explode('_', $summary_explode[3]);
				
				if (isset($manifest_type[$config_strings[1]])) {
					$config_strings[1] = $manifest_type[$config_strings[1]];
				}
				
				$diff_string_summary_element = ' - <div class="col-sm-3">'.implode(' - ', $config_strings).'</div><div class="col-sm-4">: Capture <strong class="text-danger">'.(strcmp($location, $arr_compare['before']['path_folder']) == 0 ? 'AFTER' : (strcmp($location, $arr_compare['after']['path_folder']) == 0 ? 'BEFORE' : $location)).'</strong> tidak tersedia </div>';
			} 
		}
		unset($diff_string_summary_element);
		
		exec("diff -u ".$path_before." ".$path_after, $data_view['diff_string']);

		//$data_view['diff_string'] = exec("diff -u ".$arr_compare['before']['detail'][0]['location']." ".$arr_compare['after']['detail'][0]['location']);
		
		echo $this->load->view('brimo/micro/compare_micro_result', $data_view, true);
		
		//echo'<pre>';print_r($arr_compare);echo'</pre>';
	}
}

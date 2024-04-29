<?php 	
defined('BASEPATH') OR exit('No direct script access allowed');

class Brimo extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Menu_model');
		$this->load->model('Brimo_model');
		$this->load->model('Micro_model');
		
	}

	public function index()
	{
		if (!$this->session->has_userdata('ibo_is_login')) {
			redirect('User/login');
		} else {
			$data_menu = $this->Menu_model->get_menu_apps(1);
			$data_menu_result = $data_menu->result();
			
			$arr_data = array();
			$arr_data['menu'] = 'BRImo';
			$arr_data['menu_id'] = '1';
			$arr_data['mymenu'] = $data_menu_result;
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
	
	// data user
	public function show_data_user()
	{
		$this->page_validation();
		

		$data_menu = $this->Menu_model->get_menu_apps(1);
		$data_menu_result = $data_menu->result();
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('brimo/show_data_user', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	// data user
	public function show_data_deleted_user()
	{
		$this->page_validation();
		

		$data_menu = $this->Menu_model->get_menu_apps(1);
		$data_menu_result = $data_menu->result();
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('brimo/deleted_user/show_data_deleted_user', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	// data soceng user
	public function show_soceng_user()
	{
		$this->page_validation();
		

		$data_menu = $this->Menu_model->get_menu_apps(1);
		$data_menu_result = $data_menu->result();
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('brimo/soceng/show_soceng_user', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	// data safety mode
	public function show_safety_mode()
	{
		$this->page_validation();
		

		$data_menu = $this->Menu_model->get_menu_apps(1);
		$data_menu_result = $data_menu->result();
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('brimo/safety_mode/show_safety_mode', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	// data cardnumber
	public function show_acc_by_card()
	{
		$this->page_validation();
		

		$data_menu = $this->Menu_model->get_menu_apps(1);
		$data_menu_result = $data_menu->result();
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('brimo/acc_by_card/show_acc_by_card', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	
	public function search_data_user()
	{
		$datapost = $this->input->post();
		
		$data_return = $this->Brimo_model->get_data_user($datapost);
		
		echo $this->load->view('brimo/show_data_user_result', $data_return, true);
	}
	
	public function search_data_deleted_user()
	{
		$datapost = $this->input->post();
		
		$data_return = $this->Brimo_model->get_data_deleted_user($datapost);
		
		echo $this->load->view('brimo/deleted_user/show_data_deleted_user_result', $data_return, true);
	}
	
	
	public function search_soceng_user()
	{
		$datapost = $this->input->post();
		
		$data_return = $this->Brimo_model->get_soceng_user($datapost);
		
		echo $this->load->view('brimo/soceng/show_soceng_user_result', $data_return, true);
	}
	public function search_safety_mode()
	{
		$datapost = $this->input->post();
		
		$data_return = $this->Brimo_model->get_safety_mode($datapost);
		
		$data_return['is_safety_mode'] = False;
		
		if(isset($data_return['user_safety_mode'])){
			foreach($data_return['user_safety_mode'] as $key => $d){
					if(strtotime($d->start) > strtotime(' - 1 days')){
						$data_return['is_safety_mode'] = True;
					}
			}
		}
		
		
		echo $this->load->view('brimo/safety_mode/show_safety_mode_result', $data_return, true);
	}
	
	public function search_safety_mode_livik()
	{
		$datapost = $this->input->post();
		
		$data_return = $this->Brimo_model->get_safety_mode_livik($datapost);
		
		echo $this->load->view('brimo/safety_mode/show_safety_mode_result_livik', $data_return, true);
	}
	
	public function search_acc_by_card()
	{
		$datapost = $this->input->post();
		
		$data_return = $this->Brimo_model->get_acc_by_card($datapost);
		
		echo $this->load->view('brimo/acc_by_card/show_acc_by_card_result', $data_return, true);
	}
	
	// data log transaksi
	
	public function show_data_log_transaksi()
	{
		$this->page_validation();
		

		$data_menu = $this->Menu_model->get_menu_apps(1);
		$data_menu_result = $data_menu->result();
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('brimo/show_data_log_transaksi', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	
	public function search_data_log_transaksi()
	{
		$datapost = $this->input->post();
		
		$data_return = $this->Brimo_model->get_data_log_transaksi($datapost);
		
		echo $this->load->view('brimo/show_data_log_transaksi_result', $data_return, true);
	}
	
	// bifast
	public function show_bifast()
	{
		$this->page_validation();

		$data_menu = $this->Menu_model->get_menu_apps(1);
		$data_menu_result = $data_menu->result();
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('brimo/show_bifast', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	
	public function show_bifast_result()
	{		
		$datapost = $this->input->post();
		
		$data_return = $this->Brimo_model->get_data_table_bank();
		
		echo $this->load->view('brimo/show_bifast_result', $data_return, true);
	}
	
	public function close_bifast_all()
	{		
		
		$data_return = $this->Brimo_model->close_bifast_all();
		
		$this->load->helper('redis_conn');
		$redis = get_redis_conn('brimo_redis');
		
		$redis->delete("ibank.tbl_bank:ALL");
		
		echo $this->load->view('brimo/show_bifast_result', $data_return, true);
	}
	
	public function open_bifast()
	{		
		
		$data_return = $this->Brimo_model->open_bifast();
		
		$this->load->helper('redis_conn');
		$redis = get_redis_conn('brimo_redis');
		
		$redis->delete("ibank.tbl_bank:ALL");
		
		echo $this->load->view('brimo/show_bifast_result', $data_return, true);
	}
	
	public function buka_tutup_bifast_satuan()
	{		
		$datapost = $this->input->post();
		$data_return = $this->Brimo_model->buka_tutup_bifast_satuan($datapost);
		
		$this->load->helper('redis_conn');
		$redis = get_redis_conn('brimo_redis');
		
		$redis->delete("ibank.tbl_bank:ALL");
		
		echo $this->load->view('brimo/show_bifast_result', $data_return, true);
	}
	
	
	// bifast end
	
	// bifast v2
	public function show_bifast_v2()
	{
		$this->page_validation();

		$data_menu = $this->Menu_model->get_menu_apps(1);
		$data_menu_result = $data_menu->result();
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('brimo/show_bifast_v2', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	
	public function show_bifast_result_v2()
	{		
		$datapost = $this->input->post();
		
		$data_return = $this->Brimo_model->get_data_table_bank_brimo();
		
		echo $this->load->view('brimo/show_bifast_v2_result', $data_return, true);
	}
	
	public function close_bifast_all_v2()
	{		
		
		$data_return = $this->Brimo_model->close_bifast_all_brimo();
		
		$this->load->helper('redis_conn');
		$redis = get_redis_conn('brimo_redis');
		
		$redis->delete("ibank.tbl_bank_brimo:ALL");
		
		echo $this->load->view('brimo/show_bifast_v2_result', $data_return, true);
	}
	
	public function open_bifast_v2()
	{		
		
		$data_return = $this->Brimo_model->open_bifast_brimo();
		
		$this->load->helper('redis_conn');
		$redis = get_redis_conn('brimo_redis');
		
		$redis->delete("ibank.tbl_bank_brimo:ALL");
		
		echo $this->load->view('brimo/show_bifast_v2_result', $data_return, true);
	}
	
	public function buka_tutup_bifast_satuan_v2()
	{		
		$datapost = $this->input->post();
		$data_return = $this->Brimo_model->buka_tutup_bifast_satuan_brimo($datapost);
		
		$this->load->helper('redis_conn');
		$redis = get_redis_conn('brimo_redis');
		
		$redis->delete("ibank.tbl_bank_brimo:ALL");
		
		echo $this->load->view('brimo/show_bifast_v2_result', $data_return, true);
	}
	
	// end bifast v2

	// bifast v3
	public function show_bifast_v3()
	{
		$this->page_validation();

		$data_menu = $this->Menu_model->get_menu_apps(1);
		$data_menu_result = $data_menu->result();
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('brimo/show_bifast_v3', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	
	public function show_bifast_result_v3()
	{		
		$datapost = $this->input->post();
		
		$data_return = $this->Brimo_model->get_data_table_bank_brimo();
		
		echo $this->load->view('brimo/show_bifast_v3_result', $data_return, true);
	}
	
	public function close_bifast_all_v3()
	{		
		
		$data_return = $this->Brimo_model->close_bifast_all_v3();
		
		$this->load->helper('redis_conn');
		$redis = get_redis_conn('brimo_redis');
		
		$redis->delete("ibank.tbl_bank:ALL");
		$redis->delete("ibank.tbl_bank_brimo:ALL");
		
		echo $this->load->view('brimo/show_bifast_v3_result', $data_return, true);
	}
	
	public function open_bifast_v3()
	{		
		
		$data_return = $this->Brimo_model->open_bifast_v3();
		
		$this->load->helper('redis_conn');
		$redis = get_redis_conn('brimo_redis');
		
		$redis->delete("ibank.tbl_bank:ALL");
		$redis->delete("ibank.tbl_bank_brimo:ALL");
		
		echo $this->load->view('brimo/show_bifast_v3_result', $data_return, true);
	}
	
	public function buka_tutup_bifast_satuan_v3()
	{		
		$datapost = $this->input->post();
		$data_return = $this->Brimo_model->buka_tutup_bifast_satuan_v3($datapost);
		
		$this->load->helper('redis_conn');
		$redis = get_redis_conn('brimo_redis');
		
		$redis->delete("ibank.tbl_bank:ALL");
		$redis->delete("ibank.tbl_bank_brimo:ALL");
		
		//echo $this->load->view('brimo/show_bifast_v3_result', $data_return, true);
	}
	
	// end bifast v3
	
	// ================== buka tutup trf online
	public function show_trfonline()
	{
		$this->page_validation();

		$data_menu = $this->Menu_model->get_menu_apps(1);
		$data_menu_result = $data_menu->result();
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('brimo/show_trfonline', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	public function show_trfonline_result()
	{		
		$datapost = $this->input->post();
		
		$data_return = $this->Brimo_model->get_data_table_trfonline_brimo();
		
		echo $this->load->view('brimo/show_trfonline_result', $data_return, true);
	}
	public function buka_tutup_trfonline_satuan()
	{		
		$datapost = $this->input->post();
		$data_return = $this->Brimo_model->buka_tutup_trfonline_satuan($datapost);
		
		$this->load->helper('redis_conn');
		$redis = get_redis_conn('brimo_redis');
		
		$redis->delete("ibank.tbl_bank_brimo:ALL");
	}
	// ================== buka tutup trf online
	
	public function show_micro()
	{
		$this->page_validation();
		

		$data_menu = $this->Menu_model->get_menu_apps(1);
		$data_menu_result = $data_menu->result();
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('brimo/show_micro', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	
	public function search_micro()
	{
		$datapost = $this->input->post();
		
		$data_return = $this->Brimo_model->get_micro_list($datapost);
		
		echo $this->load->view('brimo/show_micro_result', $data_return, true);
	}
	
	public function add_micro()
	{
		$this->page_validation();
		

		$data_menu = $this->Menu_model->get_menu_apps(1);
		$data_menu_result = $data_menu->result();
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('brimo/add_micro', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	
	public function save_add_micro()
	{
		$datapost = $this->input->post();
		$out = $this->Brimo_model->add_micro($datapost);
		
		if($out['status'] == 1){
			$alert = 'success';
		}else{
			$alert = 'failed';
		}
		
		$this->session->set_userdata('ibo_msg_notif', $out['msg']);
		$this->session->set_userdata('ibo_msg_alert', $alert);
	}
	
	public function delete_micro()
	{
		$datapost = $this->input->post();
		$out = $this->Brimo_model->delete_micro($datapost);
		
		if($out['status'] == 1){
			$alert = 'success';
		}else{
			$alert = 'failed';
		}
		
		$this->session->set_userdata('ibo_msg_notif', $out['msg']);
		$this->session->set_userdata('ibo_msg_alert', $alert);
	}

	public function get_yaml_micro($micro_id)
	{
		$datapost = array('micro_id'=>$micro_id);
		$out = $this->Brimo_model->get_micro($datapost);
		
		if($out['status'] == 1){
			$this->load->helper('download');
			
			$record = $out['record'];
			$filename = "script_get_yaml_".$record->deployment."_".date("YmdHis").".txt";
			
			$arr_configmap = json_decode($record->configmap);
			$arr_secret = json_decode($record->secret);
			
			$content = "";
			$content .= "oc get deployment ".$record->deployment." -n ".$record->project." -o yaml\r\n";
			foreach($arr_configmap as $c){
				//$content .= "oc get configmap ".$c." -n ".$record->project." -o yaml\r\n";
				$content .= "oc extract configmap/".$c." -n ".$record->project." --to=-\r\n";
			}
			foreach($arr_secret as $s){
				//$content .= "oc get secret ".$s." -n ".$record->project." -o yaml\r\n";
				$content .= "oc extract secret/".$s." -n ".$record->project." --to=-\r\n";
			}
			$content .= "oc get horizontalpodautoscalers ".$record->hpa." -n ".$record->project." -o yaml\r\n";
			
			force_download($filename,$content);
			// $file = @fopen($filename, "rb");
			
			// header('Content-Description: Backup YAML');
			// header('Content-Type: application/octet-stream');
			// header('Content-Disposition: attachment; filename='.$filename);
			// header('Expires: 0');
			// header('Cache-Control: must-revalidate');
			// header('Pragma: public');
			// header('Content-Length: '.filesize($filename));
			
			// while(!feof($file)){
				// print(@fread($file, 1024 * 8));
				// ob_flush();
				// flush();
			// }
		}
	}
	
	//release safety mode
	public function release_safety_mode()
	{
		$datapost = $this->input->post();
		$data_return = $this->Brimo_model->update_safety_mode($datapost);
		
		echo $data_return;
	}
	
	// data user cc
	public function show_data_user_cc()
	{
		$this->page_validation();
		

		$data_menu = $this->Menu_model->get_menu_apps(1);
		$data_menu_result = $data_menu->result();
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('brimo/show_data_user_cc', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	
	public function search_data_user_cc()
	{
		$datapost = $this->input->post();
		
		$data_return = $this->Brimo_model->get_data_user_cc($datapost);
		
		echo $this->load->view('brimo/show_data_user_cc_result', $data_return, true);
	}
	
	// patch data user account
	public function show_patch_user_account()
	{
		$this->page_validation();
		

		$data_menu = $this->Menu_model->get_menu_apps(1);
		$data_menu_result = $data_menu->result();
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('brimo/product_type/show_acc_product_type', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}

	public function search_account()
	{
		$datapost = $this->input->post();
		
		$data_return = $this->Brimo_model->get_user_account($datapost);
		
		echo $this->load->view('brimo/product_type/show_acc_product_type_result', $data_return, true);
	}

	public function edit_data_user_account()
	{		
		$datapost = $this->input->post();
		
		$data_return = $this->Brimo_model->update_data_user_account($datapost);
		
		echo $data_return;
	}
	
	// Patching data CIF User
	public function show_cif_patching_user()
	{
		$this->page_validation();
		

		$data_menu = $this->Menu_model->get_menu_apps(1);
		$data_menu_result = $data_menu->result();
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('brimo/cif_patching/show_cif_patching_user', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}

	public function search_user_cif()
	{
		$datapost = $this->input->post();
		
		$data_return = $this->Brimo_model->get_user_cif($datapost);
		
		echo $this->load->view('brimo/cif_patching/show_cif_patching_user_result', $data_return, true);
	}
	
	// edit cif user_profile
	public function edit_user_profile_cif()
	{		
		$datapost = $this->input->post();
		
		$data_return = $this->Brimo_model->update_user_profile_cif($datapost);
		
		echo $data_return;
	}

	// edit cif user_deposito
	public function edit_user_deposito_cif()
	{
		//$referenceNum = $this->input->post('reference_num');
		//$cif = $this->input->post('cif');
		
		//$data_return = $this->Brimo_model->update_user_deposito_cif($referenceNum, $cif);
		
		$datapost = $this->input->post();
		
		$data_return = $this->Brimo_model->update_user_deposito_cif($datapost);
		
		echo $data_return;
	}

	
	public function compare_ocp()
	{		
		//$datapost = $this->input->post();
		$datapost = "archimonde";
		
		$data_return = $this->Brimo_model->capture_ocp($datapost);
		
		echo $data_return;
	}
	
	//capture micro
	public function capture_micro()
	{
		$this->page_validation();
		

		$data_menu = $this->Menu_model->get_menu_apps(1);
		$data_menu_result = $data_menu->result();
		
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('brimo/micro/capture_micro', $arr_data, true);
		
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
		
		$data_micro = array('namespace'=>'brimo');
		$data_return['micro_list'] = $this->Micro_model->get_capture_micro($data_micro);
		
		echo $this->load->view('brimo/micro/capture_micro_result', $data_return, true);
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
		

		$data_menu = $this->Menu_model->get_menu_apps(1);
		$data_menu_result = $data_menu->result();
		
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('brimo/micro/compare_micro', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	public function capture_micro_compare_result()
	{		
		$datapost = $this->input->post();
		
		$data_micro = array('capture_status'=>0, 'namespace'=>'brimo', 'deployment'=>$datapost['deployment_txt']);
		$data_return['micro_list'] = $this->Micro_model->get_capture_micro($data_micro);
		
		echo $this->load->view('brimo/micro/capture_micro_compare_result', $data_return, true);
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
	
	//compare micro v2
	public function compare_micro_v2()
	{
		$this->page_validation();
		

		$data_menu = $this->Menu_model->get_menu_apps(1);
		$data_menu_result = $data_menu->result();
		
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('brimo/micro/compare_micro_v2', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	
	public function capture_micro_compare_result_v2()
	{
		$datapost = $this->input->post();
		
		$data_micro = array('capture_status'=>0, 'namespace'=>'brimo', 'deployment'=>$datapost['deployment_txt']);
		$data_return['micro_list'] = $this->Micro_model->get_capture_micro($data_micro);
		
		echo $this->load->view('brimo/micro/capture_micro_compare_result_v2', $data_return, true);
	}
	
	public function compare_micro_detail_v2()
	{
		$datapost = $this->input->post();
		
		$parent_id = $datapost['radio_compare'];
		sort($parent_id);
		
		$data_view = array();
		
		$data_view['out_before_detail'] = $this->Micro_model->get_capture_micro_detail(array("capture_id"=>$parent_id[0]));
		$data_view['out_after_detail'] = $this->Micro_model->get_capture_micro_detail(array("capture_id"=>$parent_id[1]));
		
		echo $this->load->view('brimo/micro/compare_micro_detail_v2', $data_view, true);
	}
	
	public function compare_micro_result_v2()
	{
			
		$datapost = $this->input->post();
		
		$manifest_type_query = [
			'Deployment' => '{spec}',
			'HPA' => '{spec}|del(.spec.scaleTargetRef)',
			'Config Map' => '{data}',
			'Secret' => '{data}'
		];
		
		$out_before_detail = $this->Micro_model->get_capture_micro_detail(array("id"=>$datapost["radio_compare_before"][0]));
		$out_after_detail = $this->Micro_model->get_capture_micro_detail(array("id"=>$datapost["radio_compare_after"][0]));
		
		$data_return = array();
		$data_view = array();
		
		$data_view["location_before"] = $out_before_detail[0]->location;
		$data_view["location_after"] = $out_after_detail[0]->location;
		
		$exec_string = "/home/administrator/capture_micro_manifest/compare.sh '".$out_before_detail[0]->location."' '".$manifest_type_query[$out_before_detail[0]->manifest_type]."' '".$out_after_detail[0]->location."' '".$manifest_type_query[$out_after_detail[0]->manifest_type]."'";
		
		exec($exec_string, $data_view["diff_string"]);
		
		$data_return["compare_result"] = (bool) $data_view["diff_string"];
		$data_return["html"] = $this->load->view('brimo/micro/compare_micro_result_v2', $data_view, true);
		
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($data_return);
	}
	
	//buka tutup parameter
	public function show_parameter()
	{
		$this->page_validation();

		$data_menu = $this->Menu_model->get_menu_apps(1);
		$data_menu_result = $data_menu->result();
		
		$arr_data = array();
		$data['sidemenu'] = $data_menu_result;
		$data['isi'] = $this->load->view('brimo/parameter/show_parameter', $arr_data, true);
		
		$this->load->view('template/template_isi',$data);
	}
	public function show_parameter_result()
	{		
		$datapost = $this->input->post();
		
		$data_return = $this->Brimo_model->get_mnv_parameter();
		
		echo $this->load->view('brimo/parameter/show_parameter_result', $data_return, true);
	}
}

<?php 	
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();
		
		$this->load->model('User_model');
	}

	public function index()
	{
		if (!$this->session->has_userdata('ibo_is_login')) {
			redirect('User/login');
		} else {
			redirect('Home/beranda');
		}
	}
	
	public function login()
	{
		$data = array();
		
		$data_team = $this->User_model->get_data_team_list();
		$data['team_list'] = $data_team->result();
		
		$data['isi'] = $this->load->view('user/login', $data, true);
		
		$this->load->view('template/template_login',$data);
	}
	
	public function login_submit()
	{
		$datapost = $this->input->post();
		
		$data_user = $this->User_model->get_data_user($datapost['username_txt'], $datapost['team_txt']);
		
		$data = array();
		
		$data_team = $this->User_model->get_data_team_list();
		$data['team_list'] = $data_team->result();
		
		if($data_user->num_rows() > 0){
			$data_user_row = $data_user->row();
			
			// check expired 15 mins
			$datetime1 = new DateTime($data_user_row->last_login);
			$datetime2 = new DateTime(date("Y-m-d H:i:s"));
			$diff_in_secs = ($datetime2->getTimestamp() - $datetime1->getTimestamp());
			
			if($data_user_row->is_login == 0 || $diff_in_secs > $this->config->item('expired_idle_login_sec')){
				$sukses_login = FALSE;
				if($data_user_row->is_ldap == 1){
					require_once(APPPATH.'libraries/nusoap/nusoap.php');
					$client = new nusoap_client("http://wsuser.bri.co.id/beranda/ldap/ws/ws_adUser.php?wsdl", true);
					$param 		= array('ldap_user'=>$datapost['username_txt'],'ldap_pass'=>$datapost['password_txt']);
					$first  	= time();
					$result 	= $client->call('validate_aduser', $param);
					$second 	= time();
					if($result){
						$sukses_login = TRUE;
					}
				}else{
					$hashed = hash("sha512", $datapost['password_txt']);
					if($data_user_row->password != NULL && $hashed == $data_user_row->password){
						$sukses_login = TRUE;
					}
				}
				
				if($sukses_login){
					$this->User_model->update_login($data_user_row->username);
					
					$arr_session = array(
						'ibo_is_login'=>TRUE,
						'ibo_username'=>$data_user_row->username,
						'ibo_name'=>$data_user_row->name,
						'ibo_level'=>$data_user_row->level,
						'ibo_team_title'=>$data_user_row->title
					);
					$this->session->set_userdata($arr_session);
					redirect('Home/beranda');
				}else{
					$data['msg_notif'] = 'Username and password are incorrect.';
					$data['isi'] = $this->load->view('user/login', $data, true);
					$this->load->view('template/template_login',$data);
				}
			}else{
				$more_wait_mins = ceil(($this->config->item('expired_idle_login_sec') - $diff_in_secs)/60);
				
				$data['msg_notif'] = 'Please wait '.$more_wait_mins.' mins to login again.';
				$data['isi'] = $this->load->view('user/login', $data, true);
				$this->load->view('template/template_login',$data);
			}
			
		}else{
			$data['msg_notif'] = 'Username and password not found.';
			$data['isi'] = $this->load->view('user/login', $data, true);
			$this->load->view('template/template_login',$data);
		}
	}
	
	public function logout()
	{
		$this->User_model->update_logout($this->session->userdata('ibo_username'));
		$this->session->sess_destroy();
		redirect('User/login');
	}


}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Micro_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function patch_logging($data_ins){
		$this->db->insert('patch_log',$data_ins);
	}
	public function audit_log($data_ins){
		$this->db->insert('audit_log',$data_ins);
	}
	
	public function get_capture_micro($data)
	{		
		$db_bripatch = $this->load->database('default', TRUE);
		$data_return = NULL;

		if(sizeof($data) > 0){
			$db_bripatch->where($data);
		}
		$db_bripatch->select("a.*");
		$db_bripatch->from("capture_micro_parent a");
		$db_bripatch->order_by("id DESC");
		$data_return = $db_bripatch->get()->result();
			
		return $data_return;
	}
	
	public function get_capture_micro_detail($data)
	{		
		$db_bripatch = $this->load->database('default', TRUE);
		$data_return = NULL;

		if(sizeof($data) > 0){
			$db_bripatch->where($data);
		}
		$db_bripatch->select("a.*");
		$db_bripatch->from("capture_micro_detail a");
		$db_bripatch->order_by("id DESC");
		$data_return = $db_bripatch->get()->result();
			
		return $data_return;
	}
	
	public function add_capture_micro($datapost)
	{
		$db_bripatch = $this->load->database('default', TRUE);
		$data_return = array('msg'=>'','status'=>0);
		
		$query_insert = "INSERT INTO capture_micro_parent (`capture_request_time`,`capture_start_time`,`namespace`,`deployment`,`location`,`status`, `capture_status`, `capture_status_description`, `requester`) VALUES ('".date("Y-m-d H:i:s")."', NULL, '".$datapost['namespace_txt']."', '".trim($datapost['deployment_txt'])."', NULL, NULL, 1, 'PENDING', '".$this->session->userdata('ibo_username')."');";
		$db_bripatch->query($query_insert);
		
		if ($db_bripatch->affected_rows() > 0){
			$data_return['msg'] = 'Capture Request <b>'.$datapost['deployment_txt'].'</b> added successfully.';
			$data_return['status'] = 1;
		}else{
			$data_return['msg'] = 'Capture Request <b>'.$datapost['deployment_txt'].'</b> failed to add. System error.';
			$data_return['status'] = 0;
		}
		
		$db_bripatch->close();
		return $data_return;
	}
	
}
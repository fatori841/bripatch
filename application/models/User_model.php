<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function audit_log($data_ins){
		$this->db->insert('audit_log',$data_ins);
	}
	
	public function get_data_team_list()
	{
		$query = "select id, title, team_desc from team_list where status = 1;";
		
		return $this->db->query($query);
	}
	
	public function update_login($username)
	{
		$query = "update user_credential set last_login=NOW(), is_login=1 where username = ".$this->db->escape($username).";";
		$data_log = array(
			'username'=>$username,
			'application'=>'LOGIN',
			'action'=>'LOGIN',
			'query_txt'=>'',
			'time'=>date('Y-m-d H:i:s'),
		);
		$this->audit_log($data_log);
		return $this->db->query($query);
	}
	
	public function update_logout($username)
	{
		$query = "update user_credential set last_logout=NOW(), is_login=0 where username = ".$this->db->escape($username).";";
		$data_log = array(
			'username'=>$this->session->userdata('ibo_username'),
			'application'=>'LOGOUT',
			'action'=>'LOGOUT',
			'query_txt'=>'',
			'time'=>date('Y-m-d H:i:s'),
		);
		$this->audit_log($data_log);
		return $this->db->query($query);
	}
	
	public function get_data_user($username, $team)
	{
		$query = "select a.username, a.password, a.name, a.team_id, b.title, a.last_login, a.last_logout, a.is_login, a.is_ldap, a.status, a.level from user_credential a left join team_list b on a.team_id = b.id where a.username = ".$this->db->escape($username)." and a.team_id = ".$this->db->escape($team)." and a.status = 1 limit 1;";
		
		return $this->db->query($query);
	}

}

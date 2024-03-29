<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_menu_beranda()
	{
		$team = $this->session->userdata('ibo_team_title');
		$query = "select ml.id, ml.title, ml.url, ml.icon, ml.level, ml.parent_id from menu_list ml join menu_team_map mtm on mtm.menu_id = ml.id where ml.tipe = 'BERANDA' AND mtm.team_id = '".$team."' and ml.status = 1 order by ml.urutan ASC;";
		
		return $this->db->query($query);
	}
	
	public function get_menu_apps($id)
	{
		$team = $this->session->userdata('ibo_team_title');
		
		$query = "select ml.id, ml.title, ml.url, ml.icon, ml.level, ml.parent_id from menu_list ml join menu_team_map mtm on mtm.menu_id = ml.id where (ml.id = ".$id." or ml.group_id = ".$id.") AND mtm.team_id = '".$team."' and ml.status = 1 order by ml.urutan ASC;";
		
		return $this->db->query($query);
	}
	
	public function is_auth_team()
	{
		$team = $this->session->userdata('ibo_team_title');
		$current_url = strtolower(uri_string());
		$query = "select COUNT(1) as jml from menu_list ml join menu_team_map mtm on mtm.menu_id = ml.id where ml.url = '".$current_url."' 
		AND mtm.team_id = '".$team."' and ml.status = 1 order by ml.urutan ASC;";
		if($this->db->query($query)->result()[0]->jml == '0'){
			return FALSE;
		} else {
			return TRUE;
		}
		
		
	}

}

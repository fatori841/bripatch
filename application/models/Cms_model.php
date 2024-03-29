<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CMS_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function patch_logging($data_ins){
		$this->db->insert('patch_log',$data_ins);
	}
	
	//all get data
	public function get_data_user($data)
	{
		$db_cms_slave = $this->load->database('cms_slave', TRUE);
		$data_return = NULL;
		//set view option
		$data_return['search_type'] = $data['search_type'];
		
		//handle not set data
		$client_handle = isset($data['client_handle'])?$data['client_handle']:'';
		$user_handle = isset($data['user_handle'])?$data['user_handle']:'';
		
		//checking data not empty
		if (!empty($client_handle) && !empty($user_handle))
		{
			//select usermaps
			$db_cms_slave->select("cliententity,userentity");
			$db_cms_slave->where("clienthandle",$client_handle);
			$db_cms_slave->where("userhandle",$user_handle);
			$result = $db_cms_slave->get("usermaps")->result();
			foreach($result as $r){
				$cliententity = $r->cliententity;
				$userentity = $r->userentity;
			}
			//checking result not empty
			if (isset($cliententity,$userentity) )
			{
				
				//get client data
				$db_cms_slave->select("id, handle, name, address_1, phone, contactperson_email");
				$db_cms_slave->where("id",$cliententity);
				$data_return['client_profile'] = $db_cms_slave->get("clients")->result();
				
				//get user data
				$db_cms_slave->select("id, handle,firstname,lastname,email,lastlogon,lastlogout,logged");
				$db_cms_slave->where("id",$userentity);
				//echo $db_cms_slave->get_compiled_select('users');
				$data_return['user_profile'] = $db_cms_slave->get("users")->result();
			}
		}
		
		return $data_return;
		
	}
	public function get_data_sch($data)
	{
		$db_cms_slave = $this->load->database('cms_slave', TRUE);
		$data_return = NULL;
		
		//handle not set data
		$search_by = isset($data['search_by'])?$data['search_by']:'';
		$value_txt = isset($data['value_txt'])?$data['value_txt']:'';
		$serverid = isset($data['serverid'])?$data['serverid']:'';
		$fitur = isset($data['fitur'])?$data['fitur']:'';

		//get client data
		$db_cms_slave->select("s.ID as id,s.SCHCODE as schcode,s.FID as fid,IFNULL(f.NAME,'OTHER') AS fitur,s.SERVERID as serverid,s.PATH as path,s.LASTUPDATE as lastupdate,restartstatus");
		$db_cms_slave->from("schmanager s");
		$db_cms_slave->join("functions f","f.ID = s.FID","left");
		if ($search_by == 'search_by_schcode')
		{
			if ($value_txt != '')
			{
				$db_cms_slave->like("s.SCHCODE",$value_txt,'both');
			}
		} else if ($search_by == 'search_by_serverid')
		{
			if ($serverid != '')
			{
				$db_cms_slave->where("s.SERVERID",$serverid);
			}
		} else if ($search_by == 'search_by_fitur')
		{
			if ($fitur != '')
			{
				$db_cms_slave->where("s.FID",$fitur);
			}
		}
		//$db_cms_slave->where("s.RESTARTSTATUS",'3');
		$db_cms_slave->where("s.SCHACTIVE",'y');
		$db_cms_slave->group_by("s.PATH");
		//$coba = $db_cms_slave->get_compiled_select();
		//echo $coba;
		$data_return['sch_not_update'] = $db_cms_slave->get()->result();
		
		return $data_return;
		
	}
	public function get_data_sch_booking()
	{
		$db_cms_slave = $this->load->database('cms_slave', TRUE);
		$data_return = NULL;

		//get client data
		$db_cms_slave->select("s.ID as id,s.SCHCODE as schcode,s.FID as fid,IFNULL(f.NAME,'OTHER') AS fitur,s.SERVERID as serverid,s.PATH as path,s.LASTUPDATE as lastupdate,restartstatus");
		$db_cms_slave->from("schmanager s");
		$db_cms_slave->join("functions f","f.ID = s.FID","left");
		
		$id_array = array('178','238','275','276','277','278','279','280');
		$db_cms_slave->where_in("s.ID",$id_array);
		
		//$db_cms_slave->where("s.RESTARTSTATUS",'3');
		$db_cms_slave->where("s.SCHACTIVE",'y');
		$db_cms_slave->group_by("s.PATH");
		//$coba = $db_cms_slave->get_compiled_select();
		//echo $coba; die;
		$data_return['sch_booking'] = $db_cms_slave->get()->result();
		
		return $data_return;
		
	}
	
	// start of get data trx
	public function get_data_trx_sft($data)
	{
		$db_cms_slave = $this->load->database('cms_slave', TRUE);
		$data_return = NULL;
		
		//handle not set data
		$search_by = isset($data['search_by'])?$data['search_by']:'';
		$value_txt = isset($data['value_txt'])?$data['value_txt']:'';
		
		if ($search_by == 'search_by_sftid')
		{
			if (!empty($value_txt))
			{
				$db_cms_slave->select("*");
				$db_cms_slave->from("trxtransferbri t");
				$db_cms_slave->where("t.ID",$value_txt);
				$db_cms_slave->where("t.batchid","0");
				$data_return["result_trxtransferbri"] = $db_cms_slave->get()->result();
				
				$db_cms_slave->select("*");
				$db_cms_slave->from("booking");
				$db_cms_slave->where("TRXID",$value_txt);
				$db_cms_slave->where("FID",'80');
				$data_return["result_booking"] = $db_cms_slave->get()->result();
				
			}
			
		} else if ($search_by == 'search_by_transactionid')
		{
			if (!empty($value_txt))
			{
				$db_cms_slave->select("*");
				$db_cms_slave->from("transactions t");
				$db_cms_slave->where("t.ID",$value_txt);
				$data_return["result_transaction"] = $db_cms_slave->get()->result();
				
			}
			
		} else if ($search_by == 'search_by_transactionobject')
		{
			if (!empty($value_txt))
			{
				$db_cms_slave->select("*");
				$db_cms_slave->from("transactions t");
				$db_cms_slave->like("t.transactionobject",$value_txt);
				$data_return["result_transaction"] = $db_cms_slave->get()->result();
				
			}
			
		} else if ($search_by == 'search_by_last_sft_client')
		{
			$db_cms_slave->select("*");
			$db_cms_slave->from("trxtransferbri t");
			$db_cms_slave->where("t.CLIENTID",$value_txt);
			$db_cms_slave->where("t.batchid","0");
			$db_cms_slave->order_by("LASTUPDATE",'DESC');
			$db_cms_slave->limit(10,0);
			$data_return["result_trxtransferbri"] = $db_cms_slave->get()->result();
			
		} else if ($search_by == 'search_by_last_transactions_client')
		{
			$db_cms_slave->select("*");
			$db_cms_slave->from("transactions t");
			$db_cms_slave->where("t.CLIENTID",$value_txt);
			$arr_fid = array('80','81','82','83');
			$db_cms_slave->where_in("TRANSACTIONID",$arr_fid);
			$db_cms_slave->order_by("ID",'DESC');
			$db_cms_slave->limit(10,0);
			$data_return["result_transaction"] = $db_cms_slave->get()->result();
		}
		return $data_return;
	}
		public function get_data_trx_cft($data)
	{
		$db_cms_slave = $this->load->database('cms_slave', TRUE);
		$data_return = NULL;
		
		//handle not set data
		$search_by = isset($data['search_by'])?$data['search_by']:'';
		$value_txt = isset($data['value_txt'])?$data['value_txt']:'';
		
		if ($search_by == 'search_by_cftid')
		{
			if (!empty($value_txt))
			{
				$db_cms_slave->select("*");
				$db_cms_slave->from("trxtransferbri t");
				$db_cms_slave->where("t.ID",$value_txt);
				$db_cms_slave->where("t.batchid !=","0");
				$data_return["result_trxtransferbri"] = $db_cms_slave->get()->result();
				
				$db_cms_slave->select("*");
				$db_cms_slave->from("booking");
				$db_cms_slave->where("TRXID",$value_txt);
				$db_cms_slave->where("FID",'80');
				$data_return["result_booking"] = $db_cms_slave->get()->result();
				
			}
			
		} else if ($search_by == 'search_by_transactionid')
		{
			if (!empty($value_txt))
			{
				$db_cms_slave->select("*");
				$db_cms_slave->from("transactions t");
				$db_cms_slave->where("t.ID",$value_txt);
				$data_return["result_transaction"] = $db_cms_slave->get()->result();
				
			}
			
		} else if ($search_by == 'search_by_transactionobject')
		{
			if (!empty($value_txt))
			{
				$db_cms_slave->select("*");
				$db_cms_slave->from("transactions t");
				$db_cms_slave->like("t.transactionobject",$value_txt);
				$data_return["result_transaction"] = $db_cms_slave->get()->result();
				
			}
			
		} else if ($search_by == 'search_by_last_cft_client')
		{
			$db_cms_slave->select("*");
			$db_cms_slave->from("trxtransferbri t");
			$db_cms_slave->where("t.CLIENTID",$value_txt);
			$db_cms_slave->where("t.batchid !=","0");
			$db_cms_slave->order_by("LASTUPDATE",'DESC');
			$db_cms_slave->limit(10,0);
			$data_return["result_trxtransferbri"] = $db_cms_slave->get()->result();
			
		} else if ($search_by == 'search_by_last_transactions_client')
		{
			$db_cms_slave->select("*");
			$db_cms_slave->from("transactions t");
			$db_cms_slave->where("t.CLIENTID",$value_txt);
			$arr_fid = array('86','87','88','89');
			$db_cms_slave->where_in("TRANSACTIONID",$arr_fid);
			$db_cms_slave->order_by("ID",'DESC');
			$db_cms_slave->limit(10,0);
			$data_return["result_transaction"] = $db_cms_slave->get()->result();
		}
		return $data_return;
	}
	// end of get data trx
	
	
	public function get_sch_not_update()
	{
		$db_cms_slave = $this->load->database('cms_slave', TRUE);
		$data_return = NULL;
		
		//get client data
		$db_cms_slave->select("s.ID as id,s.SCHCODE as schcode,s.FID as fid,IFNULL(f.NAME,'OTHER') AS fitur,s.SERVERID as serverid,s.PATH as path,s.LASTUPDATE as lastupdate");
		$db_cms_slave->from("schmanager s");
		$db_cms_slave->join("functions f","f.ID = s.FID","left");
		$db_cms_slave->where("s.LASTUPDATE < NOW() - INTERVAL 30 MINUTE");
		$db_cms_slave->where("s.LASTUPDATE > NOW() - INTERVAL 5 DAY");
		$db_cms_slave->where("s.RESTARTSTATUS",'3');
		$db_cms_slave->where("s.SCHACTIVE",'y');
		$db_cms_slave->group_by("s.PATH");
		//$coba = $db_cms_slave->get_compiled_select();
		//echo $coba;
		$data_return['sch_not_update'] = $db_cms_slave->get()->result();
		
		return $data_return;
	}
	
	
	
	//all update
	public function update_clear_session($datapost)
	{
		$db_cms_master = $this->load->database('cms_master', TRUE);
		$db_cms_master->set('logged', '0');
		$db_cms_master->where('id', $datapost['idcms']);
		$db_cms_master->update("users");
		
		if ($db_cms_master->affected_rows() > 0){
			$msg = 'Clear Session ID '.$datapost['idcms'].' sukses.';
			$status = 1;
		} else{
			$msg = 'Clear Session ID '.$datapost['idcms'].' gagal.';
			$status = 0;
		}
		
		//create data log
		$data_log = array(
			'username'=>$this->session->userdata('ibo_username'),
			'application'=>'CMS',
			'action'=>'UPDATE',
			'query_txt'=>$db_cms_master->last_query(),
			'status'=>$status,
			'patching_date'=>date('Y-m-d H:i:s'),
		);
		$this->patch_logging($data_log);
		
		return $msg;
		
	}
	
	public function update_sch($datapost)
	{
		$msg = $datapost['sch_type'].' Scheduler Gagal.';
		$restartstatus = 0;
		if ($datapost['sch_type'] == "Restart"){ $restartstatus = 1; }
		if ($datapost['sch_type'] == "Shutdown"){ $restartstatus = 4; }

		if (!empty($datapost['idsch']) && $restartstatus != 0)
		{
			$db_cms_master = $this->load->database('cms_master', TRUE);
			$db_cms_master->set('RESTARTSTATUS', $restartstatus);
			$db_cms_master->where('id', $datapost['idsch']);
			//$coba = $db_cms_master->get_compiled_update('schmanager');
			//echo $coba;
			$db_cms_master->update("schmanager");
			
			if ($db_cms_master->affected_rows() > 0){
				$msg = $datapost['sch_type'].' Scheduler ID '.$datapost['idsch'].' sukses.';
				$status = 1;
			} else{
				$msg = $datapost['sch_type'].' Scheduler ID '.$datapost['idsch'].' gagal.';
				$status = 0;
			}
			
			//create data log
			$data_log = array(
				'username'=>$this->session->userdata('ibo_username'),
				'application'=>'CMS',
				'action'=>'UPDATE',
				'query_txt'=>$db_cms_master->last_query(),
				'status'=>$status,
				'patching_date'=>date('Y-m-d H:i:s'),
			);
			$this->patch_logging($data_log);
		}
		
		return $msg;
	}
	public function close_bifast_all()
	{
		$msg = '';
		$restartstatus = 4;
		$fid = '6030';
				
		$db_cms_master = $this->load->database('cms_master', TRUE);
		//$db_cms_master = $this->load->database('cms_dev', TRUE);
		$db_cms_master->set('RESTARTSTATUS', $restartstatus);
		$db_cms_master->where('fid', '6030');
		$db_cms_master->where("SCHACTIVE",'y');
		//$coba = $db_cms_master->get_compiled_update('schmanager');
		//echo $coba; die;
		$db_cms_master->update("schmanager");
		$tot_row = $db_cms_master->affected_rows();
		$lst_qry1 = $db_cms_master->last_query();
		$lst_qry1 .= ' '.date('Y-m-d H:i:s');
		
		//patching diulang karena terkadang tidak shutdown jika bersamaan.
		sleep(10);
		
		$db_cms_master->set('RESTARTSTATUS', $restartstatus);
		$db_cms_master->where('fid', '6030');
		$db_cms_master->where("SCHACTIVE",'y');
		$db_cms_master->update("schmanager");
		$tot_row2 = $db_cms_master->affected_rows();
		$lst_qry2 = $db_cms_master->last_query();
		$lst_qry2 .= ' '.date('Y-m-d H:i:s');
		
		if ($tot_row > 0){
			$msg = 'Close ALL Scheduler BIFAST SUKSES. ('.$tot_row.' SCH)';
			$status = 1;
		} else{
			$msg = 'Close ALL Scheduler BIFAST GAGAL. ('.$tot_row.' SCH)';
			$status = 0;
		}
		
		//create data log
		$data_log = array(
			'username'=>$this->session->userdata('ibo_username'),
			'application'=>'CMS',
			'action'=>'UPDATE',
			'query_txt'=>$lst_qry1.' - '.$lst_qry2,
			'status'=>$status,
			'patching_date'=>date('Y-m-d H:i:s'),
		);
		$this->patch_logging($data_log);
		
		return $msg;
	}
	
	public function open_bifast_all()
	{
		$msg = '';
		$restartstatus = 1;
		$fid = '6030';
				
		$db_cms_master = $this->load->database('cms_master', TRUE);
		//$db_cms_master = $this->load->database('cms_dev', TRUE);
		$db_cms_master->set('RESTARTSTATUS', $restartstatus);
		$db_cms_master->where('fid', '6030');
		$db_cms_master->where("SCHACTIVE",'y');
		//$coba = $db_cms_master->get_compiled_update('schmanager');
		//echo $coba; die;
		$db_cms_master->update("schmanager");
		$tot_row = $db_cms_master->affected_rows();
		if ($tot_row > 0){
			$msg = 'Close ALL Scheduler BIFAST SUKSES. ('.$tot_row.' SCH)';
			$status = 1;
		} else{
			$msg = 'Close ALL Scheduler BIFAST GAGAL. ('.$tot_row.' SCH)';
			$status = 0;
		}
		
		//create data log
		$data_log = array(
			'username'=>$this->session->userdata('ibo_username'),
			'application'=>'CMS',
			'action'=>'UPDATE',
			'query_txt'=>$db_cms_master->last_query(),
			'status'=>$status,
			'patching_date'=>date('Y-m-d H:i:s'),
		);
		$this->patch_logging($data_log);
		
		return $msg;
	}
	
	public function close_booking_all()
	{
		$msg = '';
		$restartstatus = 4;
				
		$db_cms_master = $this->load->database('cms_master', TRUE);
		//$db_cms_master = $this->load->database('cms_dev', TRUE);
		$db_cms_master->set('RESTARTSTATUS', $restartstatus);
		
		$id_array = array('178','238','275','276','277','278','279','280');
		$db_cms_master->where_in("ID", $id_array);
		
		$db_cms_master->where("SCHACTIVE",'y');
		//$coba = $db_cms_master->get_compiled_update('schmanager');
		//echo $coba; die;
		$db_cms_master->update("schmanager");
		$tot_row = $db_cms_master->affected_rows();
		$lst_qry1 = $db_cms_master->last_query();
		$lst_qry1 .= ' '.date('Y-m-d H:i:s');
		
		//patching diulang karena terkadang tidak shutdown jika bersamaan.
		sleep(10);
		
		$db_cms_master->set('RESTARTSTATUS', $restartstatus);
		
		$id_array = array('178','238','275','276','277','278','279','280');
		$db_cms_master->where_in("ID",$id_array);
		
		$db_cms_master->where("SCHACTIVE",'y');
		$db_cms_master->update("schmanager");
		$tot_row2 = $db_cms_master->affected_rows();
		$lst_qry2 = $db_cms_master->last_query();
		$lst_qry2 .= ' '.date('Y-m-d H:i:s');
		
		if ($tot_row > 0){
			$msg = 'Close ALL Scheduler Booking SUKSES. ('.$tot_row.' SCH)';
			$status = 1;
		} else{
			$msg = 'Close ALL Scheduler Booking GAGAL. ('.$tot_row.' SCH)';
			$status = 0;
		}
		
		//create data log
		$data_log = array(
			'username'=>$this->session->userdata('ibo_username'),
			'application'=>'CMS',
			'action'=>'UPDATE',
			'query_txt'=>$lst_qry1.' - '.$lst_qry2,
			'status'=>$status,
			'patching_date'=>date('Y-m-d H:i:s'),
		);
		$this->patch_logging($data_log);
		
		return $msg;
	}
	
	public function open_booking_all()
	{
		$msg = '';
		$restartstatus = 1;
				
		$db_cms_master = $this->load->database('cms_master', TRUE);
		//$db_cms_master = $this->load->database('cms_dev', TRUE);
		$db_cms_master->set('RESTARTSTATUS', $restartstatus);
		
		$id_array = array('178','238','275','276','277','278','279','280');
		$db_cms_master->where_in("ID",$id_array);
		
		$db_cms_master->where("SCHACTIVE",'y');
		//$coba = $db_cms_master->get_compiled_update('schmanager');
		//echo $coba; die;
		$db_cms_master->update("schmanager");
		$tot_row = $db_cms_master->affected_rows();
		if ($tot_row > 0){
			$msg = 'Close ALL Scheduler Booking SUKSES. ('.$tot_row.' SCH)';
			$status = 1;
		} else{
			$msg = 'Close ALL Scheduler Booking GAGAL. ('.$tot_row.' SCH)';
			$status = 0;
		}
		
		//create data log
		$data_log = array(
			'username'=>$this->session->userdata('ibo_username'),
			'application'=>'CMS',
			'action'=>'UPDATE',
			'query_txt'=>$db_cms_master->last_query(),
			'status'=>$status,
			'patching_date'=>date('Y-m-d H:i:s'),
		);
		$this->patch_logging($data_log);
		
		return $msg;
	}
	
	public function get_data_sch_mftpost()
	{
		$db_cms_slave = $this->load->database('cms_slave', TRUE);
		$data_return = NULL;
		
		//get client data
		$db_cms_slave->select("s.ID as id,s.SCHCODE as schcode,s.SERVERID as serverid,s.PATH as path,s.LASTUPDATE as lastupdate,restartstatus");
		$db_cms_slave->from("schmanager s");
		$id_array = array('560','570','580','590','600','610','620','630','640','650','760','770','780','790','800','810','820','830','840','850','870');
		$db_cms_slave->where_in("ID",$id_array);
		
		$db_cms_slave->where("s.SCHACTIVE",'y');
		
		//$coba = $db_cms_slave->get_compiled_select();
		//echo $coba;
		//$data_return['sch_mftpost'] = $db_cms_slave->get()->result();
		return $db_cms_slave->get()->result();
		
		//return $data_return;
		
	}
	
	public function get_Pasarjaya()
	{
		$db_cms_slave = $this->load->database('cms_slave', TRUE);
		$data_return = NULL;
		
		//get client data
		$query = "SELECT 
							  (SELECT COUNT(1) FROM trxmassft WHERE 
							   client IN (1643,5308,5967,6000,6027,6054,6063,6066,6098,6102,6104,6118,6130,6131,6132,6133,6135,6138,6141,6153,6158,6159,6160,6161,12716) AND STATUS =14) AS ParentOnprocess,
							   (SELECT COUNT(1) FROM trxmassftdetail WHERE 
							   CLIENT IN (1643,5308,5967,6000,6027,6054,6063,6066,6098,6102,6104,6118,6130,6131,6132,6133,6135,6138,6141,6153,6158,6159,6160,6161,12716) AND STATUS =14) AS DetailOnprocess,
							   (SELECT COUNT(1) AS ParentParkir FROM trxmassft WHERE 
							   client IN (1643,5308,5967,6000,6027,6054,6063,6066,6098,6102,6104,6118,6130,6131,6132,6133,6135,6138,6141,6153,6158,6159,6160,6161,12716) AND STATUS =141414)AS ParentParkir,
							   (SELECT COUNT(1) FROM trxmassftdetail WHERE 
							   CLIENT IN (1643,5308,5967,6000,6027,6054,6063,6066,6098,6102,6104,6118,6130,6131,6132,6133,6135,6138,6141,6153,6158,6159,6160,6161,12716) AND STATUS =141414) AS DetailParkir";
		
		//$data_return['pasarjaya_data'] = $db_cms_slave->get()->result();
		//return $data_return;
		return $db_cms_slave->query($query);
	}
	//remit 20220124
	public function get_data_remit($data)
	{
		$db_cms_slave = $this->load->database('cms_slave', TRUE);
		$data_return = NULL;
		//set view option
		//$data_return['search_type'] = $data['search_type'];
		
		//handle not set data
		//$client_handle = isset($data['client_handle'])?$data['client_handle']:'';
		//$user_handle = isset($data['user_handle'])?$data['user_handle']:'';
		
		//checking data not empty
		//if (!empty($client_handle) && !empty($user_handle))
		//{
			//select usermaps
			$where = "STATUS = 4 and CREATEDTIME > CURDATE()";
			$db_cms_slave->select("NO_REMITANCE,TRXTYPE,STATUS,DESCRIPTION");
			$db_cms_slave->where($where);
			$data_return['get_remit']  = $db_cms_slave->get("expressprocess")->result();
			/*foreach($result as $r){
				$NO_REMITANCE = $r->NO_REMITANCE;
				$TRXTYPE = $r->TRXTYPE;
				$STATUS = $r->STATUS;
				$DESCRIPTION = $r->DESCRIPTION;
			}*/
			//checking result not empty
			/*if (isset($cliententity,$userentity) )
			{
				
				//get client data
				$db_cms_slave->select("id, handle, name, address_1, phone, contactperson_email");
				$db_cms_slave->where("id",$cliententity);
				$data_return['client_profile'] = $db_cms_slave->get("clients")->result();
				
				//get user data
				$db_cms_slave->select("id, handle,firstname,lastname,email,lastlogon,lastlogout,logged");
				$db_cms_slave->where("id",$userentity);
				//echo $db_cms_slave->get_compiled_select('users');
				$data_return['user_profile'] = $db_cms_slave->get("users")->result();
			}*/
		//}
		
		return $data_return;
		
	}
}

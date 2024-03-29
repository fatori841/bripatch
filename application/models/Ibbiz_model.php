<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ibbiz_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	
	public function get_data_client($data)
	{		
	
		$db_ibbiz = $this->load->database('ibbiz_slave', TRUE);
		$idclient = NULL;
		$data_return = NULL;
		
		
		if ($data['parameter_txt'] == 'corp_id_opt'){
			$query = "SELECT ID FROM client a WHERE a.HANDLE = '".$data['value_txt']."' order by id DESC LIMIT 1;"; 
			$result = $db_ibbiz->query($query)->result();
			foreach($result as $r){
				$idclient = $r->ID;
			}
		} else if ($data['parameter_txt']  == 'account_opt'){
			$query = "SELECT ID FROM client a WHERE a.ACCOUNT = '".$data['value_txt']."' order by id DESC LIMIT 1;"; 
			$result = $db_ibbiz->query($query)->result();
			if ($result == NULL){
				$query = "SELECT PID as ID FROM clientaccount a WHERE a.ACCOUNT = '".$data['value_txt']."' order by id DESC LIMIT 1;"; 
				$result = $db_ibbiz->query($query)->result();
				$pesan = "Account di 1 CIF yang sama dengan Account yang memiliki user IBBIZ";
				echo "<script type='text/javascript'>alert('$pesan');</script>";
				
			}
			foreach($result as $r){
				$idclient = $r->ID;
			}
			
		} else if ($data['parameter_txt'] == 'cif_opt'){
			$query = "SELECT ID FROM client a WHERE a.CIF = '".$data['value_txt']."' order by id DESC LIMIT 1;"; 
			$result = $db_ibbiz->query($query)->result();
			foreach($result as $r){
				$idclient = $r->ID;
			}
		} else if ($data['parameter_txt'] == 'client_id_opt'){
			$idclient = $data['value_txt'];
			
		} else if ($data['parameter_txt'] == 'alias_opt'){
			$query = "SELECT ID FROM client a WHERE a.ALIAS = '".$data['value_txt']."' order by id DESC LIMIT 1;"; 
			$result = $db_ibbiz->query($query)->result();
			foreach($result as $r){
				$idclient = $r->ID;
			}
		} else if ($data['parameter_txt'] == 'refnum_opt'){
			$query = "SELECT ID FROM client a WHERE a.REFNUM = '".$data['value_txt']."' order by id DESC LIMIT 1;"; 
			$result = $db_ibbiz->query($query)->result();
			foreach($result as $r){
				$idclient = $r->ID;
			}
		}
		
		if($idclient != NULL){

			$query = "SELECT a.ALIAS, a.ID, a.HANDLE, a.NAME, a.CREATEDDATE, a.LASTUPDATE, a.CIF, a.CARDNUM, a.ACCOUNT, a.CHECKERTOTAL, a.SIGNERTOTAL, a.`STATUS`, a.DESCRIPTION, a.REGEXPIRYDATE, a.REFNUM FROM `client` a WHERE a.id = ".$idclient." order by id DESC;";
			$data_return['client'] = $db_ibbiz->query($query)->result();
			
			$query = "SELECT a.PID, a.LASTUPDATE, a.CODE, a.ACCOUNT, a.CARDNUM, a.CURRENCY, a.`TYPE`, a.CIF, a.`STATUS`, a.DESCRIPTION FROM clientaccount a WHERE a.PID = ".$idclient." order by id DESC;";
			$data_return['clientaccount'] = $db_ibbiz->query($query)->result();
			
			$query = "SELECT b.ID, b.HANDLE, b.NAME, b.CREATEDDATE, b.LASTUPDATE, b.EMAIL, b.HANDPHONE, b.LASTLOGIN, b.LASTLOGOUT, b.WRGPASSWORD, b.LOGIN, b.`STATUS`, b.DESCRIPTION FROM `usermap` a RIGHT JOIN `user` b ON a.USERENTITY = b.ID WHERE a.cliententity = ".$idclient." order by id DESC;";
			$data_return['user'] = $db_ibbiz->query($query)->result();
			
			$query = "SELECT a.ID, a.CLIENTID, a.USERID, b.HANDLE , a.ACCOUNT  FROM clientaccountmatrix a JOIN user b ON a.USERID = b.ID WHERE  a.CLIENTID = ".$idclient." ORDER BY id DESC;";
			$data_return['client_account_matrix'] = $db_ibbiz->query($query)->result();
			
		}
			
		return $data_return;
	}
	
	public function get_data_token($data)
	{			
		$db_ibbiz_token = $this->load->database('ibbiz_token', TRUE);
		
		$data_return = NULL;
		
		
		if($data['value_txt'] != ''){

			$query = "SELECT a.username, a.activity, a.remark, FROM_UNIXTIME(a.edit_time) AS edit_time FROM st_user_activity a WHERE a.username = '".$data['value_txt']."' ORDER BY id DESC LIMIT 50;";
			
			$data_return['st_user_activity'] = $db_ibbiz_token->query($query)->result();
			
			$query = "SELECT a.username, a.cellphone_number, a.cellphone_id, a.imei, FROM_UNIXTIME(a.activation_time) AS activation_time , a.activation_status, FROM_UNIXTIME(a.created_time) AS created_time FROM st_user a WHERE a.username = '".$data['value_txt']."';";
			
			$data_return['st_user'] = $db_ibbiz_token->query($query)->result();
		}
			
		return $data_return;
	}
	
	public function get_data_payment_stuck($data)
	{		
	
		//$db_ibbiz_slave = $this->load->database('db_ibbiz_149', TRUE);
		$db_ibbiz_slave = $this->load->database('ibbiz_slave', TRUE);
		$data_return = NULL;
		
		$id_payment = $data["value_txt"];
		
		if($data['value_txt'] != ''){

			$query = "SELECT a.ID, a.FID, a.TRXID, a.JENISTRANSAKSI, a.CREATIONDATE, a.CLIENTID, a.PAYMENTCODE, a.DEBITACCOUNT, a.DEBITACCOUNTNAME, a.CREDITACCOUNT, a.CREDITACCOUNTNAME, a.CURRENCY, a.AMOUNT, a.TRXDATE, a.`STATUS`, a.DESCRIPTION, a.ESBEXTERNALID, a.ESBRESPONSEMSG from payment a WHERE a.ID = ".$id_payment.";";
		
		$data_return['payment_stuck'] = $db_ibbiz_slave->query($query)->result();
		
		}

		return $data_return;
	}
	
	public function patch_data_payment_stuck($data)
	{		
		$db_ibbiz_master = $this->load->database('ibbiz_master', TRUE);
		//$db_ibbiz_master = $this->load->database('db_ibbiz_149', TRUE);
		
		$id_payment = $data["idibbiz"];
		
		if($id_payment != ''){

			$query = "UPDATE payment SET STATUS = 6, DESCRIPTION = 'FAILED' WHERE ID = ".$id_payment.";";
						
			$db_ibbiz_master->query($query);

			
			if ($db_ibbiz_master->affected_rows() > 0){
				$msg = 'Payment stuck pada ID '.$data['idibbiz'].' berhasil digagalkan.';
				$status = 1;
			} else{
				$msg = 'Payment stuck pada ID '.$data['idibbiz'].' gagal digagalkan.';
				$status = 0;
			}
			
			//create data log
			$data_log = array(
				'username'=>$this->session->userdata('ibo_username'),
				'application'=>'IBBIZ',
				'action'=>'UPDATE',
				'query_txt'=>$db_ibbiz_master->last_query(),
				'status'=>$status,
				'patching_date'=>date('Y-m-d H:i:s'),
			);
			$this->patch_logging($data_log);
		}
		
			
		return $msg;
	}
	
	public function get_data_client_account($data)
	{		
	
		//$db_ibbiz_slave = $this->load->database('db_ibbiz_149', TRUE);
		$db_ibbiz_slave = $this->load->database('ibbiz_slave', TRUE);
		$data_return = NULL;
		
		$id_client_account = $data["value_txt"];
		
		if($data['value_txt'] != ''){

			$query = "SELECT a.ID, a.PID, a.LASTUPDATE, a.CODE, a.ACCOUNT, a.CARDNUM, a.CURRENCY, a.`TYPE`, a.CIF, a.`STATUS`, a.DESCRIPTION FROM clientaccount a INNER JOIN `client` b ON a.PID = b.ID WHERE a.STATUS = 1 AND b.STATUS = 1 AND a.ACCOUNT = '".$id_client_account."';";
		
		$data_return['client_account'] = $db_ibbiz_slave->query($query)->result();
		
		}

		return $data_return;
	}
	
	public function patch_data_client_account($data)
	{	
		//$db_ibbiz_master = $this->load->database('db_ibbiz_149', TRUE);
		$db_ibbiz_master = $this->load->database('ibbiz_master', TRUE);
		
		$value_CARDNUM = $data["cardnum_account_txt"];
		$value_TYPE = $data["type_account_txt"];
		$value_ID = $data["id_account_txt"];
		
		if($value_ID != ''){

			$query = "UPDATE clientaccount SET CARDNUM = '".$value_CARDNUM."', TYPE = '".$value_TYPE."' WHERE ID = ".$value_ID.";";
			
			$db_ibbiz_master->query($query);
			
			if ($db_ibbiz_master->affected_rows() > 0){
				$msg = 'data rekening dengan ID '.$value_ID.' berhasil disesuaikan.';
				$status = 1;
			} else{
				$msg = 'data rekening dengan ID '.$value_ID.' gagal disesuaikan';
				$status = 0;
			}
			
			//create data log
			$data_log = array(
				'username'=>$this->session->userdata('ibo_username'),
				'application'=>'IBBIZ',
				'action'=>'UPDATE',
				'query_txt'=>$db_ibbiz_master->last_query(),
				'status'=>$status,
				'patching_date'=>date('Y-m-d H:i:s'),
			);
			$this->patch_logging($data_log);
		}
		
			
		return $msg;
	}
	
	public function insert_data_client_account($data)
	{		
		$db_ibbiz_master = $this->load->database('ibbiz_master', TRUE);
		//$db_ibbiz_master = $this->load->database('db_ibbiz_149', TRUE);
		
		$pid 		= $data['pid_txt'];
		$code 		= strtoupper($data['code_txt']);
		$account 	= $data['account_txt'];
		$cardnum 	= $data['cardnum_txt'];
		$currency 	= strtoupper($data['currency_txt']);
		$type 		= strtoupper($data['type_txt']);
		$cif 		= strtoupper($data['cif_txt']);
		$status 	= $data['status_txt'];
		$description= strtoupper($data['description_txt']);
		
		
		$query = "INSERT INTO `clientaccount` (`PID`, `LASTUPDATE`, `CODE`, `ACCOUNT`, `CARDNUM`, `CURRENCY`, `TYPE`, `CIF`, `STATUS`, `DESCRIPTION`, `PROCESSTIME`) VALUES (".$pid.", NOW(), '".$code."', '".$account."', '".$cardnum."', '".$currency."', '".$type."' , '".$cif."', ".$status.", '".$description."', NOW()) ;";
		
		$db_ibbiz_master->query($query);
		
		if ($db_ibbiz_master->affected_rows() > 0){
			$msg = 'Data Client Account '.$account.' berhasil ditambahkan.';
			$status = 1;
		} else{
			$msg = 'Data Client Account '.$account.' gagal ditambahkan.';
			$status = 0;
		}
		
		//create data log
		$data_log = array(
			'username'=>$this->session->userdata('ibo_username'),
			'application'=>'IBBIZ',
			'action'=>'INSERT',
			'query_txt'=>$db_ibbiz_master->last_query(),
			'status'=>$status,
			'patching_date'=>date('Y-m-d H:i:s'),
		);
		$this->patch_logging($data_log);
			
		return $msg;
	}
	
	//public function get_data_do_pertamina($data)
	//{
	//	
	//	$data_return = NULL;
	//	
	//	$txt = $data['value_txt'];
	//	$param = $data['parameter_txt'];
	//	
	//	if ($param == "cashcarry_opt"){
	//		if (strlen($txt) == 40){
	//			$sold_to = substr($txt, 4, 6); // (teksnya,mulai dari char brp, brp yg diambil)
	//			$data_return['sold_to'] = $sold_to;
	//			
	//			$no_aplikasi = substr($txt, 10, 12);
	//			$data_return['no_aplikasi'] = $no_aplikasi;
	//			
	//			$no_so = substr($txt, 22,10);
	//			$data_return['no_so'] = $no_so;
	//			
	//			$office = substr($txt, 32, 4);
	//			$data_return['office'] = $office;
	//			
	//			$plant = substr($txt, 36, 4);
	//			$data_return['plant'] = $plant;
	//			
	//			$data_return['param'] = $param;
	//		}
	//	}
	//	
	//
	//				
	//	return $data_return;
	//}
	
	public function get_data_client_account_matrix($data)
	{		
	
		//$db_ibbiz_slave = $this->load->database('db_ibbiz_149', TRUE);
		$db_ibbiz_slave = $this->load->database('ibbiz_slave', TRUE);
		$data_return = NULL;
		
		$client_id = $data["value_txt"];
		
		if($client_id != ''){

			$query = "SELECT a.ID, a.CLIENTID, a.USERID, b.HANDLE , a.ACCOUNT  FROM clientaccountmatrix a JOIN user b ON a.USERID = b.ID WHERE  a.CLIENTID = ".$client_id." ORDER BY id DESC;";
		
		$data_return['client_account_matrix'] = $db_ibbiz_slave->query($query)->result();
		
		}
		
		return $data_return;
	}
	
	public function get_data_payment($data)
	{		
	
		//$db_ibbiz_slave = $this->load->database('db_ibbiz_149', TRUE);
		$db_ibbiz_slave = $this->load->database('ibbiz_slave', TRUE);
		$data_return = NULL;
		
		$debitaccount = $data["value_txt"];
		$start_date = $data["start_date"] . ' ' . "00:00:00";
		$end_date = $data["end_date"] . ' ' . "23:59:59";
		
		if($debitaccount != ''){

			$query = "SELECT a.ID, a.PID, a.FID, a.TRXID, a.CREATIONDATE, a.JENISTRANSAKSI, a.CLIENTID, a.PAYMENTCODE, a.DEBITACCOUNT, a.DEBITACCOUNTNAME, a.CREDITACCOUNT, a.CREDITACCOUNTNAME, a.CURRENCY, a.AMOUNT, a.MAKER, a.CHECKER, a.CHECKERWORK, a.CHECKERTOTAL, a.SIGNER, a.SIGNERWORK, a.SIGNERTOTAL, a.TRXDATE, a.LASTUPDATE, a.`STATUS`, a.DESCRIPTION, a.ESBEXTERNALID, a.ESBRESPONSEMSG, a.info1, a.info2, a.info3, a.info4, a.info5, a.info6, a.info7, a.info8, a.info9, a.info10,a.info11, a.info12, a.info13, a.info14, a.info15, a.info16, a.info17, a.info18, a.info19, a.info20 FROM payment a where a.debitaccount = '".$debitaccount."' and a.trxdate >= '".$start_date."' and a.trxdate <= '".$end_date."' order by id desc LIMIT 50;";
		
		$data_return['payment'] = $db_ibbiz_slave->query($query)->result();
		
		}
		
		return $data_return;
	}
	
	public function get_data_transfer($data)
	{		
	
		//$db_ibbiz_slave = $this->load->database('db_ibbiz_149', TRUE);
		$db_ibbiz_slave = $this->load->database('ibbiz_slave', TRUE);
		$data_return = NULL;
		
		$debitaccount = $data["value_txt"];
		$start_date = $data["start_date"] . ' ' . "00:00:00";
		$end_date = $data["end_date"] . ' ' . "23:59:59";
		
		if($debitaccount != ''){

			$query = "SELECT a.ID, a.PID, a.FID, a.TRXID, a.CREATIONDATE, a.JENISTRANSAKSI, a.CLIENTID, a.DEBITACCOUNT, a.DEBITACCOUNTNAME, a.CREDITACCOUNT, a.CREDITACCOUNTNAME, a.DEBITCURRENCY, a.CREDITCURRENCY, a.DEBITAMOUNT, a.CREDITAMOUNT, a.TRXREMARK, a.MAKER, a.CHECKER, a.CHECKERWORK, a.CHECKERTOTAL, a.SIGNER, a.SIGNERWORK, a.SIGNERTOTAL, a.TRXDATE, a.STARTDATE, a.ENDDATE, a.LASTUPDATE, a.NOTIFICATION, a.`STATUS`, a.DESCRIPTION, a.ESBEXTERNALID, a.ESBRESPONSEMSG, a.RMNUMBER, a.AMOUNTIDR FROM transfer a where a.debitaccount = '".$debitaccount."' and a.trxdate >= '".$start_date."' and a.trxdate <= '".$end_date."' order by id desc limit 50;";
		
		$data_return['transfer'] = $db_ibbiz_slave->query($query)->result();
		
		
		
		}
		
		return $data_return;
	}
	
	public function get_data_email($data)
	{		
	
		//$db_ibbiz_slave = $this->load->database('db_ibbiz_149', TRUE);
		$db_ibbiz_slave = $this->load->database('ibbiz_slave', TRUE);
		$data_return = NULL;
		
		$client_id = $data["value_txt"];
		
		if($client_id != ''){

			$query = "SELECT ID, TRXID, CLIENTID, SUBJECT, RECEIVER, CONTENT, STATUS, CREATEDTIME, LASTUPDATE FROM email WHERE CLIENTID = ".$client_id." ORDER BY id DESC LIMIT 10;";
		
		$data_return['email'] = $db_ibbiz_slave->query($query)->result();
		
		}
		
		return $data_return;
	}
	
	public function patch_logging($data_ins){
		$this->db->insert('patch_log',$data_ins);
	}
	
	public function get_data_table_bankbifast(){
		$db_ibbiz_slave = $this->load->database('ibbiz_slave', TRUE);
		
		$query_get_all_data_tbl_bankbifast = "SELECT * FROM bankbifast ORDER BY id asc;";
		$data_return['data_tbl_bankbifast'] = $db_ibbiz_slave->query($query_get_all_data_tbl_bankbifast)->result();
		
		return $data_return;
	}
	
	
	public function close_bifast_all()
	{
		
		$db_ibbiz_149 = $this->load->database('db_ibbiz_149', TRUE);
		$db_ibbiz_slave = $this->load->database('ibbiz_slave', TRUE);
		$db_ibbiz_master = $this->load->database('ibbiz_master', TRUE);
		//$db_brimo_master = $this->load->database('db_brimo_149', TRUE);
		
		$query_status_param_bifast_open = "SELECT status FROM ibbiz_bripatch_param WHERE NAME = 'bifast_open';";
		$get_status_param_bifast_open = $db_ibbiz_149->query($query_status_param_bifast_open)->row()->status;
		
		if($get_status_param_bifast_open == 1){
			//$query_get_tbl_bank = "SELECT * FROM bankbifast where status = 1;";
			//$get_get_tbl_bank = $db_ibbiz_slave->query($query_get_tbl_bank)->result();
			
			
			
			/*
			//delete isi tbl_bank_backup di db sao
			$query_delete_backup = "TRUNCATE TABLE `bankbifast_backup`;";
			$delete_backup = $db_ibbiz_149->query($query_delete_backup);
			
			$data_return['closed_bifast'] = array();
			$bank_code_tutup = "";
		
			foreach($get_get_tbl_bank as $key => $d){
				$ID = $d->ID;
				$NAMA = $d->NAMA;
				$ADDRESS1 = $d->ADDRESS1;
				$BANKCODE = $d->BANKCODE;
				$STATUS = $d->STATUS;
				$ORDER = $d->ORDER;	
				
				// backup semua data di tbl_bank ke tbl_bank_backup
				$query_insert_backup = "INSERT INTO `bankbifast_backup` VALUES ( '".$ID."','".$NAMA."','".$ADDRESS1."','".$BANKCODE."','".$STATUS."','".$ORDER."');";
				$insert_backup = $db_ibbiz_149->query($query_insert_backup);
				
				array_push($data_return['closed_bifast'], $bank_name);
				
				if($bank_code_tutup == ""){
					$bank_code_tutup .= $BANKCODE;
				} else {
					$bank_code_tutup .= "','".$BANKCODE;
				}
				//if($is_bifast == 1){
				//}
			}
			
			//ubah is_bifast di tbl_bank jadi 0 yang awalnya is_bifast nya 1 dan buat log patching di db ibo
			//kalau sudah ok ini dibuka
			*/
			
			//$query_update_status_status_bankbifast = "UPDATE tbl_bank SET status = 0 WHERE `bank_code` in ('".$bank_code_tutup."');";
			$query_update_status_status_bankbifast = "UPDATE bankbifast SET STATUS = 0 WHERE STATUS = 1;";
			
			$update_status_status_tbl_bank = $db_ibbiz_master->query($query_update_status_status_bankbifast);
			
			if ($db_ibbiz_master->affected_rows() > 0){
				$msg = 'Menutup BI Fast All Ibbiz berhasil Dilakukan.';
				$STATUS = 1;
			} else{
				$msg = 'Menutup BI Fast All Ibbiz gagal Dilakukan.';
				$STATUS = 0;
			}
			
			//create data log
			$data_log = array(
				'username'=>$this->session->userdata('ibo_username'),
				'application'=>'IBBIZ',
				'action'=>'UPDATE',
				'query_txt'=>$db_ibbiz_master->last_query(),
				'status'=>$STATUS,
				'patching_date'=>date('Y-m-d H:i:s'),
			);
			$this->patch_logging($data_log);
			
			
			
			$query_update_status_param_bifast_open = "UPDATE ibbiz_bripatch_param SET STATUS = 0, last_executed = NOW() WHERE name = 'bifast_open';";
			$update_status_param_bifast_open = $db_ibbiz_149->query($query_update_status_param_bifast_open);
			
			$pesan = "semua BIFAST berhasil ditutup";
			echo "<script type='text/javascript'>alert('$pesan');</script>";
			return $this->get_data_table_bankbifast();
			
		} else {
			echo '<h5 style="color:red;background-color:lithgrey;" align="center">Gagal!! BIFAST masih Close</h5>';
			return $this->get_data_table_bankbifast();
		}
	
	}
	
	public function open_bifast()
	{
		$db_ibbiz_149 = $this->load->database('db_ibbiz_149', TRUE);
		$db_ibbiz_slave = $this->load->database('ibbiz_slave', TRUE);
		$db_ibbiz_master = $this->load->database('ibbiz_master', TRUE);
		//$db_brimo_master = $this->load->database('db_brimo_149', TRUE);
		
		$query_status_param_bifast_open = "SELECT status FROM ibbiz_bripatch_param WHERE NAME = 'bifast_open';";
		$get_status_param_bifast_open = $db_ibbiz_149->query($query_status_param_bifast_open)->row()->status;
		
		if($get_status_param_bifast_open == 0){
			
			/*
			$query_get_bank_code_bankbifast_backup = "SELECT BANKCODE, NAMA FROM bankbifast_backup;";
			$get_bank_code_bankbifast = $db_ibbiz_149->query($query_get_bank_code_bankbifast_backup)->result();
			
			$data_return['open_bifast'] = array();
			$bank_code_buka = "";
			
			foreach($get_bank_code_bankbifast as $key => $d){
				$BANKCODE = $d->BANKCODE;
				$NAMA = $d->NAMA;
				
				
				
				if($bank_code_buka == ""){
					$bank_code_buka .= $BANKCODE;
				} else {
					$bank_code_buka .= "','".$BANKCODE;
				}
				
				array_push($data_return['open_bifast'], $NAMA);
			}
		
			
			$query_update_status_bankbifast = "UPDATE tbl_bank SET status = 1 WHERE `BANKCODE` in ( '".$bank_code_buka."');";
			*/
			
			
			$query_update_status_bankbifast = "UPDATE bankbifast SET STATUS = 1 WHERE STATUS = 0";
			$update_status_bankbifast = $db_ibbiz_master->query($query_update_status_bankbifast);
			
			if ($db_ibbiz_master->affected_rows() > 0){
				$msg = 'Membuka BI Fast All Ibbiz berhasil Dilakukan.';
				$STATUS = 1;
			} else{
				$msg = 'Membuka BI Fast All Ibbiz gagal Dilakukan.';
				$STATUS = 0;
			}
			
			//create data log
			$data_log = array(
				'username'=>$this->session->userdata('ibo_username'),
				'application'=>'IBBIZ',
				'action'=>'UPDATE',
				'query_txt'=>$db_ibbiz_master->last_query(),
				'status'=>$STATUS,
				'patching_date'=>date('Y-m-d H:i:s'),
			);
			$this->patch_logging($data_log);
			
			$query_update_status_param_bifast_open = "UPDATE ibbiz_bripatch_param SET STATUS = 1, last_executed = NOW() WHERE name = 'bifast_open';";
			$update_status_param_bifast_open = $db_ibbiz_149->query($query_update_status_param_bifast_open);

			$pesan = "Semua BIFAST berhasil dibuka";
			echo "<script type='text/javascript'>alert('$pesan');</script>";
			return $this->get_data_table_bankbifast();
			
		}else {
			echo '<h5 style="color:red;background-color:lithgrey;" align="center">Gagal!! BIFAST masih Open</h5>';
			return $this->get_data_table_bankbifast();
		}
	}
	
	
	public function buka_tutup_bifast_satuan($datapost)
	{
		$db_ibbiz_149 = $this->load->database('db_ibbiz_149', TRUE);
		$db_ibbiz_slave = $this->load->database('ibbiz_slave', TRUE);
		$db_ibbiz_master = $this->load->database('ibbiz_master', TRUE);
		
		$BANKCODE = $datapost['BANKCODE'];
		
		$query_cek_status = "SELECT * FROM bankbifast WHERE BANKCODE = '".$BANKCODE."';";
		$cek_status = $db_ibbiz_slave->query($query_cek_status)->result();
		
		
		
		//$buka_bifast = false;
		
		foreach($cek_status as $key => $d){
				$BANKCODE = $d->BANKCODE;
				$NAMA = $d->NAMA;
				$STATUS = $d->STATUS;
				
				if($STATUS == "1"){
					$query_update_status_bankbifast = "UPDATE bankbifast SET STATUS = 0 WHERE `BANKCODE` = '".$BANKCODE."';";
					$update_status_bankbifast = $db_ibbiz_master->query($query_update_status_bankbifast);
					
					//create data log
					
					if ($db_ibbiz_master->affected_rows() > 0){
						$status = 1;
					} else{
						$status = 0;
					}
					
					$data_log = array(
						'username'=>$this->session->userdata('ibo_username'),
						'application'=>'IBBIZ',
						'action'=>'UPDATE',
						'query_txt'=>$db_ibbiz_master->last_query(),
						'status'=>$status,
						'patching_date'=>date('Y-m-d H:i:s'),
					);
					$this->patch_logging($data_log);
					
					//$buka_bifast = false;
					$pesan = "BIFAST menuju ".$NAMA."berhasil ditutup";
					echo "<script type='text/javascript'>alert('$pesan');</script>";
					return $this->get_data_table_bankbifast();
					
				} else if($STATUS == "0"){
					$query_update_status_bankbifast = "UPDATE bankbifast SET status = 1 WHERE `BANKCODE` = '".$BANKCODE."';";
					$update_status_bankbifast = $db_ibbiz_master->query($query_update_status_bankbifast);
					
					//vardump(update_status_bankbifast);
					//die;
					//create data log
					
					if ($db_ibbiz_master->affected_rows() > 0){
						$status = 1;
					} else{
						$status = 0;
					}
					
					$data_log = array(
						'username'=>$this->session->userdata('ibo_username'),
						'application'=>'IBBIZ',
						'action'=>'UPDATE',
						'query_txt'=>$db_ibbiz_master->last_query(),
						'status'=>$status,
						'patching_date'=>date('Y-m-d H:i:s'),
					);
					$this->patch_logging($data_log);
					
					//$buka_bifast = true;
					$pesan = "BIFAST menuju ".$NAMA."berhasil dibuka";
					echo "<script type='text/javascript'>alert('$pesan');</script>";
					return $this->get_data_table_bankbifast();
					
				}
			}
	
	}
	
	
	public function get_data_do_pertamina($data)
	{		
	
		//$db_ibbiz_slave = $this->load->database('db_ibbiz_149', TRUE);
		$db_ibbiz_slave = $this->load->database('ibbiz_slave', TRUE);
		$data_return = NULL;
		
		$payment_code = $data["value_txt"];
		
		if($data['value_txt'] != ''){

			$query = "SELECT * FROM payment a WHERE a.FID = '230' and a.PAYMENTCODE = '".$payment_code."';";
		
		$data_return['do_pertamina'] = $db_ibbiz_slave->query($query)->result();
		
		}

		return $data_return;
	}
	
	public function patch_data_do_pertamina($data)
	{	
		//$db_ibbiz_master = $this->load->database('db_ibbiz_149', TRUE);
		$db_ibbiz_master = $this->load->database('ibbiz_master', TRUE);
		
		$value_info13 = $data["info13_txt"];
		$value_status = $data["status_txt"];
		$value_description = $data["description_txt"];
		$value_paymentcode = $data["paymentcode_txt"];
		
		if($value_paymentcode != ''){

			$query = "UPDATE payment SET INFO13 = '".$value_info13."', STATUS = '".$value_status."', DESCRIPTION = '".$value_description."' WHERE FID = '230' AND PAYMENTCODE = ".$value_paymentcode.";";
			
			$db_ibbiz_master->query($query);
			
			if ($db_ibbiz_master->affected_rows() > 0){
				$msg = 'Data DO Pertamina dengan PAYMENTCODE '.$value_paymentcode.' berhasil disesuaikan.';
				$status = 1;
			} else{
				$msg = 'Data DO Pertamina dengan PAYMENTCODE '.$value_paymentcode.' gagal disesuaikan.';
				$status = 0;
			}
			
			//create data log
			$data_log = array(
				'username'=>$this->session->userdata('ibo_username'),
				'application'=>'IBBIZ',
				'action'=>'UPDATE',
				'query_txt'=>$db_ibbiz_master->last_query(),
				'status'=>$status,
				'patching_date'=>date('Y-m-d H:i:s'),
			);
			$this->patch_logging($data_log);
		}
		
			
		return $msg;
	}
}

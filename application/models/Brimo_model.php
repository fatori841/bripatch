<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brimo_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function patch_logging($data_ins){
		$this->db->insert('patch_log',$data_ins); //q1
	}
	
	public function audit_log($data_ins){
		$this->db->insert('audit_log',$data_ins); //q2
	}
	
	public function get_data_user($data)
	{		
		$db_brimo = $this->load->database('brimo_slave', TRUE);
		$username = '';
		$data_return = NULL;
		
		if ($data['parameter_txt'] == 'username_opt'){
			$username = $data['value_txt'];
			
		} else if ($data['parameter_txt']  == 'user_alias_opt'){
			$query = "select username from tbl_user_alias where user_alias = '".$data['value_txt']."' limit 1;"; 
			$result = $db_brimo->query($query)->result();
			foreach($result as $r){
				$username = $r->username;
			}
			
		} else if ($data['parameter_txt'] == 'account_opt'){
			$query = "select username from tbl_user_account where account = '".$data['value_txt']."' limit 1;";
			$result = $db_brimo->query($query)->result();
			foreach($result as $r){
				$username = $r->username;
			}
		}
		
		if($username != ''){
			$query = "select username, name, cellphone_number, email_address, cif from tbl_user_profile where username = '".$username."' limit 1;";
			$data_return['user_profile'] = $db_brimo->query($query)->result();
			
			$query = "SELECT a.username,b.user_alias, a.registered_date, a.approved_by, a.`status`, a.login_status, a.last_login FROM tbl_user a left join tbl_user_alias b ON a.username = b.username WHERE a.username = '".$username."';";
			$data_return['user_alias'] = $db_brimo->query($query)->result();
			
			$query = "SELECT username, `account`, account_name, type_account, product_type, currency, card_number, `status`, finansial_status, `default`, sc_code FROM tbl_user_account WHERE username = '".$username."';";
			$data_return['user_account'] = $db_brimo->query($query)->result();
			
			$query = "SELECT username, main_account, account_debet, account_deposito, amount, currency, period, publish_date, maturity_date, deposit_type, `status`, cif FROM tbl_user_deposito WHERE username = '".$username."';";
			$data_return['user_deposito'] = $db_brimo->query($query)->result();
		}
			
		return $data_return;
	}
	
	public function get_data_deleted_user($data)
	{		
		$db_brimo = $this->load->database('brimo_slave', TRUE);
		$username = '';
		$deleted_username = '';
		$data_return = NULL;
		
		## New user 
		if ($data['parameter_txt'] == 'account_opt'){
			$query = "select username from tbl_user_account where account = '".$data['value_txt']."' limit 1;";
			$result = $db_brimo->query($query)->result();
			foreach($result as $r){
				$username = $r->username;
			}
		}
		
		if($username != ''){
			$query = "SELECT a.username,b.user_alias, a.registered_date, a.approved_by, a.`status`, a.login_status, a.last_login FROM tbl_user a left join tbl_user_alias b ON a.username = b.username WHERE a.username = '".$username."';";
			$data_return['data_new_user'] = $db_brimo->query($query)->result();

		}
		
		## Old user or Deleted
		if ($data['parameter_txt'] == 'account_opt'){
			$query = "select username from ibank_del.tbl_user_account where account = '".$data['value_txt']."' ORDER BY id DESC LIMIT 1;";
			$result = $db_brimo->query($query)->result();
			foreach($result as $r){
				$deleted_username = $r->username;
			}
		}
		
		if($deleted_username != ''){
			$exploded_username = explode("#",$deleted_username);
			if (strlen($exploded_username[0]) > 3 && strlen($exploded_username[0]) <= 10){
				$is_include_special_char=preg_match('/[^a-zA-Z0-9\s]/',$exploded_username[0]);
				if (!$is_include_special_char){
					$query = "SELECT id,username,activity,remarks,edit_by,edit_date FROM tbl_user_mnt_log WHERE username = '".$exploded_username[0]."';";
					$data_return['data_deleted_user'] = $db_brimo->query($query)->result();
				}

			}
			

		}
			
		return $data_return;
	}
	
	public function get_soceng_user($data)
	{		
		$db_brimo = $this->load->database('brimo_slave', TRUE);
		
		$username = '';
		$data_return = NULL;
		
		if ($data['parameter_txt'] == 'username_opt'){
			$username = $data['value_txt'];
			
		} else if ($data['parameter_txt']  == 'user_alias_opt'){
			$query = "select username from tbl_user_alias where user_alias = '".$data['value_txt']."' limit 1;"; 
			$result = $db_brimo->query($query)->result();
			foreach($result as $r){
				$username = $r->username;
			}
			
		} else if ($data['parameter_txt'] == 'account_opt'){
			$query = "select username from tbl_user_account where account = '".$data['value_txt']."' limit 1;";
			$result = $db_brimo->query($query)->result();
			foreach($result as $r){
				$username = $r->username;
			}
		}
		
		if($username != ''){
			$query = "SELECT a.username,b.user_alias, a.registered_date, a.`status`, a.login_status, a.last_login FROM tbl_user a left join tbl_user_alias b ON a.username = b.username WHERE a.username = '".$username."';";
			$data_return['user_alias'] = $db_brimo->query($query)->result();
			
			$query = "SELECT username, `account`, account_name, type_account, product_type, currency, card_number, `status`, finansial_status, `default`, sc_code FROM tbl_user_account WHERE username = '".$username."';";
			$data_return['user_account'] = $db_brimo->query($query)->result();
			
			$query = "select username, name, cellphone_number, email_address, cif from tbl_user_profile where username = '".$username."' limit 1;";
			$data_return['user_profile'] = $db_brimo->query($query)->result();
			
			$query = "SELECT username,activity,remarks,edit_by,edit_date from tbl_user_mnt_log WHERE username = '".$username."';";
			$data_return['user_mnt_log'] = $db_brimo->query($query)->result();
			
			$query = "SELECT username,activity,remarks,edit_by,edit_date from tbl_user_account_mnt_log WHERE username = '".$username."';";
			$data_return['user_account_mnt_log'] = $db_brimo->query($query)->result();
			
			$query = "SELECT username,activity,remarks,edit_by,edit_date from tbl_user_profile_mnt_log WHERE username = '".$username."';";
			$data_return['user_profile_mnt_log'] = $db_brimo->query($query)->result();
			
			try {
				$db_livik_slave = $this->load->database('livik_slave', TRUE);	
				$query = "SELECT username,status,device_id,activation_date from tbl_brimo_activation WHERE username = '".$username."';";
				$data_return['livik_brimo_activation'] = $db_livik_slave->query($query)->result();
				
				$query = "SELECT username,status,device_id,activation_date from tbl_brimo_activation_mnt_log WHERE username = '".$username."';";
				$data_return['livik_brimo_activation_mnt_log'] = $db_livik_slave->query($query)->result();
				
				
			} catch (Exception $e) {
				$data_return['livik_brimo_activation'] = 'Koneksi ke Database Livik slave melalui DNS timeout / bermasalah. Silahkan Query menggunakan: '."SELECT username,status,device_id,activation_date from tbl_brimo_activation WHERE username = '".$username."';"; 
				$data_return['livik_brimo_activation_mnt_log'] = 'Koneksi ke Database Livik slave melalui DNS timeout / bermasalah. Silahkan Query menggunakan: '."SELECT username,status,device_id,activation_date from tbl_brimo_activation_mnt_log WHERE username = '".$username."';"; 
			}
			
			$query = "SELECT username,`start`,`status` from tbl_user_safety_mode WHERE username = '".$username."';";
			$data_return['user_safety_mode'] = $db_brimo->query($query)->result();
			
			if ($data['start_date'] != '' && $data['end_date'] != '') {
				if($data['start_date'] <= $data['end_date']) {
					$log_date = NULL;
					$log_query = $this->get_query_date_ibank($data['start_date'],$data['end_date'],"tbl_trx_log");
					$log_date = $db_brimo->query($log_query)->result();
	
					$count = 0;
					$is_today = FALSE;
					foreach ($log_date as $key => $d){
						if($d->TABLE_NAME != 'tbl_trx_log') {
							$query = "SELECT a.account, a.username, a.trx_type, a.reference_num, a.trx_status, a.trx_date, a.agent, LEFT(a.trx_object,20) as trx_object FROM ".$d->TABLE_NAME." a WHERE a.username = '".$username."';";
							$data_return['log_transaksi'][$count] = $db_brimo->query($query)->result();
						} else {
							$is_today = TRUE;
						}
						$count = $count + 1;
					}
					//Agar tampil terakhir
					if ($is_today) {
						$query = "SELECT a.account, a.username, a.trx_type, a.reference_num, a.trx_status, a.trx_date, a.agent, LEFT(a.trx_object,20) as trx_object FROM tbl_trx_log a WHERE a.username = '".$username."';";
						$data_return['log_transaksi'][$count] = $db_brimo->query($query)->result();
					}
					
					
					$user_account = '';
					$count =0;
					if(isset($data_return['user_account'])){
						foreach($data_return['user_account'] as $key => $d){
							if($count == 0){
								$user_account = "'".$d->account."'";
							} else {
								$user_account = $user_account.",'".$d->account."'";
							}
							$count += 1;
						}
					}
					
					if($user_account != ''){
						$transfer_date = NULL;
						$transfer_query = $this->get_query_date_ibank($data['start_date'],$data['end_date'],"tbl_trx_transfer");
						$transfer_date = $db_brimo->query($transfer_query)->result();
						
						$count = 0;
						$is_today = FALSE;
						foreach ($transfer_date as $key => $d){
							if($d->TABLE_NAME != 'tbl_trx_transfer') {
								$query = "SELECT a.reference_num,a.transfer_type,a.`status`,a.account,a.account_destination,a.account_name_destination,a.amount,a.trx_date,a.bank_destination,a.trx_schedule_type,a.account_type FROM ".$d->TABLE_NAME." a WHERE a.account IN ( ".$user_account.");";
								$data_return['transfer_transaksi'][$count] = $db_brimo->query($query)->result();
							} else {
								$is_today = TRUE;
							}
							$count = $count + 1;
						}
						//Agar tampil terakhir
						if ($is_today) {
							$query = "SELECT a.reference_num,a.transfer_type,a.`status`,a.account,a.account_destination,a.account_name_destination,a.amount,a.trx_date,a.bank_destination,a.trx_schedule_type,a.account_type FROM tbl_trx_transfer a WHERE a.account IN ( ".$user_account.");";
							$data_return['transfer_transaksi'][$count] = $db_brimo->query($query)->result();
						}
						
						
						$payment_date = NULL;
						$payment_query = $this->get_query_date_ibank($data['start_date'],$data['end_date'],"tbl_trx_payment");
						$payment_date = $db_brimo->query($payment_query)->result();
						
						$count = 0;
						$is_today = FALSE;
						foreach ($payment_date as $key => $d){
							if($d->TABLE_NAME != 'tbl_trx_payment') {						
								$query = "SELECT a.reference_num,a.payment_type,a.`status`,a.account,a.payment_number,a.payment_name,a.amount,a.trx_date,a.trx_schedule_type,a.third_party_name,a.account_type FROM ".$d->TABLE_NAME." a WHERE a.account IN ( ".$user_account.");";
								$data_return['payment_transaksi'][$count] = $db_brimo->query($query)->result();
							} else {
								$is_today = TRUE;
							}
							$count = $count + 1;
						}
						
						//Agar tampil terakhir
						if ($is_today) {
							$query = "SELECT a.reference_num,a.payment_type,a.`status`,a.account,a.payment_number,a.payment_name,a.amount,a.trx_date,a.trx_schedule_type,a.third_party_name,a.account_type FROM tbl_trx_payment a WHERE a.account IN ( ".$user_account.");";
							$data_return['payment_transaksi'][$count] = $db_brimo->query($query)->result();
						}
						
						$purchase_date = NULL;
						$purchase_query = $this->get_query_date_ibank($data['start_date'],$data['end_date'],"tbl_trx_purchase");
						$purchase_date = $db_brimo->query($purchase_query)->result();
						
						$count = 0;
						$is_today = FALSE;
						foreach ($purchase_date as $key => $d){
							if($d->TABLE_NAME != 'tbl_trx_purchase') {
								$query = "SELECT a.reference_num,a.purchase_type,a.`status`,a.account,a.purchase_number,a.amount,a.trx_date,a.trx_schedule_type,a.third_party_name,a.account_type FROM ".$d->TABLE_NAME." a WHERE a.account IN ( ".$user_account.");";
								$data_return['purchase_transaksi'][$count] = $db_brimo->query($query)->result();
							} else {
								$is_today = TRUE;
							}
							$count = $count + 1;
						}
						//Agar tampil terakhir
						if ($is_today) {
							$query = "SELECT a.reference_num,a.purchase_type,a.`status`,a.account,a.purchase_number,a.amount,a.trx_date,a.trx_schedule_type,a.third_party_name,a.account_type FROM tbl_trx_purchase a WHERE a.account IN ( ".$user_account.");";
							$data_return['purchase_transaksi'][$count] = $db_brimo->query($query)->result();
						}
						
					}
				} else {
					echo '<h5 style="color:red;background-color:lithgrey;" align="center">Start Date tidak boleh lebih besar dari End Date. Gagal mengambil data (tbl_trx_log, tbl_trx_transfer,tbl_trx_payment,tbl_trx_purchase)</h5>';
				}
			} else {
				echo '<h5 style="color:yellow;background-color:grey;" align="center">Start Date / End Date kosong. Warning !! Gagal mengambil data (tbl_trx_log, tbl_trx_transfer,tbl_trx_payment,tbl_trx_purchase)</h5>';
			}
		}
			
		return $data_return;
	}
	
	public function get_safety_mode($data)
	{		
		$db_brimo = $this->load->database('brimo_slave', TRUE);
		
		$username = '';
		$data_return = NULL;
		
		if ($data['parameter_txt'] == 'username_opt'){
			$username = $data['value_txt'];
			
		} else if ($data['parameter_txt']  == 'user_alias_opt'){
			$query = "select username from tbl_user_alias where user_alias = '".$data['value_txt']."' limit 1;"; 
			$result = $db_brimo->query($query)->result();
			foreach($result as $r){
				$username = $r->username;
			}
			
		} else if ($data['parameter_txt'] == 'account_opt'){
			$query = "select username from tbl_user_account where account = '".$data['value_txt']."' limit 1;";
			$result = $db_brimo->query($query)->result();
			foreach($result as $r){
				$username = $r->username;
			}
		}
		$data_return['this_username'] = '';
		if($username != ''){
			$query = "select username, name, cellphone_number, email_address, cif from tbl_user_profile where username = '".$username."' limit 1;";
			$data_return['user_profile'] = $db_brimo->query($query)->result();
			
			$query = "SELECT username,`start`,`status` from tbl_user_safety_mode WHERE username = '".$username."';";
			$data_return['user_safety_mode'] = $db_brimo->query($query)->result();
			
			$data_return['this_username'] = $username;
			
					
		}
		
		
		
		return $data_return;
	}
	public function get_safety_mode_livik($data)
	{	
		$username = $data['username'];
		$data_return = NULL;	
		if (!empty($username))
		{
			try {
				$db_livik_slave = $this->load->database('livik_slave', TRUE);
				$query = "SELECT username,status,device_id,activation_date from tbl_brimo_activation WHERE username = '".$username."';";
				$data_return['livik_brimo_activation'] = $db_livik_slave->query($query)->result();
				
				$query = "SELECT username,status,device_id,activation_date,sms_link from tbl_brimo_activation_mnt_log WHERE username = '".$username."';";
				$data_return['livik_brimo_activation_mnt_log'] = $db_livik_slave->query($query)->result();
				
				
			} catch (Exception $e) {
				$data_return['livik_brimo_activation'] = 'Koneksi ke Database Livik slave melalui DNS timeout / bermasalah. Silahkan Query menggunakan: '."SELECT username,status,device_id,activation_date from tbl_brimo_activation WHERE username = '".$username."';"; 
				$data_return['livik_brimo_activation_mnt_log'] = 'Koneksi ke Database Livik slave melalui DNS timeout / bermasalah. Silahkan Query menggunakan: '."SELECT username,status,device_id,activation_date from tbl_brimo_activation_mnt_log WHERE username = '".$username."';"; 
			}	
		}
		
		return $data_return;
	}
	
	
	
	public function get_acc_by_card($data)
	{		
		$db_brimo = $this->load->database('brimo_slave', TRUE);
		$data_return = NULL;
		$card_number = $data['card_number'];
		
		if($card_number != ''){
			if(preg_match("/^[0-9]+$/", $card_number)) {
				if(strlen($card_number) == 16) {
					if ($card_number != '5221847777777777') {
						if ($card_number != '5221840000000000') {
							$db_brimo->select("a.card_number, a.account");
							$db_brimo->from("tbl_user_account a");
							$db_brimo->where("a.card_number",$card_number);
							$db_brimo->limit(5);
							$data_return['card_detail'] = $db_brimo->get()->result();
							//$query = "SELECT a.card_number, a.account FROM tbl_user_account a WHERE a.card_number = '".$card_number."' LIMIT 5;";
							//$data_return['card_detail'] = $db_brimo->query($query)->result();
							
							$data_log = array(
								'username'=>$this->session->userdata('ibo_username'),
								'application'=>'BRIMO',
								'action'=>'INQUIRY acc_by_card',
								'query_txt'=>$db_brimo->last_query(),
								'time'=>date('Y-m-d H:i:s'),
							);
							$this->audit_log($data_log);
						} else {
							echo '<h5 style="color:red;background-color:lithgrey;" align="center">Maaf, Card Number = 5221840000000000 adalah Nomor Default Kartu, Sehingga hasilnya banyak Account. Dapat dilakukan konfirmasi ke team IBO</h5>';
						}
					} else {
						echo '<h5 style="color:red;background-color:lithgrey;" align="center">Maaf, Card Number = 5221847777777777 adalah Nomor Default Kartu, Sehingga hasilnya banyak Account. Dapat dilakukan konfirmasi ke team IBO</h5>';
					}
				} else {
					echo '<h5 style="color:red;background-color:lithgrey;" align="center">Maaf, Card Number harus 16 Digit</h5>';
				}
			} else {
				echo '<h5 style="color:red;background-color:lithgrey;" align="center">Hanya menerima inputan Numerik.</h5>';
			}
		} else {
			echo '<h5 style="color:red;background-color:lithgrey;" align="center">Inputan Anda Kosong.</h5>';
		}
		return $data_return;
	}
	
	public function get_query_date_ibank($start_date, $end_date, $table_name) {
		$query = NULL;
		$today = date("Ymd");
		
		$start_date_convert = strtotime($start_date);
		$start_date_input = date("Ymd",$start_date_convert);
		
		$end_date_convert = strtotime($end_date);
		$end_date_input = date("Ymd",$end_date_convert);
		
		if ($end_date_input == $today && $start_date_input < $today){
			$start_date = $table_name."_".$start_date_input;
			$end_date_yesterday = date('Ymd', strtotime($end_date_input. ' - 1 days'));
			$end_date = $table_name."_".$end_date_yesterday;
			$tbl_today = $table_name;
			
			$query = 'SELECT `TABLE_NAME` FROM information_schema.`TABLES` WHERE table_schema = "ibank" AND `table_name` = "'.$table_name.'" OR (`table_name` >= "'.$start_date.'" AND `table_name` <= "'.$end_date.'") ORDER BY CREATE_TIME;';
		} else {
			if ($start_date_input == $today){
				$start_date = $table_name;
			}else {
				$start_date = $table_name."_".$start_date_input;
			}
			
			if ($end_date_input == $today){
				$end_date = $table_name;
			}else {
				$end_date = $table_name."_".$end_date_input;
			}
		
			$query = "SELECT `TABLE_NAME` FROM information_schema.`TABLES` WHERE table_schema = 'ibank' AND `table_name` >= '".$start_date."' AND `table_name` <= '".$end_date."';";
		}
		return $query;
	}

	public function get_data_log_transaksi($data)
	{		
		$db_brimo = $this->load->database('brimo_slave', TRUE);
		$data_return = NULL;
		
		$date = NULL;
		
		$today = date("Ymd");
		
		//$timestamp = strtotime($data['date']);
		//$date_input = date("Ymd",$timestamp);
		
		//$data['start_date'] = "2022-03-01";
		//$data['end_date'] = "2022-02-28";
		//today = "2022-03-11"
		
		$start_date_convert = strtotime($data['start_date']);
		$start_date_input = date("Ymd",$start_date_convert);
		
		$end_date_convert = strtotime($data['end_date']);
		$end_date_input = date("Ymd",$end_date_convert);
		$count = 0;
		
		/*if ($start_date_input == $today){
			$start_date = "tbl_trx_log";
		}else {
			$start_date = "tbl_trx_log_".$start_date_input;
		}
		
		if ($end_date_input == $today){
			$end_date = "tbl_trx_log";
		}else {
			$end_date = "tbl_trx_log_".$end_date_input;
		}*/
		
		
		
		if ($end_date_input == $today && $start_date_input < $today){
			$start_date = "tbl_trx_log_".$start_date_input;
			$end_date_yesterday = date('Ymd', strtotime($end_date_input. ' - 1 days'));
			$end_date = "tbl_trx_log_".$end_date_yesterday;
			$tbl_today = "tbl_trx_log";
			
			$query = 'SELECT `TABLE_NAME` FROM information_schema.`TABLES` WHERE table_schema = "ibank" AND `table_name` = "tbl_trx_log" OR (`table_name` >= "'.$start_date.'" AND `table_name` <= "'.$end_date.'") ORDER BY CREATE_TIME;';
		} else {
			if ($start_date_input == $today){
				$start_date = "tbl_trx_log";
			}else {
				$start_date = "tbl_trx_log_".$start_date_input;
			}
			
			if ($end_date_input == $today){
				$end_date = "tbl_trx_log";
			}else {
				$end_date = "tbl_trx_log_".$end_date_input;
			}
		
			$query = "SELECT `TABLE_NAME` FROM information_schema.`TABLES` WHERE table_schema = 'ibank' AND `table_name` >= '".$start_date."' AND `table_name` <= '".$end_date."';";
		}
		
		$date = $db_brimo->query($query)->result();
		
		if($data['value_txt'] != ''){
			foreach ($date as $key => $d){
				$count = $count + 1;
				if ($d == $today){
					$query = "SELECT a.account, a.username, a.trx_type, a.reference_num, a.trx_status, a.trx_date, a.agent,LEFT(a.trx_object,20) as trx_object FROM tbl_trx_log a WHERE a.username = '".$data['value_txt']."';";
					$data_return['log_transaksi'][$count] = $db_brimo->query($query)->result();
				} else {
					//$query = "SELECT a.account, a.username, a.trx_type, a.reference_num, a.trx_status, a.trx_date FROM tbl_trx_log_".$date_val." a WHERE a.agent = 'BRImo' and a.username = '".$data['value_txt']."';";
					$query = "SELECT a.account, a.username, a.trx_type, a.reference_num, a.trx_status, a.trx_date, a.agent, LEFT(a.trx_object,20) as trx_object FROM ".$d->TABLE_NAME." a WHERE a.username = '".$data['value_txt']."';";
					$data_return['log_transaksi'][$count] = $db_brimo->query($query)->result();
				}
			}
		}

		
		/* if($data['value_txt'] != ''){
			if ($date_input == $today){
				$query = "SELECT a.account, a.username, a.trx_type, a.reference_num, a.trx_status, a.trx_date FROM tbl_trx_log a WHERE a.agent = 'BRImo' and a.username = '".$data['value_txt']."';";
			} else {
				$query = "SELECT a.account, a.username, a.trx_type, a.reference_num, a.trx_status, a.trx_date FROM tbl_trx_log_".$date_input." a WHERE a.agent = 'BRImo' and a.username = '".$data['value_txt']."';";
			}
			$data_return['log_transaksi'] = $db_brimo->query($query)->result();
		}*/
		

		return $data_return;
	}
	
	public function returnDates($fromdate, $todate) {
		
	}
	
	public function get_data_table_bank(){
		$db_brimo_slave = $this->load->database('brimo_slave', TRUE);
		
		$query_get_all_data_tbl_bank = "SELECT * FROM tbl_bank a ORDER BY a.bank_swift_code DESC, is_bifast;";
		$data_return['data_tbl_bank'] = $db_brimo_slave->query($query_get_all_data_tbl_bank)->result();
		
		return $data_return;
	}
	
	
	public function close_bifast_all()
	{
		
		$db_brimo_149 = $this->load->database('db_brimo_149', TRUE);
		$db_brimo_slave = $this->load->database('brimo_slave', TRUE);
		$db_brimo_master = $this->load->database('brimo_master', TRUE);
		//$db_brimo_master = $this->load->database('db_brimo_149', TRUE);
		
		$query_status_param_bifast_open = "SELECT status FROM brimo_bripatch_param WHERE NAME = 'bifast_open';";
		$get_status_param_bifast_open = $db_brimo_149->query($query_status_param_bifast_open)->row()->status;
		
		if($get_status_param_bifast_open == 1){
			$query_get_tbl_bank = "SELECT bank_code, bank_name, bank_alias, bank_order, is_bifast, bank_swift_code FROM tbl_bank where is_bifast = 1;";
			$get_get_tbl_bank = $db_brimo_slave->query($query_get_tbl_bank)->result();
			
			//delete isi tbl_bank_backup di db sao
			$query_delete_backup = "TRUNCATE TABLE `tbl_bank_backup`;";
			$delete_backup = $db_brimo_149->query($query_delete_backup);
			
			$data_return['closed_bifast'] = array();
			$bank_code_tutup = "";
		
			foreach($get_get_tbl_bank as $key => $d){
				$bank_code = $d->bank_code;
				$bank_name = $d->bank_name;
				$bank_alias = $d->bank_alias;
				$bank_order = $d->bank_order;
				$is_bifast = $d->is_bifast;
				$bank_swift_code = $d->bank_swift_code;	
				
				// backup semua data di tbl_bank ke tbl_bank_backup
				$query_insert_backup = "INSERT INTO `tbl_bank_backup` (`bank_code`, `bank_name`, `bank_alias`, `bank_order`, `is_bifast`, `bank_swift_code`) VALUES ( '".$bank_code."','".$bank_name."','".$bank_alias."','".$bank_order."','".$is_bifast."','".$bank_swift_code."');";
				$insert_backup = $db_brimo_149->query($query_insert_backup);
				
				array_push($data_return['closed_bifast'], $bank_name);
				
				if($bank_code_tutup == ""){
					$bank_code_tutup .= $bank_code;
				} else {
					$bank_code_tutup .= "','".$bank_code;
				}
			}
			
			//ubah is_bifast di tbl_bank jadi 0 yang awalnya is_bifast nya 1 dan buat log patching di db ibo
			//kalau sudah ok ini dibuka
			
			
			$query_update_status_is_bifast_tbl_bank = "UPDATE tbl_bank SET is_bifast = 0 WHERE `bank_code` in ('".$bank_code_tutup."');";
			$update_status_is_bifast_tbl_bank = $db_brimo_master->query($query_update_status_is_bifast_tbl_bank);
			
			if ($db_brimo_master->affected_rows() > 0){

				$msg = 'Menutup BI Fast '.$bank_code_tutup.' pada tbl_bank berhasil Dilakukan.';
				$status = 1;
			} else{
				$msg = 'Menutup BI Fast '.$bank_code_tutup.' pada tbl_bank gagal Dilakukan.';
				$status = 0;
			}
			
			//create data log
			$data_log = array(
				'username'=>$this->session->userdata('ibo_username'),
				'application'=>'BRIMO',
				'action'=>'UPDATE',
				'query_txt'=>$db_brimo_master->last_query(),
				'status'=>$status,
				'patching_date'=>date('Y-m-d H:i:s'),
			);
			$this->patch_logging($data_log);
			
			
			
			$query_update_status_param_bifast_open = "UPDATE brimo_bripatch_param SET STATUS = 0, last_executed = NOW() WHERE name = 'bifast_open';";
			$update_status_param_bifast_open = $db_brimo_149->query($query_update_status_param_bifast_open);
			
			$pesan = "semua BIFAST BRIMO pada tbl_bank berhasil ditutup";
			echo "<script type='text/javascript'>alert('$pesan');</script>";
			return $this->get_data_table_bank();
			
		} else {
			echo '<h5 style="color:red;background-color:lithgrey;" align="center">Gagal!! BIFAST masih Close</h5>';
			return $this->get_data_table_bank();
		}
	
	}
	
	public function open_bifast()
	{
		$db_brimo_149 = $this->load->database('db_brimo_149', TRUE);
		$db_brimo_slave = $this->load->database('brimo_slave', TRUE);
		$db_brimo_master = $this->load->database('brimo_master', TRUE);
		//$db_brimo_master = $this->load->database('db_brimo_149', TRUE);
		
		$query_status_param_bifast_open = "SELECT status FROM brimo_bripatch_param WHERE NAME = 'bifast_open';";
		$get_status_param_bifast_open = $db_brimo_149->query($query_status_param_bifast_open)->row()->status;
		
		if($get_status_param_bifast_open == 0){
			
			$query_get_bank_code_is_bifast_backup = "SELECT bank_code, bank_name FROM tbl_bank_backup;";
			$get_bank_code_is_bifast_backup = $db_brimo_149->query($query_get_bank_code_is_bifast_backup)->result();
			
			$data_return['open_bifast'] = array();
			$bank_code_buka = "";
			
			foreach($get_bank_code_is_bifast_backup as $key => $d){
				$bank_code = $d->bank_code;
				$bank_name = $d->bank_name;
				
				
				
				if($bank_code_buka == ""){
					$bank_code_buka .= $bank_code;
				} else {
					$bank_code_buka .= "','".$bank_code;
				}
				
				array_push($data_return['open_bifast'], $bank_name);
			}
		
			
			$query_update_status_is_bifast_tbl_bank = "UPDATE tbl_bank SET is_bifast = 1 WHERE `bank_code` in ( '".$bank_code_buka."');";
			$update_status_is_bifast_tbl_bank = $db_brimo_master->query($query_update_status_is_bifast_tbl_bank);
			
			if ($db_brimo_master->affected_rows() > 0){
				$msg = 'Membuka BI Fast '.$bank_code_buka.' pada tbl_bank berhasil Dilakukan.';
				$status = 1;
			} else{
				$msg = 'Membuka BI Fast '.$bank_code_buka.' pada tbl_bank gagal Dilakukan.';
				$status = 0;
			}
			
			//create data log
			$data_log = array(
				'username'=>$this->session->userdata('ibo_username'),
				'application'=>'BRIMO',
				'action'=>'UPDATE',
				'query_txt'=>$db_brimo_master->last_query(),
				'status'=>$status,
				'patching_date'=>date('Y-m-d H:i:s'),
			);
			$this->patch_logging($data_log);
			
			$query_update_status_param_bifast_open = "UPDATE brimo_bripatch_param SET STATUS = 1, last_executed = NOW() WHERE name = 'bifast_open';";
			$update_status_param_bifast_open = $db_brimo_149->query($query_update_status_param_bifast_open);

			$pesan = "Semua BIFAST BRIMO pada tbl_bank berhasil dibuka";
			echo "<script type='text/javascript'>alert('$pesan');</script>";
			return $this->get_data_table_bank();
			
		}else {
			echo '<h5 style="color:red;background-color:lithgrey;" align="center">Gagal!! BIFAST pada tbl_bank masih Open</h5>';
			return $this->get_data_table_bank();
		}
	}
	
	
	public function buka_tutup_bifast_satuan($datapost)
	{
		$db_brimo_149 = $this->load->database('db_brimo_149', TRUE);
		$db_brimo_slave = $this->load->database('brimo_slave', TRUE);
		$db_brimo_master = $this->load->database('brimo_master', TRUE);
		
		$bank_code = $datapost['bank_code'];
		
		
		$query_cek_status = "SELECT * FROM tbl_bank WHERE bank_code = '".$bank_code."';";
		$cek_status = $db_brimo_slave->query($query_cek_status)->result();
		
		//$buka_bifast = false;
		
		foreach($cek_status as $key => $d){
				$bank_code = $d->bank_code;
				$bank_name = $d->bank_name;
				$is_bifast = $d->is_bifast;
				
				if($is_bifast == "1"){
					$query_update_status_is_bifast_tbl_bank = "UPDATE tbl_bank SET is_bifast = 0 WHERE `bank_code` = '".$bank_code."';";
					$update_status_is_bifast_tbl_bank = $db_brimo_master->query($query_update_status_is_bifast_tbl_bank);
					
					//create data log
					
					if ($db_brimo_master->affected_rows() > 0){
						$status = 1;
					} else{
						$status = 0;
					}
					
					$data_log = array(
						'username'=>$this->session->userdata('ibo_username'),
						'application'=>'BRIMO',
						'action'=>'UPDATE',
						'query_txt'=>$db_brimo_master->last_query(),
						'status'=>$status,
						'patching_date'=>date('Y-m-d H:i:s'),
					);
					$this->patch_logging($data_log);
					
					//$buka_bifast = false;
					$pesan = "BIFAST BRIMO menuju ".$bank_name." pada tbl_bank berhasil ditutup";
					echo "<script type='text/javascript'>alert('$pesan');</script>";
					return $this->get_data_table_bank();
					
				} else if($is_bifast == "0"){
					$query_update_status_is_bifast_tbl_bank = "UPDATE tbl_bank SET is_bifast = 1 WHERE `bank_code` = '".$bank_code."';";
					$update_status_is_bifast_tbl_bank = $db_brimo_master->query($query_update_status_is_bifast_tbl_bank);
					
					//create data log
					
					if ($db_brimo_master->affected_rows() > 0){
						$status = 1;
					} else{
						$status = 0;
					}
					
					$data_log = array(
						'username'=>$this->session->userdata('ibo_username'),
						'application'=>'BRIMO',
						'action'=>'UPDATE',
						'query_txt'=>$db_brimo_master->last_query(),
						'status'=>$status,
						'patching_date'=>date('Y-m-d H:i:s'),
					);
					$this->patch_logging($data_log);
					
					//$buka_bifast = true;
					$pesan = "BIFAST BRIMO menuju ".$bank_name." pada tbl_bank berhasil dibuka";
					echo "<script type='text/javascript'>alert('$pesan');</script>";
					return $this->get_data_table_bank();
					
				}
			}
	
	}
	
	
	
	// bifast brimo v2
	public function get_data_table_bank_brimo(){
		$db_brimo_slave = $this->load->database('brimo_slave', TRUE);
		//$db_brimo_slave = $this->load->database('db_brimo_149', TRUE);
		
		$query_get_all_data_tbl_bank = "SELECT * FROM tbl_bank_brimo a ORDER BY a.bank_swift_code DESC, is_bifast;";
		$data_return['data_tbl_bank_brimo'] = $db_brimo_slave->query($query_get_all_data_tbl_bank)->result();
		
		return $data_return;
	}
	
	
	public function close_bifast_all_brimo()
	{
		
		$db_brimo_149 = $this->load->database('db_brimo_149', TRUE);
		$db_brimo_slave = $this->load->database('brimo_slave', TRUE);
		//$db_brimo_slave = $this->load->database('db_brimo_149', TRUE);
		$db_brimo_master = $this->load->database('brimo_master', TRUE);
		//$db_brimo_master = $this->load->database('db_brimo_149', TRUE);
		
		$query_status_param_bifast_open = "SELECT status FROM brimo_bripatch_param WHERE NAME = 'bifast_open_v2';";
		$get_status_param_bifast_open = $db_brimo_149->query($query_status_param_bifast_open)->row()->status;

		
		if($get_status_param_bifast_open == 1){
			$query_get_tbl_bank = "SELECT bank_code, bank_name, bank_order, bank_swift_code, is_bifast, is_bifast_problem FROM tbl_bank_brimo where is_bifast = 1 and is_bifast_problem = 0;";
			$get_get_tbl_bank = $db_brimo_slave->query($query_get_tbl_bank)->result();
			
			//delete isi tbl_bank_backup di db sao
			$query_delete_backup = "TRUNCATE TABLE `tbl_bank_brimo_backup`;";
			$delete_backup = $db_brimo_149->query($query_delete_backup);
			
			$data_return['closed_bifast'] = array();
			$bank_code_tutup = "";
		
			foreach($get_get_tbl_bank as $key => $d){
				
				$bank_code = $d->bank_code;
				$bank_name = $d->bank_name;
				$bank_order = $d->bank_order;
				$bank_swift_code = $d->bank_swift_code;
				$is_bifast = $d->is_bifast;
				$is_bifast_problem = $d->is_bifast_problem;
				
				// backup semua data di tbl_bank ke tbl_bank_backup
				$query_insert_backup = "INSERT INTO `tbl_bank_brimo_backup` (`bank_code`, `bank_name`, `bank_order`, `bank_swift_code`, `is_bifast`,`is_bifast_problem`) VALUES ( '".$bank_code."','".$bank_name."','".$bank_order."','".$bank_swift_code."','".$is_bifast."', '".$is_bifast_problem."');";
				$insert_backup = $db_brimo_149->query($query_insert_backup);
				
				
				array_push($data_return['closed_bifast'], $bank_name);
				
				if($bank_code_tutup == ""){
					$bank_code_tutup .= $bank_code;
				} else {
					$bank_code_tutup .= "','".$bank_code;
				}
				//if($is_bifast == 1){
				//}
			}
			
			//ubah is_bifast di tbl_bank jadi 0 yang awalnya is_bifast nya 1 dan buat log patching di db ibo
			//kalau sudah ok ini dibuka
			
			
			$query_update_status_is_bifast_tbl_bank = "UPDATE tbl_bank_brimo SET is_bifast_problem = 1 WHERE `bank_code` in ('".$bank_code_tutup."');";
			$update_status_is_bifast_tbl_bank = $db_brimo_master->query($query_update_status_is_bifast_tbl_bank);
			
			if ($db_brimo_master->affected_rows() > 0){

				$msg = 'Menutup BI Fast '.$bank_code_tutup.' pada tbl_bank_brimo berhasil Dilakukan.';
				$status = 1;
			} else{
				$msg = 'Menutup BI Fast '.$bank_code_tutup.' pada tbl_bank_brimo gagal Dilakukan.';
				$status = 0;
			}
			
			//create data log
			$data_log = array(
				'username'=>$this->session->userdata('ibo_username'),
				'application'=>'BRIMO',
				'action'=>'UPDATE',
				'query_txt'=>$db_brimo_master->last_query(),
				'status'=>$status,
				'patching_date'=>date('Y-m-d H:i:s'),
			);
			$this->patch_logging($data_log);
			
			
			
			$query_update_status_param_bifast_open = "UPDATE brimo_bripatch_param SET STATUS = 0, last_executed = NOW() WHERE name = 'bifast_open_v2';";
			$update_status_param_bifast_open = $db_brimo_149->query($query_update_status_param_bifast_open);
			
			$pesan = "semua BIFAST BRIMO pada tbl_bank_brimo berhasil ditutup";
			echo "<script type='text/javascript'>alert('$pesan');</script>";
			return $this->get_data_table_bank_brimo();
			
		} else {
			echo '<h5 style="color:red;background-color:lithgrey;" align="center">Gagal!! pada tbl_bank_brimo BIFAST masih Close</h5>';
			return $this->get_data_table_bank_brimo();
		}
	
	}
	
	public function open_bifast_brimo()
	{
		$db_brimo_149 = $this->load->database('db_brimo_149', TRUE);
		$db_brimo_slave = $this->load->database('brimo_slave', TRUE);
		//$db_brimo_slave = $this->load->database('db_brimo_149', TRUE);
		$db_brimo_master = $this->load->database('brimo_master', TRUE);
		//$db_brimo_master = $this->load->database('db_brimo_149', TRUE);
		
		$query_status_param_bifast_open = "SELECT status FROM brimo_bripatch_param WHERE NAME = 'bifast_open_v2';";
		$get_status_param_bifast_open = $db_brimo_149->query($query_status_param_bifast_open)->row()->status;
		
		if($get_status_param_bifast_open == 0){
			
			$query_get_bank_code_is_bifast_backup = "SELECT bank_code, bank_name FROM tbl_bank_brimo_backup;";
			$get_bank_code_is_bifast_backup = $db_brimo_149->query($query_get_bank_code_is_bifast_backup)->result();
			
			$data_return['open_bifast'] = array();
			$bank_code_buka = "";
			
			foreach($get_bank_code_is_bifast_backup as $key => $d){
				$bank_code = $d->bank_code;
				$bank_name = $d->bank_name;
				
				
				
				if($bank_code_buka == ""){
					$bank_code_buka .= $bank_code;
				} else {
					$bank_code_buka .= "','".$bank_code;
				}
				
				array_push($data_return['open_bifast'], $bank_name);
			}
		
			
			$query_update_status_is_bifast_tbl_bank = "UPDATE tbl_bank_brimo SET is_bifast_problem = 0 WHERE `bank_code` in ( '".$bank_code_buka."');";
			$update_status_is_bifast_tbl_bank = $db_brimo_master->query($query_update_status_is_bifast_tbl_bank);
			
			if ($db_brimo_master->affected_rows() > 0){
				$msg = 'Membuka BI Fast '.$bank_code_buka.' pada tbl_bank_brimo berhasil Dilakukan.';
				$status = 1;
			} else{
				$msg = 'Membuka BI Fast '.$bank_code_buka.' pada tbl_bank_brimo gagal Dilakukan.';
				$status = 0;
			}
			
			//create data log
			$data_log = array(
				'username'=>$this->session->userdata('ibo_username'),
				'application'=>'BRIMO',
				'action'=>'UPDATE',
				'query_txt'=>$db_brimo_master->last_query(),
				'status'=>$status,
				'patching_date'=>date('Y-m-d H:i:s'),
			);
			$this->patch_logging($data_log);
			
			$query_update_status_param_bifast_open = "UPDATE brimo_bripatch_param SET STATUS = 1, last_executed = NOW() WHERE name = 'bifast_open_v2';";
			$update_status_param_bifast_open = $db_brimo_149->query($query_update_status_param_bifast_open);

			$pesan = "Semua BIFAST BRIMO pada tbl_bank_brimo berhasil dibuka";
			echo "<script type='text/javascript'>alert('$pesan');</script>";
			return $this->get_data_table_bank_brimo();
			
		}else {
			echo '<h5 style="color:red;background-color:lithgrey;" align="center">Gagal!! BIFAST pada tbl_bank_brimo masih Open</h5>';
			return $this->get_data_table_bank_brimo();
		}
	}
	
	
	public function buka_tutup_bifast_satuan_brimo($datapost)
	{
		$db_brimo_149 = $this->load->database('db_brimo_149', TRUE);
		$db_brimo_slave = $this->load->database('brimo_slave', TRUE);
		//$db_brimo_slave = $this->load->database('db_brimo_149', TRUE);	
		$db_brimo_master = $this->load->database('brimo_master', TRUE);
		//$db_brimo_master = $this->load->database('db_brimo_149', TRUE);
		
		$bank_code = $datapost['bank_code'];
		
		
		$query_cek_status = "SELECT * FROM tbl_bank_brimo WHERE bank_code = '".$bank_code."';";
		$cek_status = $db_brimo_slave->query($query_cek_status)->result();
		
		//$buka_bifast = false;
		
		foreach($cek_status as $key => $d){
				$bank_code = $d->bank_code;
				$bank_name = $d->bank_name;
				$is_online = $d->is_online;
				$is_bifast = $d->is_bifast;
				$is_bifast_problem = $d->is_bifast_problem;
				
				if($is_bifast_problem == "0"){
					if($is_online == "0" && $is_bifast == "1"){
						$query_update_status_is_bifast_tbl_bank = "UPDATE tbl_bank_brimo SET is_bifast_problem = 1, is_bifast = 0 WHERE `bank_code` = '".$bank_code."';";
					}else{
						$query_update_status_is_bifast_tbl_bank = "UPDATE tbl_bank_brimo SET is_bifast_problem = 1 WHERE `bank_code` = '".$bank_code."';";
					}
					
					$update_status_is_bifast_tbl_bank = $db_brimo_master->query($query_update_status_is_bifast_tbl_bank);
					
					//create data log
					
					if ($db_brimo_master->affected_rows() > 0){
						$status = 1;
					} else{
						$status = 0;
					}
					
					$data_log = array(
						'username'=>$this->session->userdata('ibo_username'),
						'application'=>'BRIMO',
						'action'=>'UPDATE',
						'query_txt'=>$db_brimo_master->last_query(),
						'status'=>$status,
						'patching_date'=>date('Y-m-d H:i:s'),
					);
					$this->patch_logging($data_log);
					
					//$buka_bifast = false;
					$pesan = "BIFAST BRIMO menuju ".$bank_name." pada tbl_bank_brimo berhasil ditutup";
					echo "<script type='text/javascript'>alert('$pesan');</script>";
					return $this->get_data_table_bank_brimo();
					
				} else if($is_bifast_problem == "1"){
					if($is_online == "0" && $is_bifast == "0"){
						$query_update_status_is_bifast_tbl_bank = "UPDATE tbl_bank_brimo SET is_bifast_problem = 0, is_bifast = 1 WHERE `bank_code` = '".$bank_code."';";
					}else{
						$query_update_status_is_bifast_tbl_bank = "UPDATE tbl_bank_brimo SET is_bifast_problem = 0 WHERE `bank_code` = '".$bank_code."';";
					}
					
					$update_status_is_bifast_tbl_bank = $db_brimo_master->query($query_update_status_is_bifast_tbl_bank);
					
					//create data log
					
					if ($db_brimo_master->affected_rows() > 0){
						$status = 1;
					} else{
						$status = 0;
					}
					
					$data_log = array(
						'username'=>$this->session->userdata('ibo_username'),
						'application'=>'BRIMO',
						'action'=>'UPDATE',
						'query_txt'=>$db_brimo_master->last_query(),
						'status'=>$status,
						'patching_date'=>date('Y-m-d H:i:s'),
					);
					$this->patch_logging($data_log);
					
					//$buka_bifast = true;
					$pesan = "BIFAST BRIMO menuju ".$bank_name." pada tbl_bank_brimo berhasil dibuka";
					echo "<script type='text/javascript'>alert('$pesan');</script>";
					return $this->get_data_table_bank_brimo();
					
				}
			}
	
	}
	
	// bifast brimo v3
	
	public function close_bifast_all_v3(){
		$close_v1 = $this->close_bifast_all();
		$close_v2 = $this->close_bifast_all_brimo();
		
		return $close_v2;
	}
	
	public function open_bifast_v3(){
		$open_v1 = $this->open_bifast();
		$open_v2 = $this->open_bifast_brimo();
		
		return $open_v2;
	}
	
	public function buka_tutup_bifast_satuan_v3($datapost){
		$satuan_v1 = $this->buka_tutup_bifast_satuan($datapost);
		$satuan_v2 = $this->buka_tutup_bifast_satuan_brimo($datapost);
		
		return $satuan_v2;
	}
	
	// ================== buka tutup trf online
	public function get_data_table_trfonline_brimo(){
		$db_brimo_slave = $this->load->database('brimo_slave', TRUE);
		
		$query_get_all_data_tbl_bank = "SELECT * FROM tbl_bank_brimo a ORDER BY a.is_online DESC;";
		$data_return['data_tbl_bank_brimo'] = $db_brimo_slave->query($query_get_all_data_tbl_bank)->result();
		
		return $data_return;
	}
	public function buka_tutup_trfonline_satuan($datapost){
		$db_brimo_149 = $this->load->database('db_brimo_149', TRUE);
		$db_brimo_slave = $this->load->database('brimo_slave', TRUE);	
		$db_brimo_master = $this->load->database('brimo_master', TRUE);
		
		$bank_code = $datapost['bank_code'];
		
		
		$query_cek_status = "SELECT * FROM ibank.tbl_bank_brimo WHERE bank_code = '".$bank_code."';";
		$cek_status = $db_brimo_slave->query($query_cek_status)->result();
		
		$pesan = "";
		foreach($cek_status as $key => $d){
			$bank_code = $d->bank_code;
			$bank_name = $d->bank_name;
			$is_online = $d->is_online;
			
			if($is_online == "0"){
				$new_online = 1;
				$pesan = "TRANSFER ONLINE BRIMO menuju ".$bank_name." pada tbl_bank_brimo berhasil dibuka";
			}else if ($is_online == "1"){
				$new_online = 0;
				$pesan = "TRANSFER ONLINE BRIMO menuju ".$bank_name." pada tbl_bank_brimo berhasil ditutup";
			}else{
				$pesan = "TRANSFER ONLINE BRIMO menuju ".$bank_name." tidak ada perubahan";
				break;
			}
				
			$query_update_status_is_online = "UPDATE ibank.tbl_bank_brimo SET is_online = ".$new_online." WHERE `bank_code` = '".$bank_code."';";
			$db_brimo_master->query($query_update_status_is_online);
					
			//create data log
					
			if ($db_brimo_master->affected_rows() > 0){
				$status = 1;
			} else{
				$status = 0;
			}
					
			$data_log = array(
				'username'=>$this->session->userdata('ibo_username'),
				'application'=>'BRIMO',
				'action'=>'UPDATE',
				'query_txt'=>$db_brimo_master->last_query(),
				'status'=>$status,
				'patching_date'=>date('Y-m-d H:i:s'),
			);
			$this->patch_logging($data_log);
			
		}
		
		echo "<script type='text/javascript'>alert('$pesan');</script>";
		return $this->get_data_table_trfonline_brimo();
	}
	// ================== buka tutup trf online
	
	// micro
	public function get_micro_list($data)
	{		
		$db_bripatch = $this->load->database('default', TRUE);
		$key = '';
		$data_return = NULL;
		
		$key = $data['key_txt'];
		
		if($key != ''){
			$query = "select * from ocp_micro_param where deployment LIKE '%".$key."%' and project = 'brimo' order by deployment asc;";
			$data_return['micro_list'] = $db_bripatch->query($query)->result();
		}
		
		$db_bripatch->close();
		return $data_return;
	}
	
	public function add_micro($datapost)
	{
		$db_bripatch = $this->load->database('default', TRUE);
		$data_return = array('msg'=>'','status'=>0);
		
		$query_select = "SELECT * FROM ocp_micro_param WHERE deployment = '".$datapost['deployment_txt']."';";
		$get_existed_row = $db_bripatch->query($query_select);
		
		if($get_existed_row->num_rows() <= 0){
			$query_insert = "INSERT INTO ocp_micro_param (`deployment`,`project`,`configmap`,`secret`,`hpa`,`description`) VALUES ('".$datapost['deployment_txt']."','brimo','".json_encode($datapost['configmap_txt'])."','".json_encode($datapost['secret_txt'])."','".$datapost['hpa_txt']."','".$datapost['description_txt']."');";
			$db_bripatch->query($query_insert);
			
			if ($db_bripatch->affected_rows() > 0){
				$data_return['msg'] = 'Deployment '.$datapost['deployment_txt'].' added successfully.';
				$data_return['status'] = 1;
			}else{
				$data_return['msg'] = 'Deployment '.$datapost['deployment_txt'].' failed to add. System error.';
				$data_return['status'] = 0;
			}
		}else{
			$data_return['msg'] = 'Deployment '.$datapost['deployment_txt'].' is already exist.';
			$data_return['status'] = 0;
		}
		
		$db_bripatch->close();
		return $data_return;
	}
	
	public function get_micro($datapost)
	{
		$db_bripatch = $this->load->database('default', TRUE);
		$data_return = array('msg'=>'','status'=>0,'record'=>NULL);
		
		$query_select = "SELECT * FROM ocp_micro_param WHERE id = ".$datapost['micro_id']." LIMIT 1;";
		$get_existed_row = $db_bripatch->query($query_select);
		
		if($get_existed_row->num_rows() >= 0){
			$data_return['msg'] = 'Deployment exists.';
			$data_return['status'] = 1;
			$data_return['record'] = $get_existed_row->row();
		}else{
			$data_return['msg'] = 'Deployment is not found.';
			$data_return['status'] = 0;
			$data_return['record'] = NULL;
		}
		
		$db_bripatch->close();
		return $data_return;
	}
	
	public function delete_micro($datapost)
	{
		$db_bripatch = $this->load->database('default', TRUE);
		$data_return = array('msg'=>'','status'=>0);
		
		$query_select = "SELECT * FROM ocp_micro_param WHERE id = ".$datapost['micro_id'].";";
		$get_existed_row = $db_bripatch->query($query_select);
		
		if($get_existed_row->num_rows() >= 0){
			$query_delete = "DELETE FROM ocp_micro_param WHERE id = ".$datapost['micro_id'].";";
			$db_bripatch->query($query_delete);
			
			if ($db_bripatch->affected_rows() > 0){
				$data_return['msg'] = 'Deployment '.$datapost['micro_name'].' deleted successfully.';
				$data_return['status'] = 1;
			}else{
				$data_return['msg'] = 'Deployment '.$datapost['micro_name'].' failed to delete. System error.';
				$data_return['status'] = 0;
			}
		}else{
			$data_return['msg'] = 'Deployment '.$datapost['micro_name'].' is already deleted.';
			$data_return['status'] = 0;
		}
		
		$db_bripatch->close();
		return $data_return;
	}
	
	public function update_safety_mode($datapost)
	{
		if (!empty($datapost['username']))
		{
			$db_brimo_master = $this->load->database('brimo_master', TRUE); //Config Database Prode
			//$db_brimo_master = $this->load->database('cms_dev', TRUE); //Config Database Dev
			
			$db_brimo_master->set('start','DATE_SUB(start, INTERVAL 2 DAY)',FALSE);
			$db_brimo_master->where('username', $datapost['username']);
			//$coba = $db_brimo_master->get_compiled_update('tbl_user_safety_mode');
			//echo $coba;
			//die;
			$db_brimo_master->update("tbl_user_safety_mode");
			
			$this->load->helper('redis_conn');
			$redis = get_redis_conn('brimo_redis');
			$text_redis = "ibank.tbl_user_safety_mode:".$datapost['username'];
			$res_redis = $redis->get($text_redis);
			if($res_redis){
				//delete redis
				$redis->delete($text_redis);
			}
			
			if ($db_brimo_master->affected_rows() > 0){
				$msg = $datapost['username'].' Berhasil di Release.';
				$status = 1;
			} else{
				$msg = $datapost['username'].' Gagal di Release.';
				$status = 0;
			}
			
			//create data log
			$data_log = array(
				'username'=>$this->session->userdata('ibo_username'),
				'application'=>'BRImo',
				'action'=>'UPDATE',
				'query_txt'=>$db_brimo_master->last_query(),
				'status'=>$status,
				'patching_date'=>date('Y-m-d H:i:s'),
			);
			$this->patch_logging($data_log);
		}
		
		return $msg;
	}
	
	public function get_data_user_cc($data)
	{		
	
		$db_cc_brimo = $this->load->database('cc_brimo_slave', TRUE);
		
	
		$cif = $data['value_txt'];
		$data_return = NULL;
		
		if($cif != ''){
			$query = "SELECT * FROM tbl_user_cc WHERE cif = '".$cif."';";
			$data_return['cc'] = $db_cc_brimo->query($query)->result();
		} else {
			$pesan = "data CIF tidak ada di tabel user cc";
			echo "<script type='text/javascript'>alert('$pesan');</script>";
		}
			
		return $data_return;
	}
	
	// patch data user account
	public function get_user_account($data)
	{		
		//$db_brimo = $this->load->database('db_brimo_149', TRUE);
		$db_brimo = $this->load->database('brimo_slave', TRUE);
		$data_return = NULL;

		$account = $data["value_txt"];
		
		if($account != ''){	
			$query = "SELECT id, username, `account`, account_name, type_account, product_type, currency, card_number, `status`, finansial_status, `default`, sc_code FROM tbl_user_account WHERE `account` = '".$account."';";
			$data_return['user_account'] = $db_brimo->query($query)->result();
			
		}
			
		return $data_return;
	}

	public function update_data_user_account($data)
	{	
		$db_brimo = $this->load->database('brimo_master', TRUE);
		//$db_brimo = $this->load->database('db_brimo_149', TRUE);
		
		//$value_FINANCIAL = $data["finstat_field"];
		$value_CARDNUM = $data["cardnum_field"];
		$value_ACC_TYPE = $data["acc_type_field"];
		$value_TYPE = $data["product_type_field"];
		$value_SC = $data["sc_field"];
		//$value_NAME = $data["acc_name_field"];
		$value_ID = $data["id_account_txt"];
		
		if($value_ID != ''){

			$query = "UPDATE tbl_user_account SET card_number = '".$value_CARDNUM."', type_account = '".$value_ACC_TYPE."', product_type = '".$value_TYPE."', sc_code = '".$value_SC."' WHERE ID = ".$value_ID.";";
			
			$db_brimo->query($query);
			
			if ($db_brimo->affected_rows() > 0){
				$msg = 'data rekening dengan ID '.$value_ID.' berhasil disesuaikan.';
				$status = 1;
			} else{
				$msg = 'data rekening dengan ID '.$value_ID.' gagal disesuaikan';
				$status = 0;
			}
			
			//create data log
			$data_log = array(
				'username'=>$this->session->userdata('ibo_username'),
				'application'=>'BRImo',
				'action'=>'UPDATE',
				'query_txt'=>$db_brimo->last_query(),
				'status'=>$status,
				'patching_date'=>date('Y-m-d H:i:s'),
			);
			$this->patch_logging($data_log);
		}
		
			
		return $msg;
	}

	// user CIF patching 
	public function get_user_cif($data)
	{
		$db_brimo = $this->load->database('brimo_slave', TRUE);
		$username = '';
		$data_return = NULL;
		
		// validate option for get_user_cif
		if ($data['parameter_txt'] == 'username_opt'){
			$username = $data['value_txt'];
			
		} else if ($data['parameter_txt']  == 'cif_opt'){
			$query = "select username from tbl_user_profile where cif = '".$data['value_txt']."' limit 1;"; 
			$result = $db_brimo->query($query)->result();
			foreach($result as $r){
				$username = $r->username;
			}
		
		// get data from user_profile and user_deposito
		if($username != ''){
			$query = "SELECT username, name, cif FROM tbl_user_profile WHERE username = '".$username."' limit 1;";
			$data_return['user_profile'] = $db_brimo->query($query)->result();
							
			$query = "SELECT username, account_name, account_deposito, cif FROM tbl_user_deposito WHERE username = '".$username."' AND status = 3;"; //status : 3 ==> akun yang aktif 
			$data_return['user_deposito'] = $db_brimo->query($query)->result();
		}
					return $data_return;	
	}

	// separate between user_profile and user_deposito 
	public function update_data_user_cif($data)
	{
		$db_brimo = $this->load->database('brimo_slave', TRUE) //for testing use brimo slave database

		$value_cif_pro = $data["user-cif_field"];
		$value_cif_dep = $data["user-cif_field_dep"]; 
		$value_username_profile = $data["username_txt"];
		$value_username_deposito = $data["username_dep_txt"]
		
		// update cif on user_profile table
		if($value_username_profile != ''  ){

			$query = "UPDATE tbl_user_profile SET cif = '".$value_cif_pro."' WHERE username = ".$value_username_profile.";";
			$db_brimo->query($query);
				
			if ($db_brimo->affected_rows() > 0){
				$msg = 'data rekening dengan username '.$value_username_profile.' berhasil disesuaikan.';
				$status = 1;
			} else{
				$msg = 'data rekening dengan username '.$value_username_profile.' gagal disesuaikan';
				$status = 0;
			}
			
			//create data log
			$data_log = array(
				'username'=>$this->session->userdata('ibo_username'),
				'application'=>'BRImo',
				'action'=>'UPDATE',
				'query_txt'=>$db_brimo->last_query(),
				'status'=>$status,
				'patching_date'=>date('Y-m-d H:i:s'),
			);
			$this->patch_logging($data_log);
	
		}
		
		// update cif on user_deposito table
		if ($value_username_deposito != '' ){

			// Add account_deposito to query where (AND) to patch cif for single account
			$query = "UPDATE tbl_user_deposito SET cif = '".$value_cif_dep."' WHERE username = ".$value_username_deposito.";";		
			$db_brimo->query($query);

			if ($db_brimo->affected_rows() > 0){
				$msg = 'data rekening dengan username '.$value_username_deposito.' berhasil disesuaikan.';
				$status = 1;
			} else{
				$msg = 'data rekening dengan username '.$value_username_deposito.' gagal disesuaikan';
				$status = 0;
			}
			
			//create data log
			$data_log = array(
				'username'=>$this->session->userdata('ibo_username'),
				'application'=>'BRImo',
				'action'=>'UPDATE',
				'query_txt'=>$db_brimo->last_query(),
				'status'=>$status,
				'patching_date'=>date('Y-m-d H:i:s'),
			);
			$this->patch_logging($data_log);

		}
			
		return $msg;
	}
	
	public function get_mnv_parameter() {		
		$db_brimo_slave = $this->load->database('db_brimo_149', TRUE);
		//$db_brimo_slave = $this->load->database('brimo_slave', TRUE);
		
		$query_get_get_mnv_parameter = "SELECT id,JSON_UNQUOTE(JSON_EXTRACT(value, '$.feature_flag')) AS feature_flag,JSON_UNQUOTE(JSON_EXTRACT(value, '$.prefix.\"0811|0812|0813|0821|0822|0823|0851|0852|0853\".status')) AS telkomsel_status,JSON_UNQUOTE(JSON_EXTRACT(value, '$.prefix.\"0831|0832|0833|0838\".status')) AS axis_status,JSON_UNQUOTE(JSON_EXTRACT(value, '$.prefix.\"0817|0818|0819|0859|0877|0878|0879\".status')) AS xl_status,JSON_UNQUOTE(JSON_EXTRACT(value, '$.prefix.\"0895|0896|0897|0898|0899\".status')) AS three_status,JSON_UNQUOTE(JSON_EXTRACT(value, '$.prefix.\"0814|0815|0816|0855|0856|0857|0858\".status')) AS indosat_status,JSON_UNQUOTE(JSON_EXTRACT(value, '$.prefix.\"0881|0882|0883|0884|0885|0886|0887|0888|0889\".status')) AS smartfren_status,JSON_UNQUOTE(JSON_EXTRACT(value, '$.prefix.\"0889|0999\".status')) AS bolt_status FROM tbl_parameters WHERE id = 'BRIMO_MNV';";
		$data_return['data_parameter_mnv'] = $db_brimo_slave->query($query_get_get_mnv_parameter)->result();
		
		return $data_return;
	}
	
	public function open_close_mnv($datapost){
		$db_brimo_149 = $this->load->database('db_brimo_149', TRUE);
		$db_brimo_slave = $this->load->database('brimo_slave', TRUE);	
		$db_brimo_master = $this->load->database('brimo_master', TRUE);
		
		$bank_code = $datapost['bank_code'];
		
		#UPDATE `tbl_parameters` SET `value` = '{\"min_version\":\"2.52.0\",\"feature_flag\":false,\"prefix\":{\"0811|0812|0813|0821|0822|0823|0851|0852|0853\":{\"provider\":\"Telkomsel\",\"mcc\":\"510\",\"mnc\":\"10\",\"status\":true},\"0831|0832|0833|0838\":{\"provider\":\"AXIS\",\"mcc\":\"510\",\"mnc\":\"11\",\"status\":false},\"0817|0818|0819|0859|0877|0878|0879\":{\"provider\":\"XL\",\"mcc\":\"510\",\"mnc\":\"11\",\"status\":false},\"0895|0896|0897|0898|0899\":{\"provider\":\"Three\",\"mcc\":\"510\",\"mnc\":\"89\",\"status\":false},\"0814|0815|0816|0855|0856|0857|0858\":{\"provider\":\"Indosat\",\"mcc\":\"510\",\"mnc\":\"01\",\"status\":true},\"0881|0882|0883|0884|0885|0886|0887|0888|0889\":{\"provider\":\"Smartfren\",\"mcc\":\"510\",\"mnc\":\"09\",\"status\":false},\"0889|0999\":{\"provider\":\"Bolt\",\"mcc\":\"510\",\"mnc\":\"88\",\"status\":false}}}' WHERE `id` = 'BRIMO_MNV';
		
		$query_get_get_mnv_parameter = "SELECT id, JSON_UNQUOTE(JSON_EXTRACT(value, '$.feature_flag')) AS feature_flag,JSON_UNQUOTE(JSON_EXTRACT(value, '$.prefix.\"0811|0812|0813|0821|0822|0823|0851|0852|0853\".status')) AS telkomsel_status,JSON_UNQUOTE(JSON_EXTRACT(value, '$.prefix.\"0831|0832|0833|0838\".status')) AS axis_status,JSON_UNQUOTE(JSON_EXTRACT(value, '$.prefix.\"0817|0818|0819|0859|0877|0878|0879\".status')) AS xl_status,JSON_UNQUOTE(JSON_EXTRACT(value, '$.prefix.\"0895|0896|0897|0898|0899\".status')) AS three_status,JSON_UNQUOTE(JSON_EXTRACT(value, '$.prefix.\"0814|0815|0816|0855|0856|0857|0858\".status')) AS indosat_status,JSON_UNQUOTE(JSON_EXTRACT(value, '$.prefix.\"0881|0882|0883|0884|0885|0886|0887|0888|0889\".status')) AS smartfren_status,JSON_UNQUOTE(JSON_EXTRACT(value, '$.prefix.\"0889|0999\".status')) AS bolt_status FROM tbl_parameters WHERE id = 'BRIMO_MNV';";
		$data_return['data_parameter_mnv'] = $db_brimo_149->query($query_get_get_mnv_parameter)->result();
		
		$pesan = "";
		$feature_flag = $d->feature_flag;
		
		if($feature_flag == "true"){
			$new_flag = "false";
			$pesan = "MNV sudah dimatikan";
		}else if ($feature_flag == "false"){
			$new_flag = "true";
			$pesan = "MNV sudah dinyalakan";
		}else{
			$pesan = "status MNV tidak berubah";
		}
			
		$query_update_status_mnv = "UPDATE `tbl_parameters` SET `value` = '{\"min_version\":\"2.52.0\",\"feature_flag\":".$new_flag.",\"prefix\":{\"0811|0812|0813|0821|0822|0823|0851|0852|0853\":{\"provider\":\"Telkomsel\",\"mcc\":\"510\",\"mnc\":\"10\",\"status\":true},\"0831|0832|0833|0838\":{\"provider\":\"AXIS\",\"mcc\":\"510\",\"mnc\":\"11\",\"status\":false},\"0817|0818|0819|0859|0877|0878|0879\":{\"provider\":\"XL\",\"mcc\":\"510\",\"mnc\":\"11\",\"status\":false},\"0895|0896|0897|0898|0899\":{\"provider\":\"Three\",\"mcc\":\"510\",\"mnc\":\"89\",\"status\":false},\"0814|0815|0816|0855|0856|0857|0858\":{\"provider\":\"Indosat\",\"mcc\":\"510\",\"mnc\":\"01\",\"status\":true},\"0881|0882|0883|0884|0885|0886|0887|0888|0889\":{\"provider\":\"Smartfren\",\"mcc\":\"510\",\"mnc\":\"09\",\"status\":false},\"0889|0999\":{\"provider\":\"Bolt\",\"mcc\":\"510\",\"mnc\":\"88\",\"status\":false}}}' WHERE `id` = 'BRIMO_MNV';";
		$db_brimo_149->query($query_update_status_mnv);
				
		//create data log
				
		if ($db_brimo_149->affected_rows() > 0){
			$status = 1;
		} else{
			$status = 0;
		}
				
		$data_log = array(
			'username'=>$this->session->userdata('ibo_username'),
			'application'=>'BRIMO',
			'action'=>'UPDATE',
			'query_txt'=>$db_brimo_149->last_query(),
			'status'=>$status,
			'patching_date'=>date('Y-m-d H:i:s'),
		);
		$this->patch_logging($data_log);
		
		echo "<script type='text/javascript'>alert('$pesan');</script>";
		return $this->get_mnv_parameter();
	}
	
	// useless, but keep it in here
	/*
	public function capture_ocp($data){
		
		$db_bripatch = $this->load->database('default', TRUE);
		
		$micro_services_name = 'archimonde-brimo'; //$data["value_txt"];
		$date_get_capture = date("YmdHi");
		$micro_name_file = $micro_services_name . '_' . $date_get_capture;
		$sh_file_name = $micro_name_file . '.sh';
		$path_file = '/var/www/html/compareOCP/';
		
		// Source file on the web server
		$source_file = $path_file . $sh_file_name;
		
		// Destination server details * harus dipindah gak boleh disini
		$bastionHost = array("dc_brimo" => "172.18.8.35", "dr" => "172.19.50.2","odc" => "172.28.68.11", "dc_new" => "172.18.50.202"); 
		$bastionUsername = 'root';
		$bastionPassword = 'P@ssw0rdocp';
		$remotePath = '/root/compare-ocp/';
		
		// Web server details * harus dipindah gak boleh disini
		$webUsername = 'administrator';
		$ipWeb = '172.18.65.149';
		$webPassword = 'Bre@kthrough2312';
		
		// sent file on the bastion server
		$sent_file = $remotePath . $sh_file_name;
		
		$query_get_data_micro = "SELECT * FROM bripatch.ocp_micro_param WHERE deployment = '".$micro_services_name."';";
		$get_data_micro = $db_bripatch->query($query_get_data_micro)->result();
		
		$content = "";
		
		$newDir = $remotePath . $micro_name_file;
		
		foreach($get_data_micro as $key => $d){
			$project = $d->project;
			$configmap = $d->configmap;
			$secret = $d->secret;
			$deployment = $d->deployment;
			$hpa = $d->hpa;
			
			
			$arr_configmap = json_decode($configmap);
			$arr_secret = json_decode($secret);
			
			$content .= "mkdir '".$newDir."'\n";
			$content .= "oc get deployment ".$deployment." -n ".$project." -o yaml > ". $remotePath.$micro_name_file."/".$micro_name_file."_deployment.txt\n";
			foreach($arr_configmap as $c){
				$content .= "oc extract configmap/".$c." -n ".$project." --to=- > ". $remotePath.$micro_name_file."/".$micro_name_file."_configmap_".$c.".txt\n";
			}
			foreach($arr_secret as $s){
				$content .= "oc get secret/".$s." -n ".$project." -o yaml > ". $remotePath.$micro_name_file."/".$micro_name_file."_secret.txt\n";
			}
		}
		$content .= "oc get horizontalpodautoscalers ".$hpa." -n ".$project." -o yaml > ".$remotePath.$micro_name_file."/".$micro_name_file."_hpa.txt\n";
		
		file_put_contents($source_file, $content);

		
		foreach($bastionHost as $data_center => $ip_data_center){
			
			// Transfer file to the bastion server
			$scpCommand = "scp -o StrictHostKeyChecking=no {$source_file} {$bastionUsername}@{$ip_data_center}:{$remotePath}";
			
			$transferOutput = shell_exec("sshpass -p '{$bastionPassword}' {$scpCommand} 2>&1");
			
			if ($transferOutput === null) {
				echo "Failed to transfer file.";
				
				var_dump("gagal transfer");
				die();
			} else {
				echo "File transferred successfully.";
				
				// Shell script file on the bastion server
				$remoteScript = $remotePath . $sh_file_name;
			
				// Command to execute the shell script in the background
				$backgroundCommand = "sshpass -p '{$bastionPassword}' ssh -o StrictHostKeyChecking=no {$bastionUsername}@{$ip_data_center} 'sh {$remoteScript} > /dev/null 2>&1 &'";
			
				// Execute the background command
				shell_exec($backgroundCommand);
			
				// Wait for the shell script to finish executing
				$waitCommand = "sshpass -p '{$bastionPassword}' ssh {$bastionUsername}@{$ip_data_center} 'wait'";
				shell_exec($waitCommand);
			}
			
			$receivedPath = $path_file.$data_center."/";
		
			$scpWebCommand = "sshpass -p '{$webPassword}' scp -o StrictHostKeyChecking=no -r {$newDir} {$webUsername}@{$ipWeb}:{$receivedPath}";
			
			$transferGeneratedFiles = "sshpass -p '{$bastionPassword}' ssh -o StrictHostKeyChecking=no {$bastionUsername}@{$ip_data_center} {$scpWebCommand} > /dev/null 2>&1 &";
			
			shell_exec($transferGeneratedFiles);
			
			
		}
		
		echo "Done";
	
	}
	*/
	
}
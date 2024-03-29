<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bricams_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function patch_logging($data_ins){
		$this->db->insert('patch_log',$data_ins);
	}
	
	public function get_param_job_hk($id=NULL)
	{		
		$data_return = NULL;
		
		if($id != NULL){
			$this->db->where('id', $id);
		}
		
		$this->db->select('*');
		$data_return = $this->db->get('bricams.bricams_job_HK_param');
		return $data_return->result();
	}
	
	public function get_param_job_gather($id=NULL)
	{		
		$data_return = NULL;
		
		if($id != NULL){
			$this->db->where('id', $id);
		}
		
		$this->db->select('*');
		$data_return = $this->db->get('bricams.bricams_job_gather_param');
		return $data_return->result();
	}
	
	public function update_job_hk_gather($datapost)
	{
		$data_return = array('msg'=>'','status'=>0);
		
		// makse sure all job has stopped
		$query_select = "SELECT job_status FROM bricams.bricams_job_HK_param WHERE job_status <> 'STOP' UNION SELECT job_status FROM bricams.bricams_job_gather_param WHERE job_status <> 'STOP';";
		
		$res = $this->db->query($query_select);
		
		if($res->num_rows() == 0){
		
			$query_update = "update bricams.".$datapost['table_job']." set enable_status = 1, job_status = 'RUNNING', last_run = NOW() where id = ".$datapost['id_job'].";";
			$this->db->query($query_update);
			
			if ($this->db->affected_rows() > 0){
				$data_return['msg'] = 'Run job '.$datapost['table_job'].' (id '.$datapost['id_job'].') berhasil.';
				$data_return['status'] = 1;
			} else{
				$data_return['msg'] = 'Run job '.$datapost['table_job'].' (id '.$datapost['id_job'].') gagal.';
				$data_return['status'] = 0;
			}
			
			//create data log
			$data_log = array(
				'username'=>$this->session->userdata('ibo_username'),
				'application'=>'BRICAMS',
				'action'=>'UPDATE',
				'query_txt'=>$this->db->last_query(),
				'status'=>$data_return['status'],
				'patching_date'=>date('Y-m-d H:i:s'),
			);
			$this->patch_logging($data_log);
		
		}else{
			$data_return['msg'] = 'Run job '.$datapost['table_job'].' (id '.$datapost['id_job'].') gagal. Ada status job yang masih RUNNING.';
			$data_return['status'] = 0;
		}
		
		return $data_return;
	}
	
	public function get_data_no_remitance ($data){ 

		$db_skn_slave_rtgs = $this->load->database('db_skn_slave_rtgs', TRUE);
		$db_skn_slave_kliring = $this->load->database('db_skn_slave_kliring', TRUE);
		
		$data_return = NULL;
		
		$data_input = $data['value_txt'];
		$data_pecah = explode(",",$data_input);
		
		//$no_remitance = "";
		//$no_remitance = $data['value_txt'];
		
		
		foreach($data_pecah as $x => $val){
			//$data_tanpa_spasi = str_replace(" ","",$val);
			$no_remitance = str_replace(" ","",$val);
			
		//}
		
			if ($data['parameter_txt'] == 'kliring_opt'){
				$query = "Select a.sor, a.no_remitance, a.jurnal_seq, a.peserta_penerima_akhir, a.jumlah_dikirim, a.status_trx, a.status_desc,a.no_rekening_tujuan, a.berita from transactions a where no_remitance = '".$no_remitance."';";

				$data_return['no_sor'] = $db_skn_slave_kliring->query($query)->result();
				//$data_return[] = $db_skn_slave_kliring->query($query)->result();
	
				if ($data_return['no_sor'] == NULL){
					$query = "Select a.sor, a.no_remitance, a.jurnal_seq, a.peserta_penerima_akhir, a.jumlah_dikirim, a.status_trx, a.status_desc,a.no_rekening_tujuan, a.berita from transactions_bak a where no_remitance = '".$no_remitance."';";
					$data_return['no_sor'] = $db_skn_slave_kliring->query($query)->result();
					//$data_return[] = $db_skn_slave_kliring->query($query)->result();
				} 
			} else if ($data['parameter_txt'] == 'rtgs_opt'){
				$query = "Select a.sor, a.no_remitance, a.jurnal_seq, a.peserta_penerima_akhir, a.jumlah_dikirim, a.status_trx, a.status_desc,a.no_rekening_tujuan, a.berita from transactions a where no_remitance = '".$no_remitance."';";
				$data_return['no_sor'] = $db_skn_slave_rtgs->query($query)->result();
				if ($data_return['no_sor'] == NULL){
					$query = "Select a.sor, a.no_remitance, a.jurnal_seq, a.peserta_penerima_akhir, a.jumlah_dikirim, a.status_trx, a.status_desc,a.no_rekening_tujuan, a.berita from transactions a where no_remitance = '".$no_remitance."';";
					$data_return['no_sor'] = $db_skn_slave_rtgs->query($query)->result();
				}
			}
			
			
			//echo($data_return);
			//$data_return = array_merge($data_return, $data_return);
			//$data_arr = array_merge($data_arr, $data_return);
			
			//echo $no_remitance."\n"."\n";
		}
		
		//var_dump($data_return);
		//exit;
		
		//return $data;
		return $data_return;
	}
	
	public function get_data_md_bankkliring_addons (){
		
		$db_addons_system = $this->load->database('addons_system', TRUE);
		
		$query_get_data_md_bankkliring = 'SELECT * from public.md_bankkliring WHERE "ISBIFAST" = true ORDER BY "BANKCODE" asc;';
		$data_return['data_md_bankkliring'] = $db_addons_system->query($query_get_data_md_bankkliring)->result();
		
		return $data_return;
	
	}
	
	public function close_bifast_all_addons()
	{
		
		$db_addons_149 = $this->load->database('db_addons_149', TRUE);
		$db_addons_system = $this->load->database('addons_system', TRUE);
		
		
		$query_status_param_bifast_open = "SELECT status FROM addons_bripatch_param WHERE NAME = 'bifast_open';";
		$get_status_param_bifast_open = $db_addons_149->query($query_status_param_bifast_open)->row()->status;	
		
		
		if($get_status_param_bifast_open == 1){
			$query_get_md_bankkliring = 'SELECT * from public.md_bankkliring where "ISBIFASTSUSPEND" is false and "ISBIFAST" is true;';			
			$get_md_bankkliring = $db_addons_system->query($query_get_md_bankkliring)->result();
			
			$query_delete_backup = "TRUNCATE TABLE `md_bankkliring_backup`;";
			$delete_backup = $db_addons_149->query($query_delete_backup);
			
			$data_return['closed_bifast'] = array();
			$bank_code_tutup = "";
		
			foreach($get_md_bankkliring as $key => $d){
				$CODE = $d->CODE;
				$NAMA = $d->NAMA;
				$ADDRESS1 = $d->ADDRESS1;
				$BANKCODE = $d->BANKCODE;
				$ISBIFAST = $d->ISBIFAST;
				$ISONLINETRF = $d->ISONLINETRF;
				$ISBIFASTSUSPEND = $d->ISBIFASTSUSPEND;
				
				$query_insert_backup = "INSERT INTO `md_bankkliring_backup` (`CODE`, `NAMA`, `ADDRESS1`, `BANKCODE`, `ISBIFAST`, `ISONLINETRF`, `ISBIFASTSUSPEND`) VALUES ( '".$CODE."','".$NAMA."','".$ADDRESS1."','".$BANKCODE."','".$ISBIFAST."','".$ISONLINETRF."','".$ISBIFASTSUSPEND."');";	
				$insert_backup = $db_addons_149->query($query_insert_backup);
				
				
				array_push($data_return['closed_bifast'], $BANKCODE);
				
				if($bank_code_tutup == ""){
					$bank_code_tutup .= $BANKCODE;
				} else {
					$bank_code_tutup .= "','".$BANKCODE;
				}
			}
			
			$query_update_status_is_bifast_md_bankkliring = 'UPDATE md_bankkliring SET "ISBIFASTSUSPEND" = TRUE WHERE "BANKCODE" IN (\'' . $bank_code_tutup . '\');';
			$update_status_is_bifast_md_bankkliring = $db_addons_system->query($query_update_status_is_bifast_md_bankkliring);
			
			if ($db_addons_system->affected_rows() > 0){

				$msg = 'Menutup BI Fast '.$bank_code_tutup.' pada md_bankkliring berhasil Dilakukan.';
				$status = 1;
			} else{
				$msg = 'Menutup BI Fast '.$bank_code_tutup.' pada md_bankkliring gagal Dilakukan.';
				$status = 0;
			}
			
			//create data log
			$data_log = array(
				'username'=>$this->session->userdata('ibo_username'),
				'application'=>'addons',
				'action'=>'UPDATE',
				'query_txt'=>$db_addons_system->last_query(),
				'status'=>$status,
				'patching_date'=>date('Y-m-d H:i:s'),
			);
			$this->patch_logging($data_log);
			
			$query_update_status_param_bifast_open = "UPDATE addons_bripatch_param SET STATUS = 0, last_executed = NOW() WHERE name = 'bifast_open';";
			$update_status_param_bifast_open = $db_addons_149->query($query_update_status_param_bifast_open);
			
			$pesan = "semua BIFAST Bricams Addons pada md_bankkliring berhasil ditutup";
			echo "<script type='text/javascript'>alert('$pesan');</script>";
			return $this->get_data_md_bankkliring_addons();
			
		} else {
			echo '<h5 style="color:red;background-color:lithgrey;" align="center">Gagal!! BIFAST masih Close</h5>';
			return $this->get_data_md_bankkliring_addons();
		}
	
	}
	
	
	public function open_bifast_all_addons()
	{
		$db_addons_149 = $this->load->database('db_addons_149', TRUE);
		$db_addons_system = $this->load->database('addons_system', TRUE);
		
		
		$query_status_param_bifast_open = "SELECT status FROM addons_bripatch_param WHERE NAME = 'bifast_open';";
		$get_status_param_bifast_open = $db_addons_149->query($query_status_param_bifast_open)->row()->status;
		
		if($get_status_param_bifast_open == 0){
			
			$query_get_bank_code_is_bifast_backup = "SELECT BANKCODE, NAMA FROM md_bankkliring_backup;";		
			$get_bank_code_is_bifast_backup = $db_addons_149->query($query_get_bank_code_is_bifast_backup)->result();
			
			$data_return['open_bifast'] = array();
			$bank_code_buka = "";
			
			foreach($get_bank_code_is_bifast_backup as $key => $d){
				$BANKCODE = $d->BANKCODE;
				$NAMA = $d->NAMA;
				
				if($bank_code_buka == ""){
					$bank_code_buka .= $BANKCODE;
				} else {
					$bank_code_buka .= "','".$BANKCODE;
				}
				
				array_push($data_return['open_bifast'], $NAMA);
			}
		
			
			$query_update_status_is_bifast_md_bankkliring = 'UPDATE md_bankkliring SET "ISBIFASTSUSPEND" = FALSE WHERE "BANKCODE" IN (\''.$bank_code_buka.'\')';
			$update_status_is_bifast_md_bankkliring = $db_addons_system->query($query_update_status_is_bifast_md_bankkliring);
			
			if ($db_addons_system->affected_rows() > 0){
				$msg = 'Membuka BI Fast '.$bank_code_buka.' pada md_bankkliring berhasil Dilakukan.';
				$status = 1;
			} else{
				$msg = 'Membuka BI Fast '.$bank_code_buka.' pada md_bankkliring gagal Dilakukan.';
				$status = 0;
			}
			
			//create data log
			$data_log = array(
				'username'=>$this->session->userdata('ibo_username'),
				'application'=>'ADDONS',
				'action'=>'UPDATE',
				'query_txt'=>$db_addons_system->last_query(),
				'status'=>$status,
				'patching_date'=>date('Y-m-d H:i:s'),
			);
			$this->patch_logging($data_log);
			
			$query_update_status_param_bifast_open = "UPDATE addons_bripatch_param SET STATUS = 1, last_executed = NOW() WHERE name = 'bifast_open';";
			$update_status_param_bifast_open = $db_addons_149->query($query_update_status_param_bifast_open);

			$pesan = "Semua BIFAST Bricams Addons pada md_bankkliring berhasil dibuka";
			echo "<script type='text/javascript'>alert('$pesan');</script>";
			return $this->get_data_md_bankkliring_addons();
			
		}else {
			echo '<h5 style="color:red;background-color:lithgrey;" align="center">Gagal!! BIFAST pada md_bankkliring masih Open</h5>';
			return $this->get_data_md_bankkliring_addons();
		}
	}
	
	public function buka_tutup_bifast_satuan_addons($datapost)
	{
		$db_addons_149 = $this->load->database('db_addons_149', TRUE);
		$db_addons_system = $this->load->database('addons_system', TRUE);
		
		$BANK_CODE = $datapost['BANKCODE'];
		
		
		$query_cek_status = 'SELECT * FROM md_bankkliring a WHERE "BANKCODE" =\'' .$BANK_CODE. '\';';
		$cek_status = $db_addons_system->query($query_cek_status)->result();
		
		//$buka_bifast = false;
		
		foreach($cek_status as $key => $d){
				$BANKCODE = $d->BANKCODE;
				$CODE = $d->CODE;
				$NAMA = $d->NAMA;
				$ISBIFASTSUSPEND = $d->ISBIFASTSUSPEND;
				
				//var_dump($ISBIFAST);
				//die();
				
				if($ISBIFASTSUSPEND == 'f'){
					$query_update_status_is_bifast_md_bankkliring = 'UPDATE md_bankkliring SET "ISBIFASTSUSPEND" = true WHERE "BANKCODE" = \''.$BANK_CODE.'\';';
					#$query_update_status_is_bifast_md_bankkliring = 'UPDATE md_bankkliring SET "ISBIFAST" = false WHERE "BANKCODE" = \''.$BANK_CODE.'\';';
					$update_status_is_bifast_md_bankkliring = $db_addons_system->query($query_update_status_is_bifast_md_bankkliring);
					
					//create data log
					
					if ($db_addons_system->affected_rows() > 0){
						$status = 1;
					} else{
						$status = 0;
					}
					
					$data_log = array(
						'username'=>$this->session->userdata('ibo_username'),
						'application'=>'addons',
						'action'=>'UPDATE',
						'query_txt'=>$db_addons_system->last_query(),
						'status'=>$status,
						'patching_date'=>date('Y-m-d H:i:s'),
					);
					$this->patch_logging($data_log);
					
					//$buka_bifast = false;
					$pesan = "BIFAST Bricams Addons menuju ".$NAMA." pada md_bankkliring berhasil ditutup";
					echo "<script type='text/javascript'>alert('$pesan');</script>";
					return $this->get_data_md_bankkliring_addons();
					
				} else if($ISBIFASTSUSPEND == 't'){
					$query_update_status_is_bifast_md_bankkliring = 'UPDATE md_bankkliring SET "ISBIFASTSUSPEND" = false WHERE "BANKCODE" = \''.$BANK_CODE.'\';';
					#$query_update_status_is_bifast_md_bankkliring = 'UPDATE md_bankkliring SET "ISBIFAST" = TRUE WHERE "BANKCODE" = \''.$BANK_CODE.'\';';
					$update_status_is_bifast_md_bankkliring = $db_addons_system->query($query_update_status_is_bifast_md_bankkliring);
					
					//create data log
					
					if ($db_addons_system->affected_rows() > 0){
						$status = 1;
					} else{
						$status = 0;
					}
					
					$data_log = array(
						'username'=>$this->session->userdata('ibo_username'),
						'application'=>'addons',
						'action'=>'UPDATE',
						'query_txt'=>$db_addons_system->last_query(),
						'status'=>$status,
						'patching_date'=>date('Y-m-d H:i:s'),
					);
					$this->patch_logging($data_log);
					
					//$buka_bifast = false;
					$pesan = "BIFAST Bricams Addons menuju ".$NAMA." pada md_bankkliring berhasil dibuka";
					echo "<script type='text/javascript'>alert('$pesan');</script>";
					return $this->get_data_md_bankkliring_addons();
			}
	
		}
	}
	public function get_data_kliring_rtgs_detail($data){ 

		$db_bricams_149 = $this->load->database('db_bricams_149', TRUE);
		
		$data_return = NULL;
		
		$value = $data['value_txt'];
		
		if ($data['parameter_txt'] == 'stats_opt'){
			$query = "SELECT * FROM bricams_kliring_rtgs_dtl_today WHERE status = '".$value."';";
			$data_return['detail'] = $db_bricams_149->query($query)->result();
			
		} else if ($data['parameter_txt']  == 'prod_code_opt'){
			$query = "SELECT * FROM bricams_kliring_rtgs_dtl_today WHERE product_code = '".$value."';";
			$data_return['detail'] = $db_bricams_149->query($query)->result();
			
		} else if ($data['parameter_txt'] == 'inst_refno_opt'){
			$query = "SELECT * FROM bricams_kliring_rtgs_dtl_today WHERE instrument_referance_no = '".$value."';";
			$data_return['detail'] = $db_bricams_149->query($query)->result();
		}
		return $data_return;
	}

}

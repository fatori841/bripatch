<?php
	if($this->session->userdata('ibo_msg_notif') && $this->session->userdata('ibo_msg_alert')){
		if($this->session->userdata('ibo_msg_alert') == 'success'){
			$alert_type = 'alert-success';
		}else{
			$alert_type = 'alert-danger';
		}
		?>
		<div class="alert <?php echo $alert_type; ?> alert-dismissible fade show" role="alert">
			<i class="bi bi-exclamation-octagon me-1"></i>
			<span class="small"><?php echo $this->session->userdata('ibo_msg_notif'); ?></span>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		<?php
		
		$this->session->unset_userdata('ibo_msg_notif');
		$this->session->unset_userdata('ibo_msg_alert');
	}
?>

<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">Job HK Table</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">table_name</th>
			<th scope="col">col_name</th>
			<th scope="col">retensi_num</th>
			<th scope="col">retensi_type</th>
			<th scope="col">enable_status</th>
			<th scope="col">job_status</th>
			<th scope="col">last_run</th>
			<th scope="col"></th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($hk)){
					foreach($hk as $key => $d){
						$class_status = "";
						if($d->job_status == 'RUNNING'){
							$class_status = "warning";
						}else if($d->job_status == 'STOP'){
							$class_status = "secondary";
						}else if($d->job_status == 'ERROR'){
							$class_status = "danger";
						}
						
						if($flag_disable){
							$disabled_btn = 'disabled';
							$text_btn = '<i class="bi bi-hourglass me-1"></i>Wait...';
						}else{
							$disabled_btn = '';
							$text_btn = '<i class="bi bi-play me-1"></i>RUN';
						}
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->table_name;?></td>
							<td><?php echo $d->col_name;?></td>
							<td><?php echo $d->retensi_num;?></td>
							<td><?php echo $d->retensi_type;?></td>
							<td><?php echo ($d->enable_status == 1)?'<span class="badge bg-success">Enabled</span>':'<span class="badge bg-secondary">Disabled</span>';?></td>
							<td><span class="badge bg-<?php echo $class_status;?>"><?php echo $d->job_status;?></span></td>
							<td><?php echo $d->last_run;?></td>
							<td>
								<button type="button" class="btn btn-primary btn-sm btn_run" id="btn_run_hk_<?php echo $d->id; ?>" id_job="<?php echo $d->id; ?>" table_job="bricams_job_HK_param" <?php echo $disabled_btn; ?>>
									<?php echo $text_btn;?>
								</button>
							</td>
						</tr>
						<?php
					}
				}
			?>
		</tbody>
	  </table>
	  </div>
	  <!-- End Table with stripped rows -->

	</div>
</div>

<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">Job Gather Stats Table</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">table_name</th>
			<th scope="col">schema_name</th>
			<th scope="col">estimate_percent</th>
			<th scope="col">enable_status</th>
			<th scope="col">job_status</th>
			<th scope="col">last_run</th>
			<th scope="col"></th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($gather)){
					foreach($gather as $key => $d){
						$class_status = "";
						if($d->job_status == 'RUNNING'){
							$class_status = "warning";
						}else if($d->job_status == 'STOP'){
							$class_status = "secondary";
						}else if($d->job_status == 'ERROR'){
							$class_status = "danger";
						}
						
						if($flag_disable){
							$disabled_btn = 'disabled';
							$text_btn = '<i class="bi bi-hourglass me-1"></i>Wait...';
						}else{
							$disabled_btn = '';
							$text_btn = '<i class="bi bi-play me-1"></i>RUN';
						}
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->table_name;?></td>
							<td><?php echo $d->schema_name;?></td>
							<td><?php echo $d->estimate_percent;?></td>
							<td><?php echo ($d->enable_status == 1)?'<span class="badge bg-success">Enabled</span>':'<span class="badge bg-secondary">Disabled</span>';?></td>
							<td><span class="badge bg-<?php echo $class_status;?>"><?php echo $d->job_status;?></span></td>
							<td><?php echo $d->last_run;?></td>
							<td>
								<button type="button" class="btn btn-primary btn-sm btn_run" id="btn_run_gather_<?php echo $d->id; ?>" id_job="<?php echo $d->id; ?>" table_job="bricams_job_gather_param" <?php echo $disabled_btn; ?>>
									<?php echo $text_btn;?>
								</button>
							</td>
						</tr>
						<?php
					}
				}
			?>
		</tbody>
	  </table>
	  </div>
	  <!-- End Table with stripped rows -->

	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('.btn_run').click(function(){
		var this_elem = $(this);
		$.ajax({
			type : "POST",
			url  : "<?=site_url('Bricams/run_job_hk_gather');?>",
			data : 'id_job='+this_elem.attr('id_job')+'&table_job='+this_elem.attr('table_job'),
			beforeSend:function(){
				//$('#ajax-loader').show();
			},
			error: function(){
				//$('#ajax-loader').hide();
				alert('Error, Terjadi gagal sistem.');
			},
			success: function(data){
				//$('#ajax-loader').hide();
				$('#refresh_user_btn').click();
			}
		});
		return false;
	});
});
</script>
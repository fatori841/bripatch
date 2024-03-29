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



	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">Deployment</th>
			<th scope="col">Namespace</th>
			<th scope="col">Request Time</th>
			<th scope="col">Capture Time</th>
			<th scope="col">Requester</th>
			<th scope="col">Status</th>
			<th scope="col"></th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($micro_list)){
					foreach($micro_list as $key => $d){
						$class_status = "";
						if($d->capture_status == 0){
							$class_status = "text-success";
						}else if($d->capture_status == 1){
							$class_status = "text-warning";
						}else if($d->capture_status == 2){
							$class_status = "text-secondary";
						}else if($d->capture_status == 3){
							$class_status = "text-danger";
						}
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->deployment;?></td>
							<td><?php echo $d->namespace;?></td>
							<td><?php echo $d->capture_request_time;?></td>
							<td><?php echo $d->capture_start_time;?></td>
							<td><?php echo $d->requester;?></td>
							<td><b><span class="<?php echo $class_status;?>"><?php echo $d->capture_status_description;?></b></td>
							<td align="right">
								<?php
								if($d->capture_status == 0){
								?>
								<a class="btn btn-info btn-sm btn_download_capture" id="btn_download_capture_<?php echo $d->id; ?>" capture_id="<?php echo $d->id; ?>" href="<?php echo site_url('Brimo/download_capture_micro').'/'.$d->id;?>">
									<i class="bx bx-cloud-download me-1"></i>Download Capture
								</a>
								<?php
								}
								?>
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

	


<script type="text/javascript">
$(document).ready(function(){
	/*$('.btn_remove_micro').click(function(){
		var micro_name = $(this).attr('micro_name');
		var micro_id = $(this).attr('micro_id');
		var elem = $(this);
		if(confirm('Are you sure want to delete '+micro_name+'?')){
			$.ajax({
				type : "POST",
				url  : "<?=site_url('Brimo/delete_micro');?>",
				data : "micro_id="+micro_id+"&micro_name="+micro_name,
				beforeSend:function(){
					//$('#ajax-loader').show();
					elem.attr("disabled","disabled");
					elem.text('Loading...');
					elem.prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
				},
				error: function(){
					//$('#ajax-loader').hide();
					elem.removeAttr("disabled");
					elem.text("");
					elem.prepend('<i class="bx bxs-trash me-1"></i>');
					alert('Error, Terjadi gagal sistem.');
					$('#search_micro_btn').click();
				},
				success: function(data){
					//$('#ajax-loader').hide();
					elem.removeAttr("disabled");
					elem.text("");
					elem.prepend('<i class="bx bxs-trash me-1"></i>');
					$('#search_micro_btn').click();
				}
			});
			return false;
		}else{
			return false;
		}
	});*/
});
</script>
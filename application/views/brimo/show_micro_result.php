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
	  <h5 class="card-title">Microservices</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">Deployment</th>
			<th scope="col">Project</th>
			<th scope="col">Config Map</th>
			<th scope="col">Secret</th>
			<th scope="col">HPA</th>
			<th scope="col">Description</th>
			<th scope="col"></th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($micro_list)){
					foreach($micro_list as $key => $d){
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->deployment;?></td>
							<td><?php echo $d->project;?></td>
							<td>
								<?php 
									if($d->configmap != NULL){
										$configmap_arr = json_decode($d->configmap);
										foreach($configmap_arr as $c){
											echo $c."<br>";
										}
									}
								?>
							</td>
							<td>
								<?php 
									if($d->secret != NULL){
										$secret_arr = json_decode($d->secret);
										foreach($secret_arr as $s){
											echo $s."<br>";
										}
									}
								?>
							</td>
							<td><?php echo $d->hpa;?></td>
							<td><?php echo $d->description;?></td>
							<td align="right">
								<a class="btn btn-success btn-sm btn_get_yaml" id="btn_get_yaml_<?php echo $d->id; ?>" micro_id="<?php echo $d->id; ?>" href="<?php echo site_url('Brimo/get_yaml_micro').'/'.$d->id;?>">
									<i class="bx bx-cloud-download me-1"></i>Get YAML
								</a>
								&nbsp;
								<button type="button" class="btn btn-outline-danger btn-sm btn_remove_micro" id="btn_remove_<?php echo $d->id; ?>" micro_id="<?php echo $d->id; ?>" micro_name="<?php echo $d->deployment;?>">
									<i class="bx bxs-trash me-1"></i>
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
	$('.btn_remove_micro').click(function(){
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
	});
	
	/*$('.btn_get_yaml').click(function(){
		var micro_id = $(this).attr('micro_id');
		var elem = $(this);
		$.ajax({
			type : "POST",
			url  : "<?=site_url('Brimo/get_yaml_micro');?>",
			data : "micro_id="+micro_id,
			beforeSend:function(){
				//$('#ajax-loader').show();
				elem.attr("disabled","disabled");
				elem.text('Loading...');
				elem.prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
			},
			error: function(){
				//$('#ajax-loader').hide();
				elem.removeAttr("disabled");
				elem.text("Get YAML");
				elem.prepend('<i class="bx bx-cloud-download me-1"></i>');
				alert('Error, Terjadi gagal sistem.');
				$('#search_micro_btn').click();
			},
			success: function(data){
				//$('#ajax-loader').hide();
				elem.removeAttr("disabled");
				elem.text("Get YAML");
				elem.prepend('<i class="bx bx-cloud-download me-1"></i>');
			}
		});
		return false;
	});*/
});
</script>
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

<div class="col-lg-12">
	<div class="card mb-3">
		<div class="card-body">
			<div class="row g-3">
				<div class="col-sm-6">
					<h5 class="card-title">Capture List</h5>
				</div>
				<div class="col-sm-6" align="right">
					<br/>
					<button class="btn btn-primary" type="button" id="compare_btn">
						<span class="bx bx-git-compare" style="margin-right:5px;"></span>Compare
					</button>
				</div>
			</div>
			<div>
				<!-- Table with stripped rows -->
				  <div style="overflow-x:auto;">
				  <form id="compare_list_form" action="" method="post" novalidate>
				  <table class="table table-striped table-sm">
					<thead>
					  <tr>
						<th scope="col">#</th>
						<th scope="col">Deployment</th>
						<th scope="col">Namespace</th>
						<th scope="col">Request Time</th>
						<th scope="col">Capture Time</th>
						<th scope="col">Requester</th>
						<th scope="col">Choose (max 2)</th>
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
										<td><?php echo $d->namespace;?></td>
										<td><?php echo $d->capture_request_time;?></td>
										<td><?php echo $d->capture_start_time;?></td>
										<td><?php echo $d->requester;?></td>
										<td align="right">
											<div class="form-check">
											  <input class="form-check-input radio_compare" type="checkbox" name="radio_compare[]" id="radio_compare_<?php echo ($key);?>" value="<?php echo ($d->id);?>">
											</div>
										</td>
									</tr>
									<?php
								}
							}
						?>
					</tbody>
				  </table>
				  </form>
				  </div>
				  <!-- End Table with stripped rows -->
			</div>
		</div>
	</div>
	
</div>

<script type="text/javascript">
var compareCheckbox = new Array();
function validate_radio_micro(){
	var counter = 0;
	$('.radio_compare:checked').each(function(){
		compareCheckbox.push($(this).val());
		counter++;
	});
	if(counter == 2){
		return true;
	}else{
		return false;
	}
}
$(document).ready(function(){
	$('#compare_btn').click(function(){
		if(validate_radio_micro() == true){
			$.ajax({
				type : "POST",
				url  : "<?=site_url('Brimo/compare_micro_result');?>",
				data : $('#compare_list_form').serialize()+"&flag=compare",
				beforeSend:function(){
					//$('#ajax-loader').show();
					$('#compare_btn').attr("disabled","disabled");
					$('#compare_btn').text('Loading...');
					$('#compare_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
				},
				error: function(){
					//$('#ajax-loader').hide();
					$('#compare_btn').removeAttr("disabled");
					$('#compare_btn').text("Compare");
					$('#compare_btn').prepend('<span class="bx bx-git-compare" style="margin-right:5px;"></span>');
					alert('Error, Terjadi gagal sistem.');
				},
				success: function(data){
					//$('#ajax-loader').hide();
					$('#compare_btn').removeAttr("disabled");
					$('#compare_btn').text("Compare");
					$('#compare_btn').prepend('<span class="bx bx-git-compare" style="margin-right:5px;"></span>');
					$('#form_result').html(data);
				}
			});
			return false;
		}else{	
			alert("Choose only 2 captures on the list!");
		}
	});
});
</script>
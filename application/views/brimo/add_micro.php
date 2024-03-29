<div class="pagetitle">
  <h1 align="center">BRIMO - Add Microservice</h1>
</div>
<!-- End Page Title -->

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
	<h5 class="card-title"></h5>
	<div class="card-body">

	  <form id="add_micro" class="row g-3 needs-validation" action="" method="post" novalidate>

		<div class="row mb-3">
		  <label for="value_txt" class="col-sm-2 col-form-label">Deployment Name</label>
		  <div class="col-sm-5">
			<input type="text" class="form-control" name="deployment_txt" id="deployment_txt" required>
			<div class="invalid-feedback">Please enter the value.</div>
		  </div>
		</div>
		<div class="row mb-3">
		  <label for="value_txt" class="col-sm-2 col-form-label">Config Map <i>(ex: test-env)</i></label>
		  <div class="col-sm-5">
			<input type="text" class="form-control configmap_txt" name="configmap_txt[]" id="configmap_txt_0">
		  </div>
		  <div class="col-sm-1">
			<div class="btn-group" role="group">
				<button class="btn btn-outline-primary w-30" type="button" id="configmap_add_btn">
					<i class="bx bx-plus me-1"></i>
				</button>
				<button class="btn btn-outline-danger w-30" type="button" id="configmap_remove_btn">
					<i class="bx bx-minus me-1"></i>
				</button>
			</div>
		  </div>
		</div>
		<div class="row mb-3">
		  <label for="value_txt" class="col-sm-2 col-form-label">Secret <i>(ex: test-secret)</i></label>
		  <div class="col-sm-5">
			<input type="text" class="form-control secret_txt" name="secret_txt[]" id="secret_txt_0">
		  </div>
		  <div class="col-sm-1">
			<div class="btn-group" role="group">
				<button class="btn btn-outline-primary w-30" type="button" id="secret_add_btn">
					<i class="bx bx-plus me-1"></i>
				</button>
				<button class="btn btn-outline-danger w-30" type="button" id="secret_remove_btn">
					<i class="bx bx-minus me-1"></i>
				</button>
			</div>
		  </div>
		</div>
		<div class="row mb-3">
		  <label for="value_txt" class="col-sm-2 col-form-label">HPA <i>(ex: test-brimo)</i></label>
		  <div class="col-sm-5">
			<input type="text" class="form-control" name="hpa_txt" id="hpa_txt">
		  </div>
		</div>
		<div class="row mb-3">
		  <label for="value_txt" class="col-sm-2 col-form-label">Description</label>
		  <div class="col-sm-5">
			<input type="text" class="form-control" name="description_txt" id="description_txt">
		  </div>
		</div>

		<div class="col-sm-2"></div>
		<div class="col-sm-3">
		  <button class="btn btn-primary w-100" type="submit" id="add_micro_btn">
			<i class="bx bx-save me-1"></i>Save
		  </button>
		</div>
		<div class="col-sm-2">
		  <button class="btn btn-outline-info w-100" type="button" id="micro_list_btn">
			<i class="bx bx-list-ul me-1"></i>Go to list
		  </button>
		</div>
	  </form>

	</div>
	
</div>

<script type="text/javascript">
function validate_form_micro(){
	if($('#deployment_txt').val() == ''){
		return false;
	}
	return true;
}
$(document).ready(function(){
	$('#add_micro').submit(function(){
		if(validate_form_micro() == true){
			$.ajax({
				type : "POST",
				url  : "<?=site_url('Brimo/save_add_micro');?>",
				data : $(this).serialize(),
				beforeSend:function(){
					//$('#ajax-loader').show();
					$('#add_micro_btn').attr("disabled","disabled");
					$('#add_micro_btn').text('Loading...');
					$('#add_micro_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
				},
				error: function(){
					//$('#ajax-loader').hide();
					$('#add_micro_btn').removeAttr("disabled");
					$('#add_micro_btn').text('Save');
					$('#add_micro_btn').prepend('<i class="bx bx-save me-1"></i>');
					alert('Error, Terjadi gagal sistem.');
				},
				success: function(data){
					//$('#ajax-loader').hide();
					$('#add_micro_btn').removeAttr("disabled");
					$('#add_micro_btn').text('Save');
					$('#add_micro_btn').prepend('<i class="bx bx-save me-1"></i>');
					window.location.href = "<?=site_url('Brimo/add_micro');?>";
				}
			});
			return false;
		}
	});
	
	$('#micro_list_btn').click(function(){
		window.location.href = "<?=site_url('Brimo/show_micro');?>";
	});
	
	$('#configmap_add_btn').click(function(){
		var configmap_len = $(".configmap_txt").length
		if(configmap_len < 5){
			var latest_configmap_idx = configmap_len - 1;
			var new_configmap_idx = configmap_len;
			var elem = '<input type="text" class="form-control configmap_txt" name="configmap_txt[]" id="configmap_txt_'+new_configmap_idx+'">';
			$('#configmap_txt_'+latest_configmap_idx).after(elem);
		}
	});
	$('#configmap_remove_btn').click(function(){
		var configmap_len = $(".configmap_txt").length
		if(configmap_len > 1){
			var latest_configmap_idx = configmap_len - 1;
			$('#configmap_txt_'+latest_configmap_idx).remove();
		}
	});
	
	$('#secret_add_btn').click(function(){
		var configmap_len = $(".secret_txt").length
		if(configmap_len < 5){
			var latest_configmap_idx = configmap_len - 1;
			var new_configmap_idx = configmap_len;
			var elem = '<input type="text" class="form-control secret_txt" name="secret_txt[]" id="secret_txt_'+new_configmap_idx+'">';
			$('#secret_txt_'+latest_configmap_idx).after(elem);
		}
	});
	$('#secret_remove_btn').click(function(){
		var configmap_len = $(".secret_txt").length
		if(configmap_len > 1){
			var latest_configmap_idx = configmap_len - 1;
			$('#secret_txt_'+latest_configmap_idx).remove();
		}
	});
});
</script>
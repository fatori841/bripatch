<div class="pagetitle">
  <h1 align="center">iBBIZ - Capture Microservices</h1>
</div>
<!-- End Page Title -->

<div class="card mb-3">
	<h5 class="card-title"></h5>
	<div class="card-body">

	  <form id="capture_form" class="row g-3 needs-validation" action="" method="post" novalidate>

		<div class="row mb-3">
		  <label for="namespace_txt" class="col-sm-2 col-form-label">Namespace</label>
		  <div class="col-sm-10">
			<input type="text" class="form-control" name="namespace_txt" id="namespace_txt" required readonly value="ibbiz">
			<div class="invalid-feedback">Please enter the value.</div>
		  </div>
		</div>
		<div class="row mb-3">
		  <label for="deployment_txt" class="col-sm-2 col-form-label">Deployment</label>
		  <div class="col-sm-10">
			<input type="text" class="form-control" name="deployment_txt" id="deployment_txt" required>
			<div class="invalid-feedback">Please enter the value.</div>
		  </div>
		</div>

		<div class="col-12">
		  <button class="btn btn-primary w-100" type="submit" id="submit_capture_btn">
			Submit Request Capture
		  </button>
		</div>
	  </form>

	</div>
	
</div>

<div class="col-lg-12">
	<div class="card mb-3">
		<div class="card-body">
			<div class="row g-3">
				<div class="col-sm-6">
					<h5 class="card-title">My Request List</h5>
				</div>
				<div class="col-sm-6" align="right">
					<br/>
					<button class="btn btn-primary" type="button" id="refresh_request_btn">
						<span class="bx bx-refresh" style="margin-right:5px;"></span>Refresh
					</button>
				</div>
			</div>
			<div id="form_result"><?php echo isset($form_result)?$form_result:''; ?></div>
		</div>
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
	$('#capture_form').submit(function(){
		if(validate_form_micro() == true){
			$.ajax({
				type : "POST",
				url  : "<?=site_url('Ibbiz/capture_micro_result');?>",
				data : $(this).serialize(),
				beforeSend:function(){
					//$('#ajax-loader').show();
					$('#submit_capture_btn').attr("disabled","disabled");
					$('#submit_capture_btn').text('Loading...');
					$('#submit_capture_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
				},
				error: function(){
					//$('#ajax-loader').hide();
					$('#submit_capture_btn').removeAttr("disabled");
					$('#submit_capture_btn').text("Submit Request Capture");
					alert('Error, Terjadi gagal sistem.');
				},
				success: function(data){
					//$('#ajax-loader').hide();
					$('#submit_capture_btn').removeAttr("disabled");
					$('#submit_capture_btn').text("Submit Request Capture");
					$('#form_result').html(data);
				}
			});
			return false;
		}
	});
	
	$('#refresh_request_btn').click(function(){
		$.ajax({
			type : "POST",
			url  : "<?=site_url('Ibbiz/capture_micro_result');?>",
			data : "flag=refresh",
			beforeSend:function(){
				//$('#ajax-loader').show();
				$('#refresh_request_btn').attr("disabled","disabled");
				$('#refresh_request_btn').text('Loading...');
				$('#refresh_request_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
			},
			error: function(){
				//$('#ajax-loader').hide();
				$('#refresh_request_btn').removeAttr("disabled");
				$('#refresh_request_btn').text("Refresh");
				$('#refresh_request_btn').prepend('<span class="bx bx-refresh" style="margin-right:5px;"></span>');
				alert('Error, Terjadi gagal sistem.');
			},
			success: function(data){
				//$('#ajax-loader').hide();
				$('#refresh_request_btn').removeAttr("disabled");
				$('#refresh_request_btn').text("Refresh");
				$('#refresh_request_btn').prepend('<span class="bx bx-refresh" style="margin-right:5px;"></span>');
				$('#form_result').html(data);
			}
		});
		return false;
	});
	
	$('#refresh_request_btn').click();
});
</script>
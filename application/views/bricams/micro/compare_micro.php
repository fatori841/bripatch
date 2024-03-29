<div class="pagetitle">
  <h1 align="center">BRICaMS Addons - Compare Microservices</h1>
</div>
<!-- End Page Title -->

<div class="card mb-3">
	<h5 class="card-title"></h5>
	<div class="card-body">

	  <form id="search_form" class="row g-3 needs-validation" action="" method="post" novalidate>

		<div class="row mb-3">
		  <label for="namespace_txt" class="col-sm-2 col-form-label">Namespace</label>
		  <div class="col-sm-10">
			<input type="text" class="form-control" name="namespace_txt" id="namespace_txt" required readonly value="bricams">
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
		  <button class="btn btn-primary w-100" type="submit" id="search_capture_btn">
			Search Capture
		  </button>
		</div>
	  </form>

	</div>
	
</div>

<div id="form_result"><?php echo isset($form_result)?$form_result:''; ?></div>

<script type="text/javascript">
function validate_form_micro(){
	if($('#deployment_txt').val() == ''){
		return false;
	}
	return true;
}
$(document).ready(function(){
	$('#search_form').submit(function(){
		if(validate_form_micro() == true){
			$.ajax({
				type : "POST",
				url  : "<?=site_url('Bricams/capture_micro_compare_result');?>",
				data : $(this).serialize(),
				beforeSend:function(){
					//$('#ajax-loader').show();
					$('#search_capture_btn').attr("disabled","disabled");
					$('#search_capture_btn').text('Loading...');
					$('#search_capture_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
				},
				error: function(){
					//$('#ajax-loader').hide();
					$('#search_capture_btn').removeAttr("disabled");
					$('#search_capture_btn').text("Search Capture");
					alert('Error, Terjadi gagal sistem.');
				},
				success: function(data){
					//$('#ajax-loader').hide();
					$('#search_capture_btn').removeAttr("disabled");
					$('#search_capture_btn').text("Search Capture");
					$('#form_result').html(data);
				}
			});
			return false;
		}
	});
});
</script>
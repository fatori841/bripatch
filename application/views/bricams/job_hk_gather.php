<div class="pagetitle">
  <h1 align="center">BRICAMS - Job HK & Gather Stats Table</h1>
</div>
<!-- End Page Title -->

<div class="col-12">
	<div class="col-lg-3">
		<div class="card mb-3">
			<div class="card-body">
				<p></p>
				<form id="search_data_user" class="row g-3 needs-validation" action="" method="post" novalidate>
				<button class="btn btn-primary" type="submit" id="refresh_user_btn">
					<span class="bx bx-refresh" style="margin-right:5px;"></span>Refresh
				</button>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="col-12">
<div class="row">
	<div class="col-lg-12" id="form_result">
		<?php echo isset($form_result)?$form_result:''; ?>
	</div>
</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#search_data_user').submit(function(){
		$.ajax({
			type : "POST",
			url  : "<?=site_url('Bricams/job_hk_gather_result');?>",
			data : $(this).serialize(),
			beforeSend:function(){
				//$('#ajax-loader').show();
				$('#refresh_user_btn').attr("disabled","disabled");
				$('#refresh_user_btn').text('Loading...');
				$('#refresh_user_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
			},
			error: function(){
				//$('#ajax-loader').hide();
				$('#refresh_user_btn').removeAttr("disabled");
				$('#refresh_user_btn').text("Refresh");
				$('#refresh_user_btn').prepend('<span class="bx bx-refresh" style="margin-right:5px;"></span>');
				alert('Error, Terjadi gagal sistem.');
			},
			success: function(data){
				//$('#ajax-loader').hide();
				$('#refresh_user_btn').removeAttr("disabled");
				$('#refresh_user_btn').text("Refresh");
				$('#refresh_user_btn').prepend('<span class="bx bx-refresh" style="margin-right:5px;"></span>');
				$('#form_result').html(data);
			}
		});
		return false;
	});
	
	$('#refresh_user_btn').click();
});
</script>
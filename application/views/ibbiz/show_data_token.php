<div class="pagetitle">
  <h1 align="center">iBBIZ - Token Detail</h1>
</div>
<!-- End Page Title -->

<div class="card mb-3">
	<h5 class="card-title"></h5>
	<div class="card-body">

	  <form id="search_data_token" class="row g-3 needs-validation" action="" method="post" novalidate>
		
		<div class="row mb-3">
		  <label for="value_txt" class="col-sm-2 col-form-label">Username</label>
		  <div class="col-sm-10">
			<input type="text" class="form-control" name="value_txt" id="value_txt" required>
			<div class="invalid-feedback">Please enter the Username.</div>
		  </div>
		</div>

		<div class="col-12">
		  <button class="btn btn-primary w-100" type="submit" id="search_token_btn">
			Search
		  </button>
		</div>
	  </form>

	</div>
</div>

<div class="col-lg-12" id="form_result"><?php echo isset($form_result)?$form_result:''; ?></div>

<script type="text/javascript">
$(document).ready(function(){
	$('#search_data_token').submit(function(){
		$.ajax({
			type : "POST",
			url  : "<?=site_url('Ibbiz/search_data_token');?>",
			data : $(this).serialize(),
			beforeSend:function(){
				//$('#ajax-loader').show();
				$('#search_token_btn').attr("disabled","disabled");
				$('#search_token_btn').text('Loading...');
				$('#search_token_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
			},
			error: function(){
				//$('#ajax-loader').hide();
				$('#search_token_btn').removeAttr("disabled");
				$('#search_token_btn').text("Search");
				alert('Error, Terjadi gagal sistem.');
			},
			success: function(data){
				//$('#ajax-loader').hide();
				$('#search_token_btn').removeAttr("disabled");
				$('#search_token_btn').text("Search");
				$('#form_result').html(data);
			}
		});
		return false;
	});
});
</script>
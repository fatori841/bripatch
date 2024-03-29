<div class="pagetitle">
  <h1 align="center">BRIMO - Microservice List</h1>
</div>
<!-- End Page Title -->

<div class="card mb-3">
	<h5 class="card-title"></h5>
	<div class="card-body">

	  <form id="search_micro" class="row g-3 needs-validation" action="" method="post" novalidate>

		<div class="row mb-3">
		  <label for="value_txt" class="col-sm-2 col-form-label">Keyword</label>
		  <div class="col-sm-10">
			<input type="text" class="form-control" name="key_txt" id="key_txt" required>
			<div class="invalid-feedback">Please enter the value.</div>
		  </div>
		</div>

		<div class="col-12">
		  <button class="btn btn-primary w-100" type="submit" id="search_micro_btn">
			Search
		  </button>
		</div>
	  </form>

	</div>
	
</div>

<div class="col-12">
	<form id="form_add_micro" class="row g-3 needs-validation" action="<?=site_url('Brimo/add_micro');?>" method="post" novalidate align="center">
		<p align="center">
			<button class="btn btn-primary rounded-pill" type="submit" id="add_micro_btn">
				<span class="bx bx-plus-circle" style="margin-right:5px;"></span>Add Microservice
			</button>
		</p>
	</form>
</div>

<div class="col-lg-12" id="form_result"><?php echo isset($form_result)?$form_result:''; ?></div>

<script type="text/javascript">
$(document).ready(function(){
	$('#search_micro').submit(function(){
		$.ajax({
			type : "POST",
			url  : "<?=site_url('Brimo/search_micro');?>",
			data : $(this).serialize(),
			beforeSend:function(){
				//$('#ajax-loader').show();
				$('#search_micro_btn').attr("disabled","disabled");
				$('#search_micro_btn').text('Loading...');
				$('#search_micro_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
			},
			error: function(){
				//$('#ajax-loader').hide();
				$('#search_micro_btn').removeAttr("disabled");
				$('#search_micro_btn').text("Search");
				alert('Error, Terjadi gagal sistem.');
			},
			success: function(data){
				//$('#ajax-loader').hide();
				$('#search_micro_btn').removeAttr("disabled");
				$('#search_micro_btn').text("Search");
				$('#form_result').html(data);
			}
		});
		return false;
	});
});
</script>
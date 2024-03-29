<div class="pagetitle">
  <h1 align="center">BRIMO - Search Account by Card Number</h1>
</div>
<!-- End Page Title -->

<div class="card mb-3">
	<h5 class="card-title"></h5>
	<div class="card-body">

	  <form id="search_data_user" class="row g-3 needs-validation" action="" method="post" novalidate>		
		<div class="row mb-3">
		  <label for="card_number" class="col-sm-2 col-form-label">Card Number</label>
		  <div class="col-sm-10">
			<input type="text" class="form-control" name="card_number" id="card_number" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="16" required>
			<div class="invalid-feedback">Please enter the value.</div>
		  </div>
		</div>

		<div class="col-12">
		  <button class="btn btn-primary w-100" type="submit" id="search_user_btn">
			Search
		  </button>
		</div>
	  </form>

	</div>
	
</div>

<div class="col-lg-12" id="form_result"><?php echo isset($form_result)?$form_result:''; ?></div>

<script type="text/javascript">
$(document).ready(function(){
	$('#search_data_user').submit(function(){
		$.ajax({
			type : "POST",
			url  : "<?=site_url('Brimo/search_acc_by_card');?>",
			data : $(this).serialize(),
			beforeSend:function(){
				//$('#ajax-loader').show();
				$('#search_user_btn').attr("disabled","disabled");
				$('#search_user_btn').text('Loading...');
				$('#search_user_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
			},
			error: function(){
				//$('#ajax-loader').hide();
				$('#search_user_btn').removeAttr("disabled");
				$('#search_user_btn').text("Search");
				alert('Error, Terjadi gagal sistem.');
			},
			success: function(data){
				//$('#ajax-loader').hide();
				$('#search_user_btn').removeAttr("disabled");
				$('#search_user_btn').text("Search");
				$('#form_result').html(data);
			}
		});
		return false;
	});
});
</script>
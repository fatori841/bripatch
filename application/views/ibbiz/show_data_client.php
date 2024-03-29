<div class="pagetitle">
  <h1 align="center">iBBIZ - Client Detail</h1>
</div>
<!-- End Page Title -->

<div class="card mb-3">
	<h5 class="card-title"></h5>
	<div class="card-body">

	  <form id="search_data_client" class="row g-3 needs-validation" action="" method="post" novalidate>
		
		<div class="row mb-3">
		  <label for="parameter_txt" class="col-sm-2 col-form-label">Parameter</label>
		  <div class="col-sm-10">
			<select class="form-select" aria-label="Default select example" name="parameter_txt" id="parameter_txt" required>
			  <option selected value="corp_id_opt">Corp ID</option>
			  <option value="account_opt">Account</option>
			  <option value="client_id_opt">Client ID</option>
			  <option value="cif_opt">CIF</option>
			  <option value="alias_opt">Alias</option>
			  <option value="refnum_opt">Refnum</option>
			</select>
		  </div>
		</div>
		
		<div class="row mb-3">
		  <label for="value_txt" class="col-sm-2 col-form-label">Value</label>
		  <div class="col-sm-10">
			<input type="text" class="form-control" name="value_txt" id="value_txt" required>
			<div class="invalid-feedback">Please enter the Value.</div>
		  </div>
		</div>

		<div class="col-12">
		  <button class="btn btn-primary w-100" type="submit" id="search_client_btn">
			Search
		  </button>
		</div>
	  </form>

	</div>
</div>

<div class="col-lg-12" id="form_result"><?php echo isset($form_result)?$form_result:''; ?></div>

<script type="text/javascript">
$(document).ready(function(){
	$('#search_data_client').submit(function(){
		$.ajax({
			type : "POST",
			url  : "<?=site_url('Ibbiz/search_data_client');?>",
			data : $(this).serialize(),
			beforeSend:function(){
				//$('#ajax-loader').show();
				$('#search_client_btn').attr("disabled","disabled");
				$('#search_client_btn').text('Loading...');
				$('#search_client_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
			},
			error: function(){
				//$('#ajax-loader').hide();
				$('#search_client_btn').removeAttr("disabled");
				$('#search_client_btn').text("Search");
				alert('Error, Terjadi gagal sistem.');
			},
			success: function(data){
				//$('#ajax-loader').hide();
				$('#search_client_btn').removeAttr("disabled");
				$('#search_client_btn').text("Search");
				$('#form_result').html(data);
			}
		});
		return false;
	});
});
</script>
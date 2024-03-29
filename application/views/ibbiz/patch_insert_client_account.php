<div class="pagetitle">
  <h1 align="center">iBBIZ - Insert Client Account</h1>
</div>
<!-- End Page Title -->

<div class="card mb-3">
	<h5 class="card-title"></h5>
	<div class="card-body">

	  <form id="form_insert_data_client_account" class="row g-3 needs-validation" action="" method="post" novalidate>
		
		<div class="row mb-3">
		  <label for="pid_txt" class="col-sm-2 col-form-label">PID</label>
		  <div class="col-sm-10">
			<input type="number" class="form-control" name="pid_txt" id="pid_txt" required>
			<div class="invalid-feedback">Please enter the PID.</div>
		  </div>
		</div>
		
		<div class="row mb-3">
		  <label for="code_txt" class="col-sm-2 col-form-label">CODE</label>
		  <div class="col-sm-10">
			<input type="text" class="form-control" name="code_txt" id="code_txt" style="text-transform:uppercase" required>
			<div class="invalid-feedback">Please enter the 	CODE.</div>
		  </div>
		</div>
		
		<div class="row mb-3">
		  <label for="account_txt" class="col-sm-2 col-form-label">ACCOUNT</label>
		  <div class="col-sm-10">
			<input type="number" class="form-control" name="account_txt" id="account_txt" style="text-transform:uppercase" required>
			<div class="invalid-feedback">Please enter the ACCOUNT.</div>
		  </div>
		</div>
		
		<div class="row mb-3">
		  <label for="cardnum_txt" class="col-sm-2 col-form-label">CARDNUM</label>
		  <div class="col-sm-10">
			<input type="number" class="form-control" name="cardnum_txt" id="cardnum_txt" style="text-transform:uppercase" required>
			<div class="invalid-feedback">Please enter the CARDNUM.</div>
		  </div>
		</div>
		
		<div class="row mb-3">
		  <label for="currency_txt" class="col-sm-2 col-form-label">CURRENCY</label>
		  <div class="col-sm-10">
			<input type="text" class="form-control" name="currency_txt" id="currency_txt" style="text-transform:uppercase" required>
			<div class="invalid-feedback">Please enter the CURRENCY.</div>
		  </div>
		</div>
		
		<div class="row mb-3">
		  <label for="type_txt" class="col-sm-2 col-form-label">TYPE</label>
		  <div class="col-sm-10">
			<input type="text" class="form-control" name="type_txt" id="type_txt" style="text-transform:uppercase" required>
			<div class="invalid-feedback">Please enter the TYPE.</div>
		  </div>
		</div>
		
		<div class="row mb-3">
		  <label for="cif_txt" class="col-sm-2 col-form-label">CIF</label>
		  <div class="col-sm-10">
			<input type="text" class="form-control" name="cif_txt" id="cif_txt" style="text-transform:uppercase" required>
			<div class="invalid-feedback">Please enter the CIF.</div>
		  </div>
		</div>
		
		<div class="row mb-3">
		  <label for="status_txt" class="col-sm-2 col-form-label">STATUS</label>
		  <div class="col-sm-10">
			<input type="number" class="form-control" name="status_txt" id="status_txt" required>
			<div class="invalid-feedback">Please enter the STATUS.</div>
		  </div>
		</div>
		
		<div class="row mb-3">
		  <label for="description_txt" class="col-sm-2 col-form-label">DESCRIPTION</label>
		  <div class="col-sm-10">
			<input type="text" class="form-control" name="description_txt" id="description_txt" style="text-transform:uppercase" required>
			<div class="invalid-feedback">Please enter the DESCRIPTION.</div>
		  </div>
		</div>

		<div class="col-12">
		  <button class="btn btn-primary w-100" type="submit" id="insert_client_account_btn">
			Insert
		  </button>
		</div>
	  </form>

	</div>
</div>

<div class="col-lg-12" id="form_result"><?php echo isset($form_result)?$form_result:''; ?></div>

<script type="text/javascript">
$(document).ready(function(){
	$('#form_insert_data_client_account').submit(function(){
		$.ajax({
			type : "POST",
			url  : "<?=site_url('Ibbiz/insert_data_client_account');?>",
			data : $(this).serialize(),
			beforeSend:function(){
				//$('#ajax-loader').show();
				$('#insert_client_account_btn').attr("disabled","disabled");
				$('#insert_client_account_btn').text('Loading...');
				$('#insert_client_account_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
			},
			error: function(){
				//$('#ajax-loader').hide();
				$('#insert_client_account_btn').removeAttr("disabled");
				$('#insert_client_account_btn').text("Insert");
				alert('Error, Terjadi gagal sistem.');
			},
			success: function(data){
				//$('#ajax-loader').hide();
				$('#insert_client_account_btn').removeAttr("disabled");
				$('#insert_client_account_btn').text("Insert");
				alert(data);
				
			}
		});
		return false;
	});
});
</script>
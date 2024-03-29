<div class="pagetitle">
  <h1 align="center">iBBIZ - Data Do Pertamina</h1>
</div>
<!-- End Page Title -->

<div class="card mb-3">
	<h5 class="card-title"></h5>
	<div class="card-body">

	  <form id="show_data_do_pertamina" class="row g-3 needs-validation" action="" method="post" novalidate>
	  
	  <div class="row mb-3">
		  <label for="parameter_txt" class="col-sm-2 col-form-label">Jenis DO Pertamina</label>
		  <div class="col-sm-10">
			<select class="form-select" aria-label="Default select example" name="parameter_txt" id="parameter_txt" required>
			  <option selected value="cashcarry_opt">DO PERTAMINA CASHCARRY</option>
			  <option value="product_allocation_opt">DO PERTAMINA PRODUCT ALLOCATION</option>
			  <option value="quotation_opt">DO PERTAMINA QUOTATION</option>
			</select>
		  </div>
		</div>
		
		<div class="row mb-3">
		  <label for="value_txt" class="col-sm-2 col-form-label">Data Rekening Koran</label>
		  <div class="col-sm-10">
			<input type="text" class="form-control" name="value_txt" id="value_txt" required>
			<div class="invalid-feedback">Please enter the Data.</div>
		  </div>
		</div>

		<div class="col-12">
		  <button class="btn btn-primary w-100" type="submit" id="show_data_do_pertamina_btn">
			Search
		  </button>
		</div>
	  </form>

	</div>
</div>

<div class="col-lg-12" id="form_result"><?php echo isset($form_result)?$form_result:''; ?></div>

<script type="text/javascript">
$(document).ready(function(){
	$('#show_data_do_pertamina').submit(function(){
		$.ajax({
			type : "POST",
			url  : "<?=site_url('Ibbiz/get_data_do_pertamina');?>",
			data : $(this).serialize(),
			beforeSend:function(){
				//$('#ajax-loader').show();
				$('#show_data_do_pertamina_btn').attr("disabled","disabled");
				$('#show_data_do_pertamina_btn').text('Loading...');
				$('#show_data_do_pertamina_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
			},
			error: function(){
				//$('#ajax-loader').hide();
				$('#show_data_do_pertamina_btn').removeAttr("disabled");
				$('#show_data_do_pertamina_btn').text("Search");
				alert('Error, Terjadi gagal sistem.');
			},
			success: function(data){
				//$('#ajax-loader').hide();
				$('#show_data_do_pertamina_btn').removeAttr("disabled");
				$('#show_data_do_pertamina_btn').text("Search");
				$('#form_result').html(data);
			}
		});
		return false;
	});
});
</script>
<div class="pagetitle">
  <h1 align="center">CMS - Show Data Transaksi</h1>
  
</div>
<!-- End Page Title -->

<div class="card mb-3">
	<h5 class="card-title"></h5>
	<div class="card-body">
	
		<div class="row mb-3" id="fitur_row">
		  <label for="fitur" class="col-sm-2 col-form-label">FITUR</label>
		  <div class="col-sm-10">
			<select class="form-select" aria-label="Default select example" name="fitur" id="fitur" required>
			  <option selected value="80">SINGLE FT</option>
			  <option value="85">COLLECTIVE FT</option>
			  <!--<option value="110">MASS FT</option>
			  <option value="1200">SINGLE CN</option>
			  <option value="1210">MASS CN</option>
			  <option value="1920">PAJAK</option>
			  <option value="180">SINGLE SWIFT</option>
			  <option value="100">PAYROLL</option>
			  <option value="120">SINGLE RTGS</option>
			  <option value="1140">PAYMENT PRIORITY</option>
			  <option value="150">POOLING</option> -->
			  
			</select>
		  </div>
		</div>

	</div>
</div>

<div class="col-lg-12" id="trx_result"><?php echo isset($form_result)?$form_result:''; ?></div>

<script type="text/javascript">
$(document).ready(function(){
	$('#fitur').on('change', function() {
	  $.ajax({
			type : "POST",
			url  : "<?=site_url('Cms/search_data_trx');?>",
			data : "fid="+$(this).val(),
			error: function(){
				alert('Error, Terjadi gagal sistem.');
			},
			success: function(data){
				$('#trx_result').html(data);
			}
		});
	});
	$("#fitur").trigger('change');
});
</script>
<div class="card mb-3">
	<h5 class="card-title"></h5>
	<div class="card-body">

	  <form id="search_data_trx_sft" class="row g-3 needs-validation" action="" method="post" novalidate>
		<div class="row mb-3">
		  <label for="search_by" class="col-sm-2 col-form-label">Search By</label>
		  <div class="col-sm-10">
			<select class="form-select" aria-label="Default select example" name="search_by" id="search_by" required>
			  <option selected value="search_by_sftid">ID Single FT</option>
			  <option value="search_by_transactionid">ID Transactions</option>
			  <option value="search_by_transactionobject">Transaction Object</option>
			  <option value="search_by_last_sft_client">10 Transaksi Terakhir Single FT</option>
			  <option value="search_by_last_transactions_client">10 Transaksi Terakhir Transactions</option>
			</select>
		  </div>
		</div>
		
		<div class="row mb-3" id="value_row">
		  <label for="value_txt" class="col-sm-2 col-form-label" id="value_label">Value</label>
		  <div class="col-sm-10">
			<input type="number" class="form-control" name="value_txt" id="value_txt" required>
			<div class="invalid-feedback">Please enter the value.</div>
		  </div>
		</div>
		<div class="col-12">
		  <button class="btn btn-primary w-100" type="submit" id="search_sft_btn">
			Search
		  </button>
		</div>
	  </form>

	</div>
</div>

<div class="col-lg-12" id="form_result"><?php echo isset($form_result)?$form_result:''; ?></div>

<script type="text/javascript">
$(document).ready(function(){
	$('#search_by').on('change', function() {
	  if ( this.value == 'search_by_sftid')
	  {
		  $('#value_txt').prop("required",true);
		  $('#value_txt').attr("type","number");
		  $('#value_row').attr("hidden",false);
		  $('#value_label').text("ID Single FT");
	  }
	  if ( this.value == 'search_by_transactionid')
	  {
		  $('#value_txt').prop("required",true);
		  $('#value_txt').attr("type","number");
		  $('#value_row').attr("hidden",false);
		  $('#value_label').text("ID transactions");
	  }
	  if ( this.value == 'search_by_transactionobject')
	  {
		  $('#value_txt').prop("required",true);
		  $('#value_txt').attr("type","text");
		  $('#value_row').attr("hidden",false);
		  $('#value_label').text("Transaction Object Like");
	  }
	  if ( this.value == 'search_by_last_sft_client')
	  {
		  $('#value_txt').prop("required",true);
		  $('#value_txt').attr("type","number");
		  $('#value_row').attr("hidden",false);
		  $('#value_label').text("Client ID");
	  }
	  if ( this.value == 'search_by_last_transactions_client')
	  {
		  $('#value_txt').prop("required",true);
		  $('#value_txt').attr("type","number");
		  $('#value_row').attr("hidden",false);
		  $('#value_label').text("Client ID");
	  }
	  
	});
	$('#search_data_trx_sft').submit(function(){
		$.ajax({
			type : "POST",
			url  : "<?=site_url('Cms/search_data_trx_sft');?>",
			data : $(this).serialize(),
			beforeSend:function(){
				$('#search_sft_btn').attr("disabled","disabled");
				$('#search_sft_btn').text('Loading...');
				$('#search_sft_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
			},
			error: function(){
				$('#search_sft_btn').removeAttr("disabled");
				$('#search_sft_btn').text("Search");
				alert('Error, Terjadi gagal sistem.');
			},
			success: function(data){
				$('#search_sft_btn').removeAttr("disabled");
				$('#search_sft_btn').text("Search");
				$('#form_result').html(data);
			}
		});
		return false;
	});

});
</script>
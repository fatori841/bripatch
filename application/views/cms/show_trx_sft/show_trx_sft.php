<div class="pagetitle">
  <h1 align="center">CMS - Show Trx Single FT</h1>
  
</div>
<!-- End Page Title -->

<div class="card mb-3">
	<h5 class="card-title"></h5>
	<div class="card-body">

	  <form id="search_data_sch" class="row g-3 needs-validation" action="" method="post" novalidate>

		<div class="row mb-3">
		  <label for="search_by" class="col-sm-2 col-form-label">Search By</label>
		  <div class="col-sm-10">
			<select class="form-select" aria-label="Default select example" name="search_by" id="search_by" required>
			  <option selected value="all">Show All Scheduler</option>
			  <option value="search_by_schcode">SCHCODE</option>
			  <option value="search_by_fitur">FITUR</option>
			  <option value="search_by_serverid">SERVERID</option>
			</select>
		  </div>
		</div>
		
		<div class="row mb-3" id="value_row">
		  <label for="value_txt" class="col-sm-2 col-form-label">Value</label>
		  <div class="col-sm-10">
			<input type="text" class="form-control" name="value_txt" id="value_txt" required>
			<div class="invalid-feedback">Please enter the value.</div>
		  </div>
		</div>
		
		<div class="row mb-3" id="serverid_row">
		  <label for="serverid" class="col-sm-2 col-form-label">Server ID</label>
		  <div class="col-sm-10">
			<select class="form-select" aria-label="Default select example" name="serverid" id="serverid" required>
			  <option selected value="172.21.20.10">172.21.20.10</option>
			  <option value="172.21.20.8">172.21.20.8</option>
			  <option value="172.21.20.112">172.21.20.112</option>
			  <option value="172.21.20.115">172.21.20.115</option>
			  <option value="172.21.20.25">172.21.20.25</option>
			  <option value="172.21.20.27">172.21.20.27</option>
			  <option value="172.21.20.78">172.21.20.78</option>
			</select>
		  </div>
		</div>
		
		<div class="row mb-3" id="fitur_row">
		  <label for="fitur" class="col-sm-2 col-form-label">FITUR</label>
		  <div class="col-sm-10">
			<select class="form-select" aria-label="Default select example" name="fitur" id="fitur" required>
			  <option selected value="80">SINGLE FT</option>
			  <option value="85">COLLECTIVE FT</option>
			  <option value="110">MASS FT</option>
			  <option value="1200">SINGLE CN</option>
			  <option value="1210">MASS CN</option>
			  <option value="1920">PAJAK</option>
			  <option value="180">SINGLE SWIFT</option>
			  <option value="100">PAYROLL</option>
			  <option value="120">SINGLE RTGS</option>
			  <option value="1140">PAYMENT PRIORITY</option>
			  <option value="150">POOLING</option>
			  <option value="6030">BIFAST</option>
			</select>
		  </div>
		</div>

		<div class="col-12">
		  <button class="btn btn-primary w-100" type="submit" id="search_sch_btn">
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
	  if ( this.value == 'all')
	  {
		  $('#value_txt').prop("required",false);
		  $('#value_row').attr("hidden",true);
		  $('#serverid').prop("required",false);
		  $('#serverid_row').attr("hidden",true);
		  $('#fitur').prop("required",false);
		  $('#fitur_row').attr("hidden",true);
		  
	  }
	  if (this.value == 'search_by_serverid')
	  {
		  $('#serverid').prop("required",true);
		  $('#serverid_row').attr("hidden",false);
		  $('#value_txt').prop("required",false);
		  $('#value_row').attr("hidden",true);
		  $('#fitur').prop("required",false);
		  $('#fitur_row').attr("hidden",true);
	  }
	  if (this.value == 'search_by_schcode')
	  {
		  $('#value_txt').prop("required",true);
		  $('#value_row').attr("hidden",false);
		  $('#serverid').prop("required",false);
		  $('#serverid_row').attr("hidden",true);
		  $('#fitur').prop("required",false);
		  $('#fitur_row').attr("hidden",true);
	  }
	  if (this.value == 'search_by_fitur')
	  {
		  $('#fitur').prop("required",true);
		  $('#fitur_row').attr("hidden",false);
		  $('#serverid').prop("required",false);
		  $('#serverid_row').attr("hidden",true);
		  $('#value_txt').prop("required",false);
		  $('#value_row').attr("hidden",true);
	  }
	});
	$('#search_data_sch').submit(function(){
		$.ajax({
			type : "POST",
			url  : "<?=site_url('Cms/search_data_sch');?>",
			data : $(this).serialize(),
			beforeSend:function(){
				$('#search_sch_btn').attr("disabled","disabled");
				$('#search_sch_btn').text('Loading...');
				$('#search_sch_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
			},
			error: function(){
				$('#search_sch_btn').removeAttr("disabled");
				$('#search_sch_btn').text("Search");
				alert('Error, Terjadi gagal sistem.');
			},
			success: function(data){
				$('#search_sch_btn').removeAttr("disabled");
				$('#search_sch_btn').text("Search");
				$('#form_result').html(data);
			}
		});
		return false;
	});
	$("#search_by").trigger('change');
});
</script>
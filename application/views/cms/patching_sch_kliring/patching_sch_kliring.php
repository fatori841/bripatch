<div class="pagetitle">
  <h1 align="center">CMS - Boosting Kliring 20.19</h1>
</div>
<!-- End Page Title -->

<div class="card mb-3">
	<h5 class="card-title"></h5>
	
	<div class="card-body">
		<form id="search_data_sch_kliring" class="row g-3 needs-validation" action="" method="post" novalidate>
			
			<select class="form-select" aria-label="Default select example" name="search_by" id="search_by" hidden>
			  <option selected value="search_by_serverid">SERVER</option>
			</select>
			<select class="form-select" aria-label="Default select example" name="server" id="serverid" hidden>
				 <option selected value="172.21.20.19">20.19</option>
			</select>

			<button class="btn btn-primary w-100" type="submit" id="search_sch_btn">
				Refresh
		  </button>
		</form>
	</div>
</div>


<div class="col-lg-12" id="form_result"><?php echo isset($form_result)?$form_result:''; ?></div>

<script type="text/javascript">
$(document).ready(function(){
	$('#search_data_sch_kliring').submit(function(){
		$.ajax({
			type : "POST",
			url  : "<?=site_url('Cms/search_data_sch_kliring');?>",
			data : $(this).serialize(),
			beforeSend:function(){
				$('#search_sch_btn').attr("disabled","disabled");
				$('#search_sch_btn').text('Loading...');
				$('#search_sch_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
			},
			error: function(){
				$('#search_sch_btn').removeAttr("disabled");
				$('#search_sch_btn').text("Refresh");
				alert('Error, Terjadi gagal sistem.');
			},
			success: function(data){
				$('#search_sch_btn').removeAttr("disabled");
				$('#search_sch_btn').text("Refresh");
				$('#form_result').html(data);
				var rowCount = $('#tbl_result tr').length;
				console.log(rowCount);
			}
		});
		return false;
	});
	
	$("#search_data_sch_kliring").trigger('submit');
	
});
</script>


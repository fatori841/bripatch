<div class="pagetitle">
  <h1 align="center">CMS - Scheduler Not Update in 30 Minutes</h1>
  
</div>
<!-- End Page Title -->

<div class="card mb-3">
	<h5 class="card-title"></h5>
	<div class="card-body">
		<div class="col-12">
		  <button class="btn btn-primary w-100" id="refresh">
			Refresh
		  </button>
		</div>

	</div>
</div>

<div class="col-lg-12" id="form_result"><?php echo isset($form_result)?$form_result:''; ?></div>

<script type="text/javascript">
$(document).ready(function(){
	$('#refresh').click(function(){
		$.ajax({
			type : "POST",
			url  : "<?=site_url('Cms/search_sch_not_update');?>",
			data : '',
			beforeSend:function(){
				$('#refresh').attr("disabled","disabled");
				$('#refresh').text('Loading...');
				$('#refresh').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
			},
			error: function(){
				$('#refresh').removeAttr("disabled");
				$('#refresh').text("Refresh");
				alert('Error, Terjadi gagal sistem.');
			},
			success: function(data){
				$('#refresh').removeAttr("disabled");
				$('#refresh').text("Refresh");
				$('#form_result').html(data);
			}
		});
		return false;
	});
	$("#refresh").trigger('click');
});
</script>
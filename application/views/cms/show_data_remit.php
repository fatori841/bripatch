
	  <form id="search_data_remit" class="row g-3 needs-validation" action="" method="post" novalidate>

		<input type="text" class="form-control" name="search_type" id="search_type" value="show" hidden required>
		
		<div class="col-12">
		  <button class="btn btn-primary rounded-pill" type="submit" id="search_user_btn">
			Refresh
		  </button>
		</div>
	  </form>


<div class="col-lg-12" id="form_result"><?php echo isset($form_result)?$form_result:''; ?></div>

<script type="text/javascript">
$(document).ready(function(){
	$('#search_data_remit').submit(function(){
		$.ajax({
			type : "POST",
			url  : "<?=site_url('Cms/search_data_remit');?>",
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
				$('#search_user_btn').text("Refresh");
				alert('Error, Terjadi gagal sistem.');
			},
			success: function(data){
				//$('#ajax-loader').hide();
				$('#search_user_btn').removeAttr("disabled");
				$('#search_user_btn').text("Refresh");
				$('#form_result').html(data);
			}
		});
		return false;
	});
	
	$('#search_data_remit').submit();
});
</script>
<div class="pagetitle">
  <h1 align="center">iBBIZ - Open Close BIFAST</h1>
</div>
<!-- End Page Title -->

<div class="col-12">
	<div class="col-lg-3">
		<div class="card mb-3">
			<div class="card-body">
				<p></p>
				<form id="search_data_bifast" class="row g-3 needs-validation" action="" method="post" novalidate>
				<button class="btn btn-primary" type="submit" id="refresh_user_btn">
					<span class="bx bx-refresh" style="margin-right:5px;"></span>Refresh
				</button>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="card mb-3">
	<h5 class="card-title"></h5>
	<div class="card-body">

	  <form id="close_bifast" class="row g-3 needs-validation" action="" method="post" novalidate>
		<div class="col-12">
		  <button class="btn btn-primary w-100" type="submit" id="close_bifast_btn" style = "background-color : #EC2E5D">
			CLOSE BIFAST
		  </button>
		</div>
	  </form>

	</div>
	
	<div class="card-body">

	  <form id="open_bifast" class="row g-3 needs-validation" action="" method="post" novalidate>
		<div class="col-12">
		  <button class="btn btn-primary w-100" type="submit" id="open_bifast_btn" style = "background-color : #54B972">
			OPEN BIFAST
		  </button>
		</div>
	  </form>

	</div>
	
</div>

<div class="col-12">
<div class="row">
	<div class="col-lg-12" id="form_result">
		<?php echo isset($form_result)?$form_result:''; ?>
	</div>
</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#search_data_bifast').submit(function(){
		$.ajax({
			type : "POST",
			url  : "<?=site_url('Ibbiz/show_bifast_result');?>",
			data : $(this).serialize(),
			beforeSend:function(){
				//$('#ajax-loader').show();
				$('#refresh_user_btn').attr("disabled","disabled");
				$('#refresh_user_btn').text('Loading...');
				$('#refresh_user_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
			},
			error: function(){
				//$('#ajax-loader').hide();
				$('#refresh_user_btn').removeAttr("disabled");
				$('#refresh_user_btn').text("Refresh");
				$('#refresh_user_btn').prepend('<span class="bx bx-refresh" style="margin-right:5px;"></span>');
				alert('Error, Terjadi gagal sistem.');
			},
			success: function(data){
				//$('#ajax-loader').hide();
				$('#refresh_user_btn').removeAttr("disabled");
				$('#refresh_user_btn').text("Refresh");
				$('#refresh_user_btn').prepend('<span class="bx bx-refresh" style="margin-right:5px;"></span>');
				$('#form_result').html(data);
			}
		});
		return false;
	});
	
	$('#refresh_user_btn').click();
});
</script>

<script type="text/javascript">
$(document).ready(function(){
	$('#close_bifast').submit(function(){
		$.ajax({
			type : "POST",
			url  : "<?=site_url('Ibbiz/close_bifast_all');?>",
			data : $(this).serialize(),
			beforeSend:function(){
				//$('#ajax-loader').show();
				javascript:return confirm('Apakah yakin semua bank bifast ditutup?');
				$('#close_bifast_btn').attr("disabled","disabled");
				$('#close_bifast_btn').text('Loading...');
				$('#close_bifast_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
			},
			error: function(){
				//$('#ajax-loader').hide();
				$('#close_bifast_btn').removeAttr("disabled");
				$('#close_bifast_btn').text("CLOSE BIFAST");
				alert('Error, Terjadi gagal sistem.');
			},
			success: function(data){
				//$('#ajax-loader').hide();
				$('#close_bifast_btn').removeAttr("disabled");
				$('#close_bifast_btn').text("CLOSE BIFAST");
				$('#form_result').html(data);
				window.open('http://perseus-ibbiz.apps.ocp-dc-new.bri.co.id/login');
			}
		});
		return false;
	});
});
</script>

<script type="text/javascript">
$(document).ready(function(){
	$('#open_bifast').submit(function(){
		$.ajax({
			type : "POST",
			url  : "<?=site_url('Ibbiz/open_bifast');?>",
			data : $(this).serialize(),
			beforeSend:function(){
				//$('#ajax-loader').show();
				javascript:return confirm('Apakah yakin semua bank bifast dibuka?');
				$('#open_bifast_btn').attr("disabled","disabled");
				$('#open_bifast_btn').text('Loading...');
				$('#open_bifast_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
			},
			error: function(){
				//$('#ajax-loader').hide();
				$('#open_bifast_btn').removeAttr("disabled");
				$('#open_bifast_btn').text("OPEN BIFAST");
				alert('Error, Terjadi gagal sistem.');
			},
			success: function(data){
				//$('#ajax-loader').hide();
				$('#open_bifast_btn').removeAttr("disabled");
				$('#open_bifast_btn').text("OPEN BIFAST");
				$('#form_result').html(data);
				window.open('http://perseus-ibbiz.apps.ocp-dc-new.bri.co.id/login');
				
			}
		});
		return false;
	});
});
</script>


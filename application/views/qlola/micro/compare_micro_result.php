<?php
	if($this->session->userdata('ibo_msg_notif') && $this->session->userdata('ibo_msg_alert')){
		if($this->session->userdata('ibo_msg_alert') == 'success'){
			$alert_type = 'alert-success';
		}else{
			$alert_type = 'alert-danger';
		}
		?>
		<div class="alert <?php echo $alert_type; ?> alert-dismissible fade show" role="alert">
			<i class="bi bi-exclamation-octagon me-1"></i>
			<span class="small"><?php echo $this->session->userdata('ibo_msg_notif'); ?></span>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		<?php
		
		$this->session->unset_userdata('ibo_msg_notif');
		$this->session->unset_userdata('ibo_msg_alert');
	}
?>


<div class="col-lg-12">
	<div class="card mb-3">
		<div class="card-body">
			<div class="row g-3">
				<div class="col-sm-12">
					<h5 class="card-title">Compare Result</h5>
				</div>
			</div>
			  <div class="card-body pb-0" id="div_compare_summary_result"></div>
			  <div class="card-body">
			  <br/>
			  <form id="compare_result_form" class="row g-3 needs-validation" action="" method="post" novalidate>
				<?php 
					echo form_hidden('radio_compare',$arr_id);
				?>
				<div class="row mb-3">
					<div class="col-sm-12">
						<h5 class="card-title">Compare Detail</h5>
					</div>
				</div>
				<div class="row mb-3">
				  <div class="col-sm-2">
					<?php echo form_dropdown('selected_hostname', $arr_dropdown_hostname, $selected_hostname, 'class="form-select opsi_txt" id="selected_hostname" required');?>
					<div class="invalid-feedback">Please enter the value.</div>
				  </div>
				  <div class="col-sm-4">
					<?php echo form_dropdown('selected_manifest', $arr_dropdown_manifest, $selected_manifest, 'class="form-select opsi_txt" id="selected_manifest" required');?>
					<div class="invalid-feedback">Please enter the value.</div>
				  </div>
				</div>
				<div class="row mb-3">
					<div class="col-sm-6">
					<p><b>BEFORE :</b></p>
					</div>
					<div class="col-sm-6">
					<p><b>AFTER :</b></p>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-sm-6">
					<p><?php echo $arr_compare['before']['capture_start_time'];?></p>
					<p><?php echo isset($arr_compare['before']['detail'][0]['location'])?$arr_compare['before']['detail'][0]['location']:'Capture Before tidak tersedia';?></p>
					</div>
					<div class="col-sm-6">
					<p><?php echo $arr_compare['after']['capture_start_time'];?></p>
					<p><?php echo isset($arr_compare['after']['detail'][0]['location'])?$arr_compare['after']['detail'][0]['location']:'Capture After tidak tersedia'; ?></p>
					</div>
				</div>
			  </form>
			  </div>
			  <div class="card-body" id="div_compare_result"></div>
	  </div>
	</div>
	
</div>

	


<script type="text/javascript">


$(document).ready(function(){
	$('.opsi_txt').change(function(){
		$.ajax({
			type : "POST",
			url  : "<?=site_url('Qlola/compare_micro_result');?>",
			data : $('#compare_result_form').serialize()+"&flag=compare",
			beforeSend:function(){
				//$('#ajax-loader').show();
				$('#compare_btn').attr("disabled","disabled");
				$('#compare_btn').text('Loading...');
				$('#compare_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
			},
			error: function(){
				//$('#ajax-loader').hide();
				$('#compare_btn').removeAttr("disabled");
				$('#compare_btn').text("Compare");
				$('#compare_btn').prepend('<span class="bx bx-git-compare" style="margin-right:5px;"></span>');
				alert('Error, Terjadi gagal sistem.');
			},
			success: function(data){
				//$('#ajax-loader').hide();
				$('#compare_btn').removeAttr("disabled");
				$('#compare_btn').text("Compare");
				$('#compare_btn').prepend('<span class="bx bx-git-compare" style="margin-right:5px;"></span>');
				$('#form_result').html(data);
			}
		});
		return false;
	});
	
	let diffSummaryString = `<?php foreach($diff_string_summary as $d) {echo '<div class="row">'.$d.'</div>';}?>`;
	let diffString = `<?php foreach($diff_string as $d) {echo $d.PHP_EOL;}?>`;
	
	if(!diffSummaryString){
		$('#div_compare_summary_result').html('<div class="alert alert-success text-center" role="alert"><strong>Summary : Tidak Terdapat Perubahan</strong></div>');
	}else{
		$('#div_compare_summary_result').html(diffSummaryString);
	}
	
	if (!diffString) {
	
		$('#div_compare_result').html('<div class="alert alert-success text-center" role="alert"><strong>Tidak Terdapat Perubahan</strong></div>');
	
	} else {
	
	//document.addEventListener('DOMContentLoaded', function () {
      var targetElement = document.getElementById('div_compare_result');
      var configuration = {
        drawFileList: false,
        fileListToggle: false,
        fileListStartVisible: false,
        fileContentToggle: false,
        matching: 'lines',
        outputFormat: 'side-by-side',
        synchronisedScroll: true,
        highlight: true,
        renderNothingWhenEmpty: false,
      };
      var diff2htmlUi = new Diff2HtmlUI(targetElement, diffString, configuration);
      diff2htmlUi.draw();
      diff2htmlUi.highlightCode();
    //});
	};
});
</script>
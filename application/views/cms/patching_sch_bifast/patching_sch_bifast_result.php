<?php 
	$sch_active = 0;
	$sch_not_active = 0;
	if(isset($sch_not_update)){
		foreach($sch_not_update as $key => $d){
			if($d->restartstatus == 1){$sch_active += 1;}
			if($d->restartstatus == 3){$sch_active += 1;}
			if($d->restartstatus == 4){$sch_not_active += 1;}
			if($d->restartstatus == 5){$sch_not_active += 1;}
		}
	}
?>
<div class="card mb-3">
	<div class="card-body">
	<h5 class="card-title">SCH BIFAST ALL</h5>
	  <form id="close_bifast" class="row g-3 needs-validation" action="" method="post" novalidate>
		<div class="col-12">
		  <button class="btn btn-primary w-100" type="submit" id="close_bifast_btn" <?php if($sch_not_active == 9){ echo 'disabled'; } ?> style = "background-color : #EC2E5D">
			CMS - CLOSE BIFAST ALL
		  </button>
		</div>
	  </form>

	</div>
	
	<div class="card-body">

	  <form id="open_bifast" class="row g-3 needs-validation" action="" method="post" novalidate>
		<div class="col-12">
		  <button class="btn btn-primary w-100" type="submit" id="open_bifast_btn" <?php if($sch_active == 9){ echo 'disabled'; } ?> style = "background-color : #54B972">
			CMS - OPEN BIFAST ALL
		  </button>
		</div>
	  </form>

	</div>
	
	<div class="card-body">
	  <h5 class="card-title">SCH BIFAST Manual</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm" id="tbl_result">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">SCH ID</th>
			<th scope="col">SCH CODE</th>
			<th scope="col">FID</th>
			<th scope="col">FITUR</th>
			<th scope="col">SERVERID</th>
			<th scope="col">PATH</th>
			<th scope="col">LASTUPDATE</th>
			<th scope="col">SCHSTATUS</th>
			<th scope="col">Action</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($sch_not_update)){
					foreach($sch_not_update as $key => $d){
						?>
						<tr>
							<th scope="row"><small><?php echo ($key+1);?></small></th>
							<td><small><?php echo $d->id;?></small></td>
							<td><small><?php echo $d->schcode;?></small></td>
							<td><small><?php echo $d->fid;?></small></td>
							<td><small><?php echo $d->fitur;?></small></td>
							<td><small><?php echo $d->serverid;?></small></td>
							<td><small><?php echo $d->path;?></small></td>
							<td><small><?php echo $d->lastupdate;?></small></td>
							<td><small><?php 
								if($d->restartstatus == 1){
									echo "Restart OnProcess";
								}
								if($d->restartstatus == 3){
									echo "Active";
								}
								if($d->restartstatus == 4){
									echo "Shutdown OnProcess";
								}
								if($d->restartstatus == 5){
									echo "Inactive";
								}
								?></small></td>
							<td><button class="btn btn-primary btn_sch" type="submit" idsch="<?php echo $d->id;?>" sch_type="Restart" id="restart_sch_<?php echo $d->id;?>">Restart</button></td>
							<td><button class="btn btn-danger btn_sch" type="submit" idsch="<?php echo $d->id;?>" sch_type="Shutdown" id="shutdown_sch_<?php echo $d->id;?>">Shutdown</button></td>
						</tr>
						<?php
					}
				}
			?>
		</tbody>
	  </table>
	  </div>
	  <!-- End Table with stripped rows -->

	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('.btn_sch').click(function(){
		var mydata = "idsch="+$(this).attr("idsch")+"&sch_type="+$(this).attr("sch_type");
		var schtype = $(this).attr("sch_type");
		var btn = $(this);
		if (confirm("Apakah ingin melakukan "+schtype+" Scheduler ini?")) {
			$.ajax({
				type : "POST",
				url  : "<?=site_url('Cms/update_sch');?>",
				data : mydata,
				beforeSend:function(){
					//$('#ajax-loader').show();
					$('.btn_sch').attr("disabled","disabled");
					btn.text('Loading...');
					btn.prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
				},
				error: function(){
					//$('#ajax-loader').hide();
					window.setTimeout(function(){
						$('.btn_sch').removeAttr("disabled");
						btn.text(sch_type);
						alert('Error, Terjadi gagal sistem.');
						$("#refresh").trigger('click');
					}, 1000);
				},
				success: function(data){
					//$('#ajax-loader').hide();
					window.setTimeout(function(){
						$('.btn_sch').removeAttr("disabled");
						btn.text(schtype);
						alert(data);
						$("#refresh").trigger('click');
					}, 1000);
				}
			});
		}
		
		return false;
		
	});
	
	$('#close_bifast').submit(function(){
		if (confirm("Apakah anda yakin ingin menutup semua scheduler bifast CMS?")) {
			$.ajax({
				type : "POST",
				url  : "<?=site_url('Cms/close_bifast_all');?>",
				data : $(this).serialize(),
				beforeSend:function(){
					//$('#ajax-loader').show();
					$('#close_bifast_btn').attr("disabled","disabled");
					$('#close_bifast_btn').text('Loading...');
					$('#close_bifast_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
				},
				error: function(){
					//$('#ajax-loader').hide();
					$('#close_bifast_btn').removeAttr("disabled");
					$('#close_bifast_btn').text("CMS - CLOSE BIFAST ALL");
					alert('Error, Terjadi gagal sistem.');
				},
				success: function(data){
					//$('#ajax-loader').hide();
					$('#close_bifast_btn').removeAttr("disabled");
					$('#close_bifast_btn').text("CMS - CLOSE BIFAST ALL");
					//$('#form_result').html(data);
				}
			});
			$("#search_data_sch_bifast").trigger('submit');
		}
		return false;
	});
	$('#open_bifast').submit(function(){
		if (confirm("Apakah anda yakin ingin membuka semua scheduler bifast CMS?")) {
			$.ajax({
				type : "POST",
				url  : "<?=site_url('Cms/open_bifast_all');?>",
				data : $(this).serialize(),
				beforeSend:function(){
					//$('#ajax-loader').show();
					$('#open_bifast_btn').attr("disabled","disabled");
					$('#open_bifast_btn').text('Loading...');
					$('#open_bifast_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
				},
				error: function(){
					//$('#ajax-loader').hide();
					$('#open_bifast_btn').removeAttr("disabled");
					$('#open_bifast_btn').text("CMS - OPEN BIFAST ALL");
					alert('Error, Terjadi gagal sistem.');
				},
				success: function(data){
					//$('#ajax-loader').hide();
					$('#open_bifast_btn').removeAttr("disabled");
					$('#open_bifast_btn').text("CMS - OPEN BIFAST ALL");
					//$('#form_result').html(data);
				}
			});
			$("#search_data_sch_bifast").trigger('submit');
		}
		return false;
	});
	
});
</script>

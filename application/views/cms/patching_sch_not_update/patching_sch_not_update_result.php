<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">Corporate Profile</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
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
		return false;
		
	});
	
});
</script>

<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">BRIMO - Ibank.tbl_parameters</h5>
	  
	  <body onLoad="scrollToSpesificRow();">
	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>	
		  <tr>
			<th scope="col">#</th>
			<th scope="col">id</th>
			<th scope="col">feature_flag</th>
			<th scope="col">Action</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($data_parameter_mnv)){
					foreach($data_parameter_mnv as $key => $d){
						if($d->feature_flag == true ){
							$text_btn = "Buka"; 
							$button_color = "blue";
						} else {
							$text_btn = "Tutup";
							$button_color = "red";
						}
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->id;?></td>
							<td><?php echo $d->feature_flag;?></td>
							<td>
								<button disabled type="button" style = "background-color : <?php echo $button_color;?>; border-color : <?php echo $button_color;?>" class="btn btn-primary btn-sm btn_run" id = <?php  echo $d->id;?> >
									<?php echo $text_btn;?>
								</button>
							</td>
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
	$('.btn_run').click(function(){
		var this_elem = $(this);
		$.ajax({
			type : "POST",
			url  : "<?=site_url('Brimo/buka_tutup_trfonline_satuan');?>",
			data : 'id='+this_elem.attr('id'),
			beforeSend:function(){
				javascript:return confirm('Apakah yakin buka parameter ' +this_elem.attr('id')+ ' dibuka / ditutup?');
			},
			error: function(){
				//$('#ajax-loader').hide();
				alert('Error, Terjadi gagal sistem.');
			},
			success: function(data){
				//$('#ajax-loader').hide();
				$('#refresh_user_btn').html(data);
				$('#refresh_user_btn').click();
			}
		});
		return false;
	});
});
</script>


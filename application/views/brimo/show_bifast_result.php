<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">Delete Redis tbl_bank:ALL</h5>

	</div>
</div>
<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">BRIMO - All BANK</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">bank_code</th>
			<th scope="col">bank_name</th>
			<th scope="col">bank_alias</th>
			<th scope="col">bank_order</th>
			<th scope="col">bank_swift_code</th>
			<th scope="col">is_bifast</th>
			<th scope="col">Action</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($data_tbl_bank)){
					foreach($data_tbl_bank as $key => $d){
						if($d->is_bifast == 1){
							$text_btn = "Terbuka"; 
							$button_color = "blue";
							} else if ($d->is_bifast == 0){
								$text_btn = "Tertutup";
								$button_color = "red";
							}
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->bank_code;?></td>
							<td><?php echo $d->bank_name;?></td>
							<td><?php echo $d->bank_alias;?></td>
							<td><?php echo $d->bank_order;?></td>
							<td><?php echo $d->bank_swift_code;?></td>
							<td><?php echo $d->is_bifast;?></td>
							<td>
								<button type="button" style = "background-color : <?php echo $button_color;?>; border-color : <?php echo $button_color;?>" class="btn btn-primary btn-sm btn_run" id = <?php  echo $d->bank_code;?> bank_code = <?php echo $d->bank_code;?> >
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
			url  : "<?=site_url('Brimo/buka_tutup_bifast_satuan');?>",
			data : 'bank_code='+this_elem.attr('bank_code'),
			beforeSend:function(){
				javascript:return confirm('Apakah yakin kode Bank ' +this_elem.attr('bank_code')+ ' dibuka / ditutup?');
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


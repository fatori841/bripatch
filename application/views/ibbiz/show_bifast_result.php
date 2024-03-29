<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">IBBIZ - BANK BI FAST</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">ID</th>
			<th scope="col">NAMA</th>
			<th scope="col">ADDRESS1</th>
			<th scope="col">BANKCODE</th>
			<th scope="col">STATUS</th>
			<th scope="col">ORDER</th>
			<th scope="col">Action</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($data_tbl_bankbifast)){
					foreach($data_tbl_bankbifast as $key => $d){
						if($d->STATUS == 1){
							$text_btn = "Terbuka"; 
							$button_color = "blue";
							} else if ($d->STATUS == 0){
								$text_btn = "Tertutup";
								$button_color = "red";
							}
						?>
						<tr>
							<td><?php echo $d->ID;?></td>
							<td><?php echo $d->NAMA;?></td>
							<td><?php echo $d->ADDRESS1;?></td>
							<td><?php echo $d->BANKCODE;?></td>
							<td><?php echo $d->STATUS;?></td>
							<td><?php echo $d->ORDER;?></td>
							<td>
								<button type="button" style = "background-color : <?php echo $button_color;?>; border-color : <?php echo $button_color;?>" class="btn btn-primary btn-sm btn_run" id = <?php  echo $d->BANKCODE;?> BANKCODE = <?php echo $d->BANKCODE;?> >
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
			url  : "<?=site_url('Ibbiz/buka_tutup_bifast_satuan');?>",
			data : 'BANKCODE='+this_elem.attr('BANKCODE'),
			beforeSend:function(){
				//$('#ajax-loader').show();
				javascript:return confirm('Apakah yakin Kode Bank ' +this_elem.attr('BANKCODE')+ ' dibuka / ditutup?');
			},
			error: function(){
				//$('#ajax-loader').hide();
				alert('Error, Terjadi gagal sistem.');
			},
			success: function(data){
				//$('#ajax-loader').hide();
				$('#refresh_user_btn').html(data);
				$('#refresh_user_btn').click();
				if(window.confirm("Apakah brimo dibuka / ditutup juga?")){
					window.location.href = "../brimo/show_bifast_v3";
				}
			}
		});
		return false;
	});
});
</script>


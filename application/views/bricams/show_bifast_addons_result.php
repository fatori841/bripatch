<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">Bricams Addons - All BANK</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">CODE</th>
			<th scope="col">NAMA</th>
			<th scope="col">BANKCODE</th>
			<th scope="col">ISBIFASTSUSPEND</th>
			<th scope="col">Action</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($data_md_bankkliring)){
					foreach($data_md_bankkliring as $key => $d){
						if($d->ISBIFASTSUSPEND == "f"){
							$text_btn = "Terbuka"; 
							$button_color = "blue";
							$status = "NO";
							} else if ($d->ISBIFASTSUSPEND == "t"){
								$text_btn = "Tertutup";
								$button_color = "red";
								$status = "YES";
							}
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->CODE;?></td>
							<td><?php echo $d->NAMA;?></td>
							<td><?php echo $d->BANKCODE;?></td>
							<td><?php echo $status;?></td>
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
			url  : "<?=site_url('Bricams/buka_tutup_bifast_satuan_addons');?>",
			data : 'BANKCODE='+this_elem.attr('BANKCODE'),
			beforeSend:function(){
				javascript:return confirm('Apakah yakin kode Bank ' +this_elem.attr('BANKCODE')+ ' dibuka / ditutup?');
			},
			error: function(){
				//$('#ajax-loader').hide();
				alert('Error, Terjadi gagal sistem.');
			},
			success: function(data){
				//$('#ajax-loader').hide();
				$('#refresh_user_btn').html(data);
				$('#refresh_user_btn').click();
				if(window.confirm("Apakah ibbiz dibuka / ditutup juga?")){
					window.location.href = "../ibbiz/show_bifast";
				}
			}
		});
		return false;
	});
});
</script>


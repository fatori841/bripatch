<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">Data Client Account</h5>

	  <!-- Table with stripped rows -->
	  <form id="patch_data_client_account" class="row g-3 needs-validation" action="" method="post" novalidate>
	  <div style="overflow-x:auto;">
	  <table class="table table-bordered table-sm">
		<tbody>
			<?php
				if(isset($client_account)){
					foreach($client_account as $key => $d){
						?>
						<tr>
							<td>ID</td>
							<td>
								<?php echo $d->ID;?>
							</td>
						</tr>
						<tr>
							<td>FID</td>
							<td><?php echo $d->FID;?></td>
						</tr>
						<tr>
							<td>TRXID</td>
							<td><?php echo $d->TRXID;?></td>
						</tr>
						<tr>
							<td>CREATIONDATE</td>
							<td><?php echo $d->CREATIONDATE;?></td>
						</tr>
						<tr>
							<td>JENISTRANSAKSI</td>
							<td><?php echo $d->JENISTRANSAKSI;?></td>
						</tr>
						<tr>
							<td>CLIENTID</td>
							<td><?php echo $d->JENISTRANSAKSI;?></td>
						</tr>
						<tr>
							<td>PAYMENTCODE</td>
							<td><input type="text" class="form-control" name="payment_txt" id="cardnum_account_txt" value=<?php echo $d->CARDNUM;?>></td>
						</tr>
						<tr>
							<td>DEBITACCOUNT</td>
							<td><?php echo $d->DEBITACCOUNT;?></td>
						</tr>
						<tr>
							<td>CREDITACCOUNT</td>
							<td><?php echo $d->CREDITACCOUNT;?></td>>></td>
						</tr>
						<tr>
							<td>AMOUNT</td>
							<td><?php echo $d->AMOUNT;?></td>
						</tr>
						<tr>
							<td>MAKER</td>
							<td><?php echo $d->STATUS;?></td>
						</tr>
						<tr>
							<td>SIGNER</td>
							<td><?php echo $d->DESCRIPTION;?></td>
						</tr>
						<tr>
							<td>TRXDATE</td>
							<td><?php echo $d->TRXDATE;?></td>
						</tr>
						<tr>
							<td>LASTUPDATE</td>
							<td><?php echo $d->LASTUPDATE;?></td>
						</tr>
						<tr>
							<td>ESBEXTERNALID</td>
							<td><?php echo $d->ESBEXTERNALID;?></td>
						</tr>
						<tr>
							<td>ESBRESPONSMSG</td>
							<td><?php echo $d->ESBRESPONSMSG;?></td>
						</tr>
						<tr>
							<td>STATUS</td>
							<td><input type="text" class="form-control" name="payment_txt" id="status_txt" value=<?php echo $d->STATUS;?>></td>
						</tr>
						<tr>
							<td>DESCRIPTION</td>
							<td><input type="text" class="form-control" name="payment_txt" id="description_txt" value=<?php echo $d->DESCRIPTION;?>></td>
						</tr>
						<tr>
							<td>INFO13</td>
							<td><input type="text" class="form-control" name="payment_txt" id="info13_txt" value=<?php echo $d->INFO13;?>></td>
						</tr>
						<tr>
							<td colspan=2> 
								<?php 
									$disabled = '';
								?>
								<input class="form-check-input" type="checkbox" id="cekgreenscreen" <?php echo $disabled; ?>>
								<label class="form-check-label" for="cekgreenscreen"><b>&nbsp;&nbsp;Sudah dipastikan data sesuai.</b></label>
							</td>
						</tr>
						<tr>
							<td colspan=2>
								<button class="btn btn-primary" type="submit" style='background-color:grey;' id="do_pertamina_btn" disabled>SESUAIKAN</button>
							</td>
						</tr>
						<?php
					}
				}
			?>
		</tbody>
	  </table>
	  </form>
	  </div>
	  <!-- End Table with stripped rows -->

	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#patch_data_client_account').submit(function(){
		$.ajax({
			type : "POST",
			url  : "<?=site_url('Ibbiz/ubah_data_do_pertamina');?>",
			data : $(this).serialize(),
			beforeSend:function(){
				//$('#ajax-loader').show();
				$('#do_pertamina_btn').attr("disabled","disabled");
				$('#do_pertamina_btn').text('Loading...');
				$('#do_pertamina_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
			},
			error: function(){
				//$('#ajax-loader').hide();
				$('#do_pertamina_btn').removeAttr("disabled");
				$('#do_pertamina_btn').text("SESUAIKAN");
				alert('Error, Terjadi gagal sistem.');
			},
			success: function(data){
				//$('#ajax-loader').hide();
				$('#do_pertamina_btn').removeAttr("disabled");
				$('#do_pertamina_btn').text("SESUAIKAN");
				alert(data);
				$('#search_client_account_btn').trigger( "submit" );
			}
		});
		return false;
		
	});
	
	
	$('#cekgreenscreen').click(function(){

    if($(this).prop("checked") == true){

        $('#do_pertamina_btn').removeAttr('disabled');
		$('#do_pertamina_btn').removeAttr('style');

    }else if($(this).prop("checked") == false){

        $('#do_pertamina_btn').attr("disabled","disabled");
		$('#do_pertamina_btn').attr("style","background-color:grey;");

    }

});
});
</script>
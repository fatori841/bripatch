<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">Payment Stuck</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-bordered table-sm">
		<tbody>
			<?php
				if(isset($payment_stuck)){
					foreach($payment_stuck as $key => $d){
						?>
						<tr>
							<td>ID</td>
							<td><?php echo $d->ID;?></td>
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
							<td>JENISTRANSAKSI</td>
							<td><?php echo $d->JENISTRANSAKSI;?></td>
						</tr>
						<tr>
							<td>CREATIONDATE</td>
							<td><?php echo $d->CREATIONDATE;?></td>
						</tr>
						<tr>
							<td>CLIENTID</td>
							<td><?php echo $d->CLIENTID;?></td>
						</tr>
						<tr>
							<td>PAYMENTCODE</td>
							<td><?php echo $d->PAYMENTCODE;?></td>
						</tr>
						<tr>
							<td>DEBITACCOUNT</td>
							<td><?php echo $d->DEBITACCOUNT;?></td>
						</tr>
						<tr>
							<td>DEBITACCOUNTNAME</td>
							<td><?php echo $d->DEBITACCOUNTNAME;?></td>
						</tr>
						<tr>
							<td>CREDITACCOUNT</td>
							<td><?php echo $d->CREDITACCOUNT;?></td>
						</tr>
						<tr>
							<td>CREDITACCOUNTNAME</td>
							<td><?php echo $d->CREDITACCOUNTNAME;?></td>
						</tr>
						<tr>
							<td>CURRENCY</td>
							<td><?php echo $d->CURRENCY;?></td>
						</tr>
						<tr>
							<td>AMOUNT</td>
							<td><?php echo $d->AMOUNT;?></td>
						</tr>
						<tr>
							<td>TRXDATE</td>
							<td><?php echo $d->TRXDATE;?></td>
						</tr>
						<tr>
							<td>STATUS</td>
							<td><?php echo $d->STATUS;?></td>
						</tr>
						<tr>
							<td>DESCRIPTION</td>
							<td><?php echo $d->DESCRIPTION;?></td>
						</tr>
						<tr>
							<td>ESBEXTERNALID</td>
							<td><?php echo $d->ESBEXTERNALID;?></td>
						</tr>
						<tr>
							<td>ESBRESPONSEMSG</td>
							<td><?php echo $d->ESBRESPONSEMSG;?></td>
						</tr>
						<tr>
							<td colspan=2> 
								<?php 
									if ($d->ESBEXTERNALID == NULL && $d->CREDITACCOUNT == '' && $d->STATUS == 3){
										$disabled = '';
									}else{
										$disabled = 'disabled';
									}
								?>
								<input class="form-check-input" type="checkbox" id="cekdebet" <?php echo $disabled; ?>>
								<label class="form-check-label" for="cekdebet"><b>&nbsp;&nbsp;Sudah dipastikan tidak terdebet di rekening koran.</b></label>
							</td>
						</tr>
						<tr>
							<td colspan=2>
								<button class="btn btn-primary" type="button" style='background-color:grey;' id_ibbiz="<?php echo $d->ID; ?>" id="payment_stuck_btn" disabled>GAGALKAN</button>
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
	$('#payment_stuck_btn').click(function(){
		$.ajax({
			type : "POST",
			url  : "<?=site_url('Ibbiz/gagalkan_data_payment_stuck');?>",
			data : "idibbiz="+$(this).attr("id_ibbiz"),
			beforeSend:function(){
				//$('#ajax-loader').show();
				$('#payment_stuck_btn').attr("disabled","disabled");
				$('#payment_stuck_btn').text('Loading...');
				$('#payment_stuck_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
			},
			error: function(){
				//$('#ajax-loader').hide();
				$('#payment_stuck_btn').removeAttr("disabled");
				$('#payment_stuck_btn').text("GAGALKAN");
				alert('Error, Terjadi gagal sistem.');
			},
			success: function(data){
				//$('#ajax-loader').hide();
				$('#payment_stuck_btn').removeAttr("disabled");
				$('#payment_stuck_btn').text("GAGALKAN");
				alert(data);
				$('#search_payment_stuck_btn').trigger( "submit" );
			}
		});
		return false;
		
	});
	
	
	$('#cekdebet').click(function(){

    if($(this).prop("checked") == true){

        $('#payment_stuck_btn').removeAttr('disabled');
		$('#payment_stuck_btn').removeAttr('style');

    }else if($(this).prop("checked") == false){

        $('#payment_stuck_btn').attr("disabled","disabled");
		$('#payment_stuck_btn').attr("style","background-color:grey;");

    }

});
});
</script>
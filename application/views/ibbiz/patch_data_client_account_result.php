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
								<input type="hidden" class="form-control" name="id_account_txt" id="id_account_txt" value=<?php echo $d->ID; ?>>
							</td>
						</tr>
						<tr>
							<td>PID</td>
							<td><?php echo $d->PID;?></td>
						</tr>
						<tr>
							<td>LASTUPDATE</td>
							<td><?php echo $d->LASTUPDATE;?></td>
						</tr>
						<tr>
							<td>CODE</td>
							<td><?php echo $d->CODE;?></td>
						</tr>
						<tr>
							<td>ACCOUNT</td>
							<td><?php echo $d->ACCOUNT;?></td>
						</tr>
						<tr>
							<td>CARDNUM</td>
							<td><input type="text" class="form-control" name="cardnum_account_txt" id="cardnum_account_txt" value=<?php echo $d->CARDNUM;?>></td>
						</tr>
						<tr>
							<td>CURRENCY</td>
							<td><?php echo $d->CURRENCY;?></td>
						</tr>
						<tr>
							<td>TYPE</td>
							<td><input type="text" class="form-control" name="type_account_txt" id="type_account_txt" value=<?php echo $d->TYPE;?>></td>
						</tr>
						<tr>
							<td>CIF</td>
							<td><?php echo $d->CIF;?></td>
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
							<td colspan=2> 
								<?php 
									$disabled = '';
								?>
								<input class="form-check-input" type="checkbox" id="cekgreenscreen" <?php echo $disabled; ?>>
								<label class="form-check-label" for="cekgreenscreen"><b>&nbsp;&nbsp;Sudah dipastikan data sesuai dengan kondisi di Greenscreen.</b></label>
							</td>
						</tr>
						<tr>
							<td colspan=2>
								<button class="btn btn-primary" type="submit" style='background-color:grey;' id="client_account_btn" disabled>SESUAIKAN</button>
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
			url  : "<?=site_url('Ibbiz/ubah_data_client_account');?>",
			data : $(this).serialize(),
			beforeSend:function(){
				//$('#ajax-loader').show();
				$('#client_account_btn').attr("disabled","disabled");
				$('#client_account_btn').text('Loading...');
				$('#client_account_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
			},
			error: function(){
				//$('#ajax-loader').hide();
				$('#client_account_btn').removeAttr("disabled");
				$('#client_account_btn').text("SESUAIKAN");
				alert('Error, Terjadi gagal sistem.');
			},
			success: function(data){
				//$('#ajax-loader').hide();
				$('#client_account_btn').removeAttr("disabled");
				$('#client_account_btn').text("SESUAIKAN");
				alert(data);
				$('#search_client_account_btn').trigger( "submit" );
			}
		});
		return false;
		
	});
	
	
	$('#cekgreenscreen').click(function(){

    if($(this).prop("checked") == true){

        $('#client_account_btn').removeAttr('disabled');
		$('#client_account_btn').removeAttr('style');

    }else if($(this).prop("checked") == false){

        $('#client_account_btn').attr("disabled","disabled");
		$('#client_account_btn').attr("style","background-color:grey;");

    }

});
});
</script>
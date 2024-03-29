<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">Data User Account</h5>

	  <!-- Table with stripped rows -->
	  <form id="patch_data_user_account" class="row g-3 needs-validation" action="" method="post" novalidate>
	  <div style="overflow-x:auto;">
	  <table class="table table-bordered table-sm">
		<tbody>
			<?php
				if(isset($user_account)){
					foreach($user_account as $key => $d){
						?>
						<tr>
							<td>ID</td>
							<td>
								<?php echo $d->id;?>
								<input type="hidden" class="form-control" name="id_account_txt" id="id_account_txt" value=<?php echo $d->id; ?>>
							</td>
						</tr>
						<tr>
							<td>ACCOUNT</td>
							<td><?php echo $d->account;?></td>
						</tr>
						<tr>
							<td>ACCOUNT NAME</td>
							<td><input type="text" class="form-control" name="acc_name_field" id="account_name_field" value="<?php echo $d->account_name;?>" disabled></td>
						</tr>
						<tr>
							<td>TYPE ACCOUNT</td>
							<td><input type="text" class="form-control" name="acc_type_field" id="product_type_field" value="<?php echo $d->type_account;?>"></td>
						</tr>
						<tr>
							<td>PRODUCT TYPE</td>
							<td><input type="text" class="form-control" name="product_type_field" id="product_type_field" value="<?php echo $d->product_type;?>"></td>
						</tr>
						<tr>
							<td>CARD NUMBER</td>
							<td><input type="text" class="form-control" name="cardnum_field" id="cardnum_field" value=<?php echo $d->card_number;?>></td>
						</tr>
						<tr>
							<td>STATUS</td>
							<td><?php echo $d->status;?></td>
						</tr>
						<tr>
							<td>FINANSIAL STATUS</td>
							<td><?php echo $d->finansial_status;?></td>
						</tr>
						<tr>
							<td>DEFAULT</td>
							<td><?php echo $d->default;?></td>
						</tr>
						<tr>
							<td>SC CODE</td>
							<td><input type="text" class="form-control" name="sc_field" id="sc_field" value=<?php echo $d->sc_code;?>></td>
						</tr>
						<tr>
							<td colspan=2> 
								<?php 
									$disabled = '';
								?>
								<input class="form-check-input" type="checkbox" id="cekgreenscreen" <?php echo $disabled; ?>>
								<label class="form-check-label" for="cekgreenscreen"><b>&nbsp;&nbsp;Sudah dipastikan data sesuai dengan kondisi di BRINET dan FullCams.</b></label>
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
	$('#patch_data_user_account').submit(function(){
		if(confirm("Apakah kamu yakin?")){
			$.ajax({
				type : "POST",
				url  : "<?=site_url('Brimo/edit_data_user_account');?>",
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
		}
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
<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">User Profile</h5>
    
      <!-- Table with stripped rows -->
		<form id="patch_data_userprofile_cif" class="row g-3 needs-validation" action="" method="post" novalidate>  
			 <div style="overflow-x:auto;">
				<table class="table table-striped table-sm">
					<thead>
					  <tr>
						<th scope="col">#</th>
						<th scope="col">username</th>
						<th scope="col">name</th>
						<th scope="col">cif</th>
						<th scope="col">action</th>
					  </tr>
					</thead>
					<tbody>
						<?php
							if(isset($user_profile)){
								foreach($user_profile as $key => $d){
									?>
									<tr>
										<th scope="row"><?php echo ($key+1);?></th>
										<td>
											<?php echo $d->username;?>
											<input type="hidden" class="form-control" name="username_txt" id="username_txt" value="<?php echo $d->username;?>">                       
										</td>
										<td><?php echo $d->name;?></td>
										<td><input type="text" class="form-control" name="user_profile_cif_field" id="user_profile_cif_field" value="<?php echo $d->cif;?>"></td>
										<td colspan=2>
											<button class="btn btn-primary" type="submit" style='background-color:blue;' id="client_account_btn" >SESUAIKAN</button>
										</td>
									</tr>
									<?php
								}
							}
						?>
					</tbody>
			  </table>
			  </div>
		</form>
	  <!-- End Table with stripped rows -->

	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#patch_data_userprofile_cif').submit(function(){
		if(confirm("Apakah kamu yakin?")){
			$.ajax({
				type : "POST",
				url  : "<?=site_url('Brimo/edit_user_profile_cif');?>",
				data : $(this).serialize(),
				beforeSend:function(){
					//$('#ajax-loader').show();
					//$('#client_account_btn').attr("disabled","disabled");
					$('#client_account_btn').text('Loading...');
					$('#client_account_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
				},
				error: function(){
					//$('#ajax-loader').hide();
					//$('#client_account_btn').removeAttr("disabled");
					$('#client_account_btn').text("SESUAIKAN");
					alert('Error, Terjadi gagal sistem.');
				},
				success: function(data){
					//$('#ajax-loader').hide();
					//$('#client_account_btn').removeAttr("disabled");
					$('#client_account_btn').text("SESUAIKAN");
					alert(data);
					$('#search_client_account_btn').trigger( "submit" );
				}
			});
		}
		return false;
		
	});

});
</script>


<div class="card mb-3">
	<div class="card-body">
		<h5 class="card-title">User Deposito</h5>
      
      <!-- Table with stripped rows -->
		<div style="overflow-x:auto;">
			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">reference_num</th>
						<th scope="col">username</th>    
						<th scope="col">name</th>
						<th scope="col">account_deposito</th>
						<th scope="col">cif</th>
						<th scope="col">action</th>
					</tr>
				</thead>
				<tbody>	
					<?php if(isset($user_deposito)): ?>
						<?php foreach($user_deposito as $key => $d):?>
							<form  id="patch_data_userdeposito_cif_<?php echo $key; ?>" class="row g-3 needs-validation" action="" method="post" novalidate data-key="<?php echo $key; ?>">
								<tr>
									<th scope="row"><?php echo ($key+1); ?></th>
									<td>
										<?php echo $d->reference_num;?>
										<input type="hidden" class="form-control" name="reference_num_<?php echo $key; ?>" id="reference_num_<?php echo $key; ?>" value="<?php echo $d->reference_num;?>" disabled>
									</td>
									<td><?php echo $d->username; ?></td>
									<td><?php echo $d->name; ?></td>
									<td><?php echo $d->account_deposito; ?></td>
									<td>
										<input type="text" class="form-control" name="cif_<?php echo $key;?>" id="cif_<?php echo $key;?>" value="<?php echo $d->cif;?>">
									</td>
									<td colspan=2>
										<button class="btn btn-primary btn_sesuaikan" type="submit" style='background-color:blue' data-key="<?php echo $key; ?>"> SESUAIKAN</button>
									</td>		
								</tr>
							</form>
						<?php endforeach;?>	
					<?php endif; ?>
				</tbody>	
			</table>
		</div>
	</div>
</div>


<script type="text/javascript">
$(document).ready(function(){
	$('.btn_sesuaikan').click(function(){
		//event.preventDefault();
		if(confirm("Apakah kamu yakin?")){
			var key = $(this).data('key');
			var referenceNum = $('#reference_num_' + key).val();
			var cif = $('#cif_' + key).val();
 
			$.ajax({
				type : "POST",
				url  : "<?=site_url('Brimo/edit_user_deposito_cif');?>",
				data : {reference_num: referenceNum, cif: cif },
				beforeSend:function(){
					//$('#ajax-loader').show();
					//$('#client_account_btn').attr("disabled","disabled");
					$('#client_account_btn_' + key).text('Loading...');
					$('#client_account_btn_' + key).prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
				},
				error: function(){
					//$('#ajax-loader').hide();
					//$('#client_account_btn').removeAttr("disabled");
					$('#client_account_btn_' + key).text("SESUAIKAN");
					alert('Error, Terjadi gagal sistem.');
				},
				success: function(data){
					//$('#ajax-loader').hide();
					//$('#client_account_btn').removeAttr("disabled");
					$('#client_account_btn_' + key).text("SESUAIKAN");
					alert(data);
					$('#search_client_account_btn').trigger( "submit" );
				}
			});
		}
		return false;
	});
});
</script>
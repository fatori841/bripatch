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
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($user_profile)){
					foreach($user_profile as $key => $d){
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->username;?>
                                <input type="hidden" class="form-control" name="username_txt" id="username_txt" value=<?php echo $d->id; ?>>                        
                            </td>
							<td><?php echo $d->name;?></td>
							<td><input type="text" class="form-control" name="user-cif_field" id="user-cif_field" value="<?php echo $d->cif;?>"><</td>
						</tr>
                        <tr>
							<td colspan=2> 
								<?php 
									$disabled = '';
								?>
								<input class="form-check-input" type="checkbox" id="cekgreenscreen" <?php echo $disabled; ?>>
								<label class="form-check-label" for="cekgreenscreen"><b>&nbsp;&nbsp;Pastikan data sesuai dengan kondisi di BRINET dan FullCams.</b></label>
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
	  </div>
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


<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">User Deposito</h5>
      
      <!-- Table with stripped rows -->
	  <form id="patch_data_userdeposito_cif" class="row g-3 needs-validation" action="" method="post" novalidate>
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
            <th scope="col">username</th>    
            <th scope="col">name</th>
			<th scope="col">account_deposito</th>
			<th scope="col">cif</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($user_deposito)){
					foreach($user_deposito as $key => $d){
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->username;?>
                                <input type="hidden" class="form-control" name="username_dep_txt" id="username_dep_txt" value=<?php echo $d->username; ?>>
                            </td>
							<td><?php echo $d->name;?></td>
							<td><?php echo $d->account_deposito;?>
								<input type="hidden" class="form-control" name="acc_deposito_txt" id="acc_deposito_txt" value=<?php echo $d->account_deposito; ?>>	
							</td>
							<td><input type="text" class="form-control" name="user-cif_field_dep" id="user-cif_field_dep" value="<?php echo $d->cif;?>"><</td> 
						</tr>
                        <tr>
							<td colspan=2> 
								<?php 
									$disabled = '';
								?>
								<input class="form-check-input" type="checkbox" id="cekgreenscreen" <?php echo $disabled; ?>>
								<label class="form-check-label" for="cekgreenscreen"><b>&nbsp;&nbsp;Pastikan data sesuai dengan kondisi di BRINET dan FullCams.</b></label>
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
	  </div>
	  <!-- End Table with stripped rows -->

	</div>
</div>


<script type="text/javascript">
$(document).ready(function(){
	$('#patch_data_userdeposito_cif').submit(function(){
		if(confirm("Apakah kamu yakin?")){
			$.ajax({
				type : "POST",
				url  : "<?=site_url('Brimo/edit_user_deposito_cif');?>",
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
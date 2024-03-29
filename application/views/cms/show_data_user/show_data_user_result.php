<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">Corporate Profile</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">Corp ID</th>
			<th scope="col">Corp Handle</th>
			<th scope="col">Corp Name</th>
			<th scope="col">Corp Address</th>
			<th scope="col">Phone</th>
			<th scope="col">Email</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($client_profile)){
					foreach($client_profile as $key => $d){
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->id;?></td>
							<td><?php echo $d->handle;?></td>
							<td><?php echo $d->name;?></td>
							<td><?php echo $d->address_1;?></td>
							<td><?php echo $d->phone;?></td>
							<td><?php echo $d->contactperson_email;?></td>
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
<div class="card">
	<div class="card-body">
	  <h5 class="card-title">User Profile</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">User ID</th>
			<th scope="col">User Handle</th>
			<th scope="col">First Name</th>
			<th scope="col">Last Name</th>
			<th scope="col">Email</th>
			<th scope="col">Last Logon</th>
			<th scope="col">Last Logout</th>
			<th scope="col">Logged</th>
			<th scope="col">Login Status</th>
			<?php 
				if(isset($search_type)){
					echo ($search_type == 'patching')? '<th scope="col">Action</th>':''; 
				}
			?>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($user_profile)){
					foreach($user_profile as $key => $d){
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->id;?></td>
							<td><?php echo $d->handle;?></td>
							<td><?php echo $d->firstname;?></td>
							<td><?php echo $d->lastname;?></td>
							<td><?php echo $d->email;?></td>
							<td><?php echo $d->lastlogon;?></td>
							<td><?php echo $d->lastlogout;?></td>
							<td><?php echo $d->logged;?></td>
							<td><?php echo ($d->logged == '1')?'Online':'Offline' ?></td>
							<?php 
								if(isset($search_type)){
									if ($search_type == 'patching')
									{
										echo ($d->logged == '1')? '<td><button class="btn btn-primary" type="submit" id_cms="'.$d->id.'" id="clear_session_btn">Clear Session</button></td>':'<td><button  class="btn btn-primary" id_cms="'.$d->id.'" disabled type="submit" id="clear_session_btn">Clear Session</button></td>';
									}
								}
							?>
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
<?php 
	if(isset($search_type)){
		if ($search_type == 'patching')
		{
			?>
				<script type="text/javascript">
				$(document).ready(function(){
					$('#clear_session_btn').click(function(){
						$.ajax({
							type : "POST",
							url  : "<?=site_url('Cms/update_clear_session');?>",
							data : "idcms="+$(this).attr("id_cms"),
							beforeSend:function(){
								//$('#ajax-loader').show();
								$('#clear_session_btn').attr("disabled","disabled");
								$('#clear_session_btn').text('Loading...');
								$('#clear_session_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
							},
							error: function(){
								//$('#ajax-loader').hide();
								$('#clear_session_btn').removeAttr("disabled");
								$('#clear_session_btn').text("Clear Session");
								alert('Error, Terjadi gagal sistem.');
							},
							success: function(data){
								//$('#ajax-loader').hide();
								$('#clear_session_btn').removeAttr("disabled");
								$('#clear_session_btn').text("Clear Session");
								alert(data);
								$('#search_data_user').trigger( "submit" );
							}
						});
						return false;
						
					});
				});
				</script>

			<?php
		}
	}
?>

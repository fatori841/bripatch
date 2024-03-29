<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">Client Data</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">ID</th>
			<th scope="col">HANDLE</th>
			<th scope="col">ALIAS</th>
			<th scope="col">NAME</th>
			<th scope="col">CREATEDDATE</th>
			<th scope="col">LASTUPDATE</th>
			<th scope="col">CIF</th>
			<th scope="col">CARDNUM</th>
			<th scope="col">ACCOUNT</th>
			<th scope="col">REFNUM</th>
			<th scope="col">CHECKERTOTAL</th>
			<th scope="col">SIGNERTOTAL</th>
			<th scope="col">STATUS</th>
			<th scope="col">DESCRIPTION</th>
			<th scope="col">REGEXPIRYDATE</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($client)){
					foreach($client as $key => $d){
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->ID;?></td>
							<td><?php echo $d->HANDLE;?></td>
							<td><?php echo $d->ALIAS;?></td>
							<td><?php echo $d->NAME;?></td>
							<td><?php echo $d->CREATEDDATE;?></td>
							<td><?php echo $d->LASTUPDATE;?></td>
							<td><?php echo $d->CIF;?></td>
							<td><?php echo $d->CARDNUM;?></td>
							<td><?php echo $d->ACCOUNT;?></td>
							<td><?php echo $d->REFNUM;?></td>
							<td><?php echo $d->CHECKERTOTAL;?></td>
							<td><?php echo $d->SIGNERTOTAL;?></td>
							<td><?php echo $d->STATUS;?></td>
							<td><?php echo $d->DESCRIPTION;?></td>
							<td><?php echo $d->REGEXPIRYDATE;?></td>
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
<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">Client Account</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">PID</th>
			<th scope="col">LASTUPDATE</th>
			<th scope="col">CODE</th>
			<th scope="col">ACCOUNT</th>
			<th scope="col">CARDNUM</th>
			<th scope="col">CURRENCY</th>
			<th scope="col">TYPE</th>
			<th scope="col">CIF</th>
			<th scope="col">STATUS</th>
			<th scope="col">DESCRIPTION</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($clientaccount)){
					foreach($clientaccount as $key => $d){
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->PID;?></td>
							<td><?php echo $d->LASTUPDATE;?></td>
							<td><?php echo $d->CODE;?></td>
							<td><?php echo $d->ACCOUNT;?></td>
							<td><?php echo $d->CARDNUM;?></td>
							<td><?php echo $d->CURRENCY;?></td>
							<td><?php echo $d->TYPE;?></td>
							<td><?php echo $d->CIF;?></td>
							<td><?php echo $d->STATUS;?></td>
							<td><?php echo $d->DESCRIPTION;?></td>
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
<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">User Data</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">ID</th>
			<th scope="col">HANDLE</th>
			<th scope="col">NAME</th>
			<th scope="col">CREATEDDATE</th>
			<th scope="col">LASTUPDATE</th>
			<th scope="col">EMAIL</th>
			<th scope="col">HANDPHONE</th>
			<th scope="col">LASTLOGIN</th>
			<th scope="col">LASTLOGOUT</th>
			<th scope="col">WRGPASSWORD</th>
			<th scope="col">LOGIN</th>
			<th scope="col">STATUS</th>
			<th scope="col">DESCRIPTION</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($user)){
					foreach($user as $key => $d){
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->ID;?></td>
							<td><?php echo $d->HANDLE;?></td>
							<td><?php echo $d->NAME;?></td>
							<td><?php echo $d->CREATEDDATE;?></td>
							<td><?php echo $d->LASTUPDATE;?></td>
							<td><?php echo $d->EMAIL;?></td>
							<td><?php echo $d->HANDPHONE;?></td>
							<td><?php echo $d->LASTLOGIN;?></td>
							<td><?php echo $d->LASTLOGOUT;?></td>
							<td><?php echo $d->WRGPASSWORD;?></td>
							<td><?php echo $d->LOGIN;?></td>
							<td><?php echo $d->STATUS;?></td>
							<td><?php echo $d->DESCRIPTION;?></td>
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

<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">Client Account Matrix</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">ID</th>
			<th scope="col">CLIENTID</th>
			<th scope="col">USERID</th>
			<th scope="col">HANDLE</th>
			<th scope="col">ACCOUNT</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($client_account_matrix)){
					foreach($client_account_matrix as $key => $d){
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->ID;?></td>
							<td><?php echo $d->CLIENTID;?></td>
							<td><?php echo $d->USERID;?></td>
							<td><?php echo $d->HANDLE;?></td>
							<td><?php echo $d->ACCOUNT;?></td>
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
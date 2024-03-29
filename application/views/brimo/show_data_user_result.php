<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">User Data</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">username</th>
			<th scope="col">user_alias</th>
			<th scope="col">registered_date</th>
			<th scope="col">approved_by</th>
			<th scope="col">status</th>
			<th scope="col">login_status</th>
			<th scope="col">last_login</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($user_alias)){
					foreach($user_alias as $key => $d){
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->username;?></td>
							<td><?php echo $d->user_alias;?></td>
							<td><?php echo $d->registered_date;?></td>
							<td><?php echo $d->approved_by;?></td>
							<td><?php echo $d->status;?></td>
							<td><?php echo $d->login_status;?></td>
							<td><?php echo $d->last_login;?></td>
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
	  <h5 class="card-title">User Profile</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">name</th>
			<th scope="col">cellphone_number</th>
			<th scope="col">email_address</th>
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
							<td><?php echo $d->name;?></td>
							<td><?php echo $d->cellphone_number;?></td>
							<td><?php echo $d->email_address;?></td>
							<td><?php echo $d->cif;?></td>
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
	  <h5 class="card-title">User Account</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">account</th>
			<th scope="col">account_name</th>
			<th scope="col">type_account</th>
			<th scope="col">product_type</th>
			<th scope="col">currency</th>
			<th scope="col">card_number</th>
			<th scope="col">status</th>
			<th scope="col">finansial_status</th>
			<th scope="col">default</th>
			<th scope="col">sc_code</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($user_account)){
					foreach($user_account as $key => $d){
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->account;?></td>
							<td><?php echo $d->account_name;?></td>
							<td><?php echo $d->type_account;?></td>
							<td><?php echo $d->product_type;?></td>
							<td><?php echo $d->currency;?></td>
							<td><?php echo $d->card_number;?></td>
							<td><?php echo $d->status;?></td>
							<td><?php echo $d->finansial_status;?></td>
							<td><?php echo $d->default;?></td>
							<td><?php echo $d->sc_code;?></td>
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
	  <h5 class="card-title">User Deposito</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">main_account</th>
			<th scope="col">account_debet</th>
			<th scope="col">account_deposito</th>
			<th scope="col">amount</th>
			<th scope="col">currency</th>
			<th scope="col">period</th>
			<th scope="col">publish_date</th>
			<th scope="col">maturity_date</th>
			<th scope="col">deposit_type</th>
			<th scope="col">status</th>
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
							<td><?php echo $d->main_account;?></td>
							<td><?php echo $d->account_debet;?></td>
							<td><?php echo $d->account_deposito;?></td>
							<td><?php echo $d->amount;?></td>
							<td><?php echo $d->currency;?></td>
							<td><?php echo $d->period;?></td>
							<td><?php echo $d->publish_date;?></td>
							<td><?php echo $d->maturity_date;?></td>
							<td><?php echo $d->deposit_type;?></td>
							<td><?php echo $d->status;?></td>
							<td><?php echo $d->cif;?></td>
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
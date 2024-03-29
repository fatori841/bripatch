<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">1. DB IB HA ( ibank ) tabel tbl_user & tbl_user_alias </h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">username</th>
			<th scope="col">user_alias</th>
			<th scope="col">registered_date</th>
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
	  <h5 class="card-title">2. DB IB HA ( ibank ) tabel tbl_user_account</h5>

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
	  <h5 class="card-title">3. DB IB HA ( ibank ) tabel tbl_user_profile</h5>

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
	  <h5 class="card-title">4. DB IB HA ( ibank ) tabel tbl_user_mnt_log</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">username</th>
			<th scope="col">activity</th>
			<th scope="col">remarks</th>
			<th scope="col">edit_by</th>
			<th scope="col">edit_date</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($user_mnt_log)){
					foreach($user_mnt_log as $key => $d){
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->username;?></td>
							<td><?php echo $d->activity;?></td>
							<td><?php echo $d->remarks;?></td>
							<td><?php echo $d->edit_by;?></td>
							<td><?php echo $d->edit_date;?></td>
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
	  <h5 class="card-title">5. DB IB HA ( ibank ) tabel tbl_user_account_mnt_log</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">username</th>
			<th scope="col">activity</th>
			<th scope="col">remarks</th>
			<th scope="col">edit_by</th>
			<th scope="col">edit_date</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($user_account_mnt_log)){
					foreach($user_account_mnt_log as $key => $d){
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->username;?></td>
							<td><?php echo $d->activity;?></td>
							<td><?php echo $d->remarks;?></td>
							<td><?php echo $d->edit_by;?></td>
							<td><?php echo $d->edit_date;?></td>
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
	  <h5 class="card-title">6. DB IB HA ( ibank ) tabel tbl_user_profile_mnt_log</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">username</th>
			<th scope="col">activity</th>
			<th scope="col">remarks</th>
			<th scope="col">edit_by</th>
			<th scope="col">edit_date</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($user_profile_mnt_log)){
					foreach($user_profile_mnt_log as $key => $d){
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->username;?></td>
							<td><?php echo $d->activity;?></td>
							<td><?php echo $d->remarks;?></td>
							<td><?php echo $d->edit_by;?></td>
							<td><?php echo $d->edit_date;?></td>
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
	  <h5 class="card-title">7. DB Livik ( ibank_brimo ) tbl_brimo_activation </h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">username</th>
			<th scope="col">status</th>
			<th scope="col">device_id</th>
			<th scope="col">activation_date</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($livik_brimo_activation)){
					if(is_array($livik_brimo_activation)){
						foreach($livik_brimo_activation as $key => $d){
							?>
							<tr>
								<th scope="row"><?php echo ($key+1);?></th>
								<td><?php echo $d->username;?></td>
								<td><?php echo $d->status;?></td>
								<td><?php echo $d->device_id;?></td>
								<td><?php echo $d->activation_date;?></td>
							</tr>
							<?php
						}
					} else {
						?>
						<tr>
							<td colspan = "5" align = "center"> <?php echo $livik_brimo_activation; ?> </td>
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
	  <h5 class="card-title">8. DB Livik ( ibank_brimo ) tbl_brimo_activation_mnt_log </h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">username</th>
			<th scope="col">status</th>
			<th scope="col">device_id</th>
			<th scope="col">activation_date</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($livik_brimo_activation_mnt_log)){
					if(is_array($livik_brimo_activation_mnt_log)){
						foreach($livik_brimo_activation_mnt_log as $key => $d){
							?>
							<tr>
								<th scope="row"><?php echo ($key+1);?></th>
								<td><?php echo $d->username;?></td>
								<td><?php echo $d->status;?></td>
								<td><?php echo $d->device_id;?></td>
								<td><?php echo $d->activation_date;?></td>
							</tr>
							<?php
						}
					} else {
						?>
						<tr>
							<td colspan = "5" align = "center"> <?php echo $livik_brimo_activation_mnt_log; ?> </td>
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
	  <h5 class="card-title">9. DB IB HA ( ibank ) tabel tbl_user_safety_mode </h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">username</th>
			<th scope="col">start</th>
			<th scope="col">status</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($user_safety_mode)){
					if(count($user_safety_mode) > 0){
						foreach($user_safety_mode as $key => $d){
							?>
							<tr>
								<th scope="row"><?php echo ($key+1);?></th>
								<td><?php echo $d->username;?></td>
								<td><?php echo $d->start;?></td>
								<td><?php echo $d->status;?></td>
							</tr>
							<?php
						}
					} else {
						?>
						<tr>
							<td colspan = "4" align = "center"> No Data </td>
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
	  <h5 class="card-title">10. DB notif ( RCO ) by number HP atau email. Konfirmasi RCO</h5>
	</div>
</div>

<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">11. Log transaksi DB IB HA ( ibank ) tbl_trx_log (Start Date & End Date Required) </h5>

	  <!-- Table with stripped rows -->
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">username</th>
			<th scope="col">account</th>
			<th scope="col">trx_type</th>
			<th scope="col">reference_num</th>
			<th scope="col">trx_status</th>
			<th scope="col">trx_date</th>
			<th scope="col">agent</th>
			<th scope="col">trx_object</th>
		  </tr>
		</thead>
		<tbody>			
			<?php
				if(isset($log_transaksi)){
					$count = 0;
					foreach($log_transaksi as $keys){
						foreach($keys as $key => $d){
							$count = $count + 1;
							?>
							<tr>
								<th scope="row"><?php echo ($count);?></th>
								<td><?php echo $d->username;?></td>
								<td><?php echo $d->account;?></td>
								<td><?php echo $d->trx_type;?></td>
								<td><?php echo $d->reference_num;?></td>
								<td><?php echo $d->trx_status;?></td>
								<td><?php echo $d->trx_date;?></td>
								<td><?php echo $d->agent;?></td>
								<td><?php echo $d->trx_object;?></td>
							</tr>
							<?php
						}
					}
					
				}
			?>
		</tbody>
	  </table>
	  <!-- End Table with stripped rows -->

	</div>
</div>
<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">12. Log transaksi DB IB HA ( ibank ) tbl_trx_transfer (Start Date & End Date Required) </h5>

	  <!-- Table with stripped rows -->
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">reference_num</th>
			<th scope="col">transfer_type</th>
			<th scope="col">status</th>
			<th scope="col">account</th>
			<th scope="col">account_destination</th>
			<th scope="col">account_name_destination</th>
			<th scope="col">amount</th>
			<th scope="col">trx_date</th>
			<th scope="col">bank_destination</th>
			<th scope="col">trx_schedule_type</th>
			<th scope="col">account_type</th>
		  </tr>
		</thead>
		<tbody>			
			<?php
				if(isset($transfer_transaksi)){
					$count = 0;
					foreach($transfer_transaksi as $keys){
						foreach($keys as $key => $d){
							$count = $count + 1;
							?>
							<tr>
								<th scope="row"><?php echo ($count);?></th>
								<td><?php echo $d->reference_num;?></td>
								<td><?php echo $d->transfer_type;?></td>
								<td><?php echo $d->status;?></td>
								<td><?php echo $d->account;?></td>
								<td><?php echo $d->account_destination;?></td>
								<td><?php echo $d->account_name_destination;?></td>
								<td><?php echo $d->amount;?></td>
								<td><?php echo $d->trx_date;?></td>
								<td><?php echo $d->bank_destination;?></td>
								<td><?php echo $d->trx_schedule_type;?></td>
								<td><?php echo $d->account_type;?></td>
							</tr>
							<?php
						}
					}
					
				}
			?>
		</tbody>
	  </table>
	  <!-- End Table with stripped rows -->

	</div>
</div>
<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">13. Log transaksi DB IB HA ( ibank ) tbl_trx_payment (Start Date & End Date Required) </h5>

	  <!-- Table with stripped rows -->
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">reference_num</th>
			<th scope="col">payment_type</th>
			<th scope="col">status</th>
			<th scope="col">account</th>
			<th scope="col">payment_number</th>
			<th scope="col">payment_name</th>
			<th scope="col">amount</th>
			<th scope="col">trx_date</th>
			<th scope="col">trx_schedule_type</th>
			<th scope="col">third_party_name</th>
			<th scope="col">account_type</th>
		  </tr>
		</thead>
		<tbody>			
			<?php
				if(isset($payment_transaksi)){
					$count = 0;
					foreach($payment_transaksi as $keys){
						foreach($keys as $key => $d){
							$count = $count + 1;
							?>
							<tr>
								<th scope="row"><?php echo ($count);?></th>
								<td><?php echo $d->reference_num;?></td>
								<td><?php echo $d->payment_type;?></td>
								<td><?php echo $d->status;?></td>
								<td><?php echo $d->account;?></td>
								<td><?php echo $d->payment_number;?></td>
								<td><?php echo $d->payment_name;?></td>
								<td><?php echo $d->amount;?></td>
								<td><?php echo $d->trx_date;?></td>
								<td><?php echo $d->trx_schedule_type;?></td>
								<td><?php echo $d->third_party_name;?></td>
								<td><?php echo $d->account_type;?></td>
							</tr>
							<?php
						}
					}
					
				}
			?>
		</tbody>
	  </table>
	  <!-- End Table with stripped rows -->

	</div>
</div>

<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">14. Log transaksi DB IB HA ( ibank ) tbl_trx_purchase_transaksi (Start Date & End Date Required) </h5>

	  <!-- Table with stripped rows -->
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">reference_num</th>
			<th scope="col">purchase_type</th>
			<th scope="col">status</th>
			<th scope="col">account</th>
			<th scope="col">purchase_number</th>
			<th scope="col">amount</th>
			<th scope="col">trx_date</th>
			<th scope="col">trx_schedule_type</th>
			<th scope="col">third_party_name</th>
			<th scope="col">account_type</th>
		  </tr>
		</thead>
		<tbody>			
			<?php
				if(isset($purchase_transaksi)){
					$count = 0;
					foreach($purchase_transaksi as $keys){
						foreach($keys as $key => $d){
							$count = $count + 1;
							?>
							<tr>
								<th scope="row"><?php echo ($count);?></th>
								<td><?php echo $d->reference_num;?></td>
								<td><?php echo $d->purchase_type;?></td>
								<td><?php echo $d->status;?></td>
								<td><?php echo $d->account;?></td>
								<td><?php echo $d->purchase_number;?></td>
								<td><?php echo $d->amount;?></td>
								<td><?php echo $d->trx_date;?></td>
								<td><?php echo $d->trx_schedule_type;?></td>
								<td><?php echo $d->third_party_name;?></td>
								<td><?php echo $d->account_type;?></td>
							</tr>
							<?php
						}
					}
					
				}
			?>
		</tbody>
	  </table>
	  <!-- End Table with stripped rows -->

	</div>
</div>
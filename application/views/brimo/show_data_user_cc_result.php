<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">User CC Data</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">username</th>
			<th scope="col">card_name</th>
			<th scope="col">card_masking</th>
			<th scope="col">card_type</th>
			<th scope="col">currency</th>
			<th scope="col">card_block</th>
			<th scope="col">finansial_status</th>
			<th scope="col">validation_retry</th>
			<th scope="col">phone_number</th>
			<th scope="col">cif</th>
			<th scope="col">cust_token</th>
			<th scope="col">card_token</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($cc)){
					foreach($cc as $key => $d){
						?>
						<tr>
							
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->username;?></td>
							<td><?php echo $d->card_name;?></td>
							<td><?php echo $d->card_masking;?></td>
							<td><?php echo $d->card_type;?></td>
							<td><?php echo $d->currency;?></td>
							<td><?php echo $d->card_block;?></td>
							<td><?php echo $d->finansial_status;?></td>
							<td><?php echo $d->validation_retry;?></td>
							<td><?php echo $d->phone_number;?></td>
							<td><?php echo $d->cif;?></td>
							<td><?php echo $d->cust_token;?></td>
							<td><?php echo $d->card_token;?></td>
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
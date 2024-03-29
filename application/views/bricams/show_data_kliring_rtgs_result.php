<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">Detail Kliring dan RTGS</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">instrument_referance_no</th>
			<th scope="col">makerdate</th>
			<th scope="col">payment_value_date</th>
			<th scope="col">status</th>
			<th scope="col">product_code</th>
			<th scope="col">debit_amount</th>
			<th scope="col">cust_acc_no</th>
			<th scope="col">remmitance_no</th>
			<th scope="col">sor</th>
			<th scope="col">txn_id</th>
			<th scope="col">message_generated</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($detail)){
					foreach($detail as $key => $d){
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->instrument_referance_no;?></td>
							<td><?php echo $d->makerdate;?></td>
							<td><?php echo $d->payment_value_date;?></td>
							<td><?php echo $d->status;?></td>
							<td><?php echo $d->product_code;?></td>
							<td><?php echo $d->debit_amount;?></td>
							<td><?php echo $d->cust_acc_no;?></td>
							<td><?php echo $d->remmitance_no;?></td>
							<td><?php echo $d->sor;?></td>
							<td><?php echo $d->txn_id;?></td>
							<td><?php echo $d->message_generated;?></td>
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
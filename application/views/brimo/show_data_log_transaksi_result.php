<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">Log Transaksi</h5>

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
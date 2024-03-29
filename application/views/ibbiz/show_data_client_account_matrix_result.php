<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">Client Account Matrix Data</h5>

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
<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">Transfer Log</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">ID</th>
			<th scope="col">PID</th>
			<th scope="col">FID</th>
			<th scope="col">TRXID</th>
			<th scope="col">CREATIONDATE</th>
			<th scope="col">JENISTRANSAKSI</th>
			<th scope="col">CLIENTID</th>
			<th scope="col">DEBITACCOUNT</th>
			<th scope="col">DEBITACCOUNTNAME</th>
			<th scope="col">CREDITACCOUNT</th>
			<th scope="col">CREDITACCOUNTNAME</th>
			<th scope="col">DEBITCURRENCY</th>
			<th scope="col">DEBITAMOUNT</th>
			<th scope="col">CREDITAMOUNT</th>
			<th scope="col">TRXREMARK</th>
			<th scope="col">MAKER</th>
			<th scope="col">CHECKER</th>
			<th scope="col">CHECKERWORK</th>
			<th scope="col">CHECKERTOTAL</th>
			<th scope="col">SIGNER</th>
			<th scope="col">SIGNERWORK</th>
			<th scope="col">SIGNERTOTAL</th>
			<th scope="col">TRXDATE</th>
			<th scope="col">STARTDATE</th>
			<th scope="col">ENDDATE</th>
			<th scope="col">LASTUPDATE</th>
			<th scope="col">NOTIFICATION</th>
			<th scope="col">STATUS</th>
			<th scope="col">DESCRIPTION</th>
			<th scope="col">ESBEXTERNALID</th>
			<th scope="col">ESBRESPONSEMSG</th>
			<th scope="col">RMNUMBER</th>
			<th scope="col">AMOUNTIDR</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($transfer)){
					foreach($transfer as $key => $d){
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->ID;?></td>
							<td><?php echo $d->PID;?></td>
							<td><?php echo $d->FID;?></td>
							<td><?php echo $d->TRXID;?></td>
							<td><?php echo $d->CREATIONDATE;?></td>
							<td><?php echo $d->JENISTRANSAKSI;?></td>
							<td><?php echo $d->CLIENTID;?></td>
							<td><?php echo $d->DEBITACCOUNT;?></td>
							<td><?php echo $d->DEBITACCOUNTNAME;?></td>
							<td><?php echo $d->CREDITACCOUNT;?></td>
							<td><?php echo $d->CREDITACCOUNTNAME;?></td>
							<td><?php echo $d->DEBITCURRENCY;?></td>
							<td><?php echo $d->DEBITAMOUNT;?></td>
							<td><?php echo $d->CREDITAMOUNT;?></td>
							<td><?php echo $d->TRXREMARK;?></td>
							<td><?php echo $d->MAKER;?></td>
							<td><?php echo $d->CHECKER;?></td>
							<td><?php echo $d->CHECKERWORK;?></td>
							<td><?php echo $d->CHECKERTOTAL;?></td>
							<td><?php echo $d->SIGNER;?></td>
							<td><?php echo $d->SIGNERWORK;?></td>
							<td><?php echo $d->SIGNERTOTAL;?></td>
							<td><?php echo $d->TRXDATE;?></td>
							<td><?php echo $d->STARTDATE;?></td>
							<td><?php echo $d->ENDDATE;?></td>
							<td><?php echo $d->LASTUPDATE;?></td>
							<td><?php echo $d->NOTIFICATION;?></td>
							<td><?php echo $d->STATUS;?></td>
							<td><?php echo $d->DESCRIPTION;?></td>
							<td><?php echo $d->ESBEXTERNALID;?></td>
							<td><?php echo $d->ESBRESPONSEMSG;?></td>
							<td><?php echo $d->RMNUMBER;?></td>
							<td><?php echo $d->AMOUNTIDR;?></td>
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
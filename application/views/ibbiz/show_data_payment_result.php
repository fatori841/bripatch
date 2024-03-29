<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">Payment Log</h5>

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
			<th scope="col">PAYMENTCODE</th>
			<th scope="col">DEBITACCOUNT</th>
			<th scope="col">DEBITACCOUNTNAME</th>
			<th scope="col">CREDITACCOUNT</th>
			<th scope="col">CREDITACCOUNTNAME</th>
			<th scope="col">CURRENCY</th>
			<th scope="col">AMOUNT</th>
			<th scope="col">MAKER</th>
			<th scope="col">CHECKER</th>
			<th scope="col">CHECKERWORK</th>
			<th scope="col">CHECKERTOTAL</th>
			<th scope="col">SIGNER</th>
			<th scope="col">SIGNERWORK</th>
			<th scope="col">SIGNERTOTAL</th>
			<th scope="col">TRXDATE</th>
			<th scope="col">LASTUPDATE</th>
			<th scope="col">STATUS</th>
			<th scope="col">DESCRIPTION</th>
			<th scope="col">ESBEXTERNALID</th>
			<th scope="col">ESBRESPONSEMSG</th>
			<th scope="col">info1</th>
			<th scope="col">info2</th>
			<th scope="col">info3</th>
			<th scope="col">info4</th>
			<th scope="col">info5</th>
			<th scope="col">info6</th>
			<th scope="col">info7</th>
			<th scope="col">info8</th>
			<th scope="col">info9</th>
			<th scope="col">info10</th>
			<th scope="col">info11</th>
			<th scope="col">info12</th>
			<th scope="col">info13</th>
			<th scope="col">info14</th>
			<th scope="col">info15</th>
			<th scope="col">info16</th>
			<th scope="col">info17</th>
			<th scope="col">info18</th>
			<th scope="col">info19</th>
			<th scope="col">info20</th>

		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($payment)){
					foreach($payment as $key => $d){
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
							<td><?php echo $d->PAYMENTCODE;?></td>
							<td><?php echo $d->DEBITACCOUNT;?></td>
							<td><?php echo $d->DEBITACCOUNTNAME;?></td>
							<td><?php echo $d->CREDITACCOUNT;?></td>
							<td><?php echo $d->CREDITACCOUNTNAME;?></td>
							<td><?php echo $d->CURRENCY;?></td>
							<td><?php echo $d->AMOUNT;?></td>
							<td><?php echo $d->MAKER;?></td>
							<td><?php echo $d->CHECKER;?></td>
							<td><?php echo $d->CHECKERWORK;?></td>
							<td><?php echo $d->CHECKERTOTAL;?></td>
							<td><?php echo $d->SIGNER;?></td>
							<td><?php echo $d->SIGNERWORK;?></td>
							<td><?php echo $d->SIGNERTOTAL;?></td>
							<td><?php echo $d->TRXDATE;?></td>
							<td><?php echo $d->LASTUPDATE;?></td>
							<td><?php echo $d->STATUS;?></td>
							<td><?php echo $d->DESCRIPTION;?></td>
							<td><?php echo $d->ESBEXTERNALID;?></td>
							<td><?php echo $d->ESBRESPONSEMSG;?></td>
							<td><?php echo $d->info1;?></td>
							<td><?php echo $d->info2;?></td>
							<td><?php echo $d->info3;?></td>
							<td><?php echo $d->info4;?></td>
							<td><?php echo $d->info5;?></td>
							<td><?php echo $d->info6;?></td>
							<td><?php echo $d->info7;?></td>
							<td><?php echo $d->info8;?></td>
							<td><?php echo $d->info9;?></td>
							<td><?php echo $d->info10;?></td>
							<td><?php echo $d->info11;?></td>
							<td><?php echo $d->info12;?></td>
							<td><?php echo $d->info13;?></td>
							<td><?php echo $d->info14;?></td>
							<td><?php echo $d->info15;?></td>
							<td><?php echo $d->info16;?></td>
							<td><?php echo $d->info17;?></td>
							<td><?php echo $d->info18;?></td>
							<td><?php echo $d->info19;?></td>
							<td><?php echo $d->info20;?></td>
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
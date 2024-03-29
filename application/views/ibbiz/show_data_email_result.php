<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">Paymet Log</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">ID</th>
			<th scope="col">TRXID</th>
			<th scope="col">CLIENTID</th>
			<th scope="col">SUBJECT</th>
			<th scope="col">RECEIVER</th>
			<th scope="col">CONTENT</th>
			<th scope="col">STATUS</th>
			<th scope="col">CREATEDTIME</th>
			<th scope="col">LASTUPDATE</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($email)){
					foreach($email as $key => $d){
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->ID;?></td>
							<td><?php echo $d->TRXID;?></td>
							<td><?php echo $d->CLIENTID;?></td>
							<td><?php echo $d->SUBJECT;?></td>
							<td><?php echo $d->RECEIVER;?></td>
							<td width="500" height="300"><div style="width: 500px; height: 300px; overflow: auto"><?php echo $d->CONTENT;?></div></td>
							<td><?php echo $d->STATUS;?></td>
							<td><?php echo $d->CREATEDTIME;?></td>
							<td><?php echo $d->LASTUPDATE;?></td>
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
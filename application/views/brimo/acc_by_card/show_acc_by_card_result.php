<?php
	if(isset($card_detail)){
		if(count($card_detail) == 5) {
			echo '<h5 style="color:red;background-color:lithgrey;" align="center"> Total Pencarian di limit 5 row, agar tidak mempengaruhi performance DB IB Slave. Dapat dilakukan konfirmasi ke team IBO.</h5>';
		}
	}
?>
<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title"> Card Detail </h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">Card Number</th>
			<th scope="col">Account</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($card_detail)){
					foreach($card_detail as $key => $d){
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->card_number;?></td>
							<td><?php echo $d->account;?></td>
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

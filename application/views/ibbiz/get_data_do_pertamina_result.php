<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">Data Do Pertamina</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-bordered table-sm">
		<tbody>
			<?php
				if(isset($param)){
					if($param == 'cashcarry_opt'){
					?>
						<tr>
							<td>Sold To</td>
							<td><?php print_r($sold_to); ?></td>
						</tr>
						<tr>
							<td>No SO</td>
							<td><?php print_r($no_so);?></td>
						</tr>
						<tr>
							<td>Office</td>
							<td><?php print_r($office);?></td>
						</tr>
						<tr>
							<td>Plant</td>
							<td><?php print_r($plant);?></td>
						</tr>
				<?php
					} else if($param == 'product_allocation_opt'){
					?>
						<tr>
							<td>Sold To</td>
							<td><?php print_r($sold_to); ?></td>
						</tr>
						<tr>
							<td>No Aplikasi</td>
							<td><?php print_r($no_aplikasi); ?></td>
						</tr>
						<tr>
							<td>No SA</td>
							<td><?php print_r($no_sa);?></td>
						</tr>
						<tr>
							<td>Office</td>
							<td><?php print_r($office);?></td>
						</tr>
						<tr>
							<td>Plant</td>
							<td><?php print_r($plant);?></td>
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
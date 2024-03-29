<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">Soft Token User</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">username</th>
			<th scope="col">cellphone_number</th>
			<th scope="col">cellphone_id</th>
			<th scope="col">imei</th>
			<th scope="col">activation_time</th>
			<th scope="col">activation_status</th>
			<th scope="col">created_time</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($st_user)){
					foreach($st_user as $key => $d){
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->username;?></td>
							<td><?php echo $d->cellphone_number;?></td>
							<td><?php echo $d->cellphone_id;?></td>
							<td><?php echo $d->imei;?></td>
							<td><?php echo $d->activation_time;?></td>
							<td><?php echo $d->activation_status;?></td>
							<td><?php echo $d->created_time;?></td>
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
	  <h5 class="card-title">Soft Token User Activity</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">username</th>
			<th scope="col">activity</th>
			<th scope="col">remark</th>
			<th scope="col">edit_time</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($st_user_activity)){
					foreach($st_user_activity as $key => $d){
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->username;?></td>
							<td><?php echo $d->activity;?></td>
							<td><?php echo $d->remark;?></td>
							<td><?php echo $d->edit_time;?></td>
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
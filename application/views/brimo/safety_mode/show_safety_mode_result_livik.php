<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">DB Livik ( ibank_brimo ) tbl_brimo_activation </h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">username</th>
			<th scope="col">status</th>
			<th scope="col">device_id</th>
			<th scope="col">activation_date</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($livik_brimo_activation)){
					if(is_array($livik_brimo_activation)){
						foreach($livik_brimo_activation as $key => $d){
							?>
							<tr>
								<th scope="row"><?php echo ($key+1);?></th>
								<td><?php echo $d->username;?></td>
								<td><?php echo $d->status;?></td>
								<td><?php echo $d->device_id;?></td>
								<td><?php echo $d->activation_date;?></td>
							</tr>
							<?php
						}
					} else {
						?>
						<tr>
							<td colspan = "5" align = "center"> <?php echo $livik_brimo_activation; ?> </td>
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
	  <h5 class="card-title">DB Livik ( ibank_brimo ) tbl_brimo_activation_mnt_log </h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">username</th>
			<th scope="col">status</th>
			<th scope="col">device_id</th>
			<th scope="col">activation_date</th>
			<th scope="col">sms_link</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($livik_brimo_activation_mnt_log)){
					if(is_array($livik_brimo_activation_mnt_log)){
						foreach($livik_brimo_activation_mnt_log as $key => $d){
							?>
							<tr>
								<th scope="row"><?php echo ($key+1);?></th>
								<td><?php echo $d->username;?></td>
								<td><?php echo $d->status;?></td>
								<td><?php echo $d->device_id;?></td>
								<td><?php echo $d->activation_date;?></td>
								<td><?php echo $d->sms_link;?></td>
							</tr>
							<?php
						}
					} else {
						?>
						<tr>
							<td colspan = "5" align = "center"> <?php echo $livik_brimo_activation_mnt_log; ?> </td>
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

<div class="col-lg-12" id="form_result2"><?php echo isset($form_result2)?$form_result2:''; ?></div>



<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">Data Remitance</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">no_remitance</th>
			<th scope="col">sor</th>
			<th scope="col">jurnal_seq</th>
			<th scope="col">no_rekening_tujuan</th>
			<th scope="col">jumlah_dikirim</th>
			<th scope="col">status_trx</th>
			<th scope="col">status_desc</th>
			<th scope="col">berita</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($no_sor)){
					foreach($no_sor as $key => $d){
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->no_remitance;?></td>
							<td><?php echo $d->sor;?></td>
							<td><?php echo $d->jurnal_seq;?></td>
							<td><?php echo $d->no_rekening_tujuan;?></td>
							<td><?php echo $d->jumlah_dikirim;?></td>
							<td><?php echo $d->status_trx;?></td>
							<td><?php echo $d->status_desc;?></td>
							<td><?php echo $d->berita;?></td>
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
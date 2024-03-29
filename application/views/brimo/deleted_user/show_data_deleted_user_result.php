<?php
$jawaban = '';
if(isset($data_deleted_user)){ 
	foreach($data_deleted_user as $key => $d){
		if (substr($d->remarks,-7) == 'Deleted') {
			if (substr($d->edit_by,0,6) == 'MB0206') {
				$jawaban = 'Kami cek user tersebut dihapus oleh sistem pada tanggal '.$d->edit_date.' karena ada pergantian SIM Card Fisik.';
			} elseif (substr($d->edit_by,0,4) == 'INDS') {
				$jawaban = 'Kami cek user tersebut dihapus pada tanggal '.$d->edit_date.' oleh uker '.substr($d->edit_by,4,4).' .';
			} else {
				$jawaban = 'Kami cek user tersebut dihapus pada tanggal '.$d->edit_date.' oleh '.$d->edit_by.' .';
			}
			if(isset($data_new_user)){
				$jawaban = $jawaban.' Sebagai tambahan informasi user tersebut sudah melakukan registrasi ulang tanggal '.$data_new_user[0]->registered_date.' .';
			} else {
				$jawaban = $jawaban.' Silahkan melakukan registrasi ulang .';
			}
			
		}
	}
}
?>
<div class="card mb-3">
	<div class="card-body">
	</div>
	<div class="overflow-x:auto;">
		<input class="form-control" type="text" value = "<?php echo $jawaban; ?>" id="jawaban" readonly>
		<!--<button class="btn btn-outline-secondary w-100" id="btn_click"> Copy text </button> -->
	</div>
	<div class="card-body">
	</div>
	</div>

<div class="card mb-3">
	<div class="card-body">
	<?php  if(isset($data_deleted_user)){
		echo '<h5 class="card-title">User MNT LOG:</h5>';
	} else {
		echo '<h5 class="card-title">User Tidak ditemukan pastikan nomor rekening benar</h5>';
	}
		?>
	  
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">id</th>
			<th scope="col">username</th>
			<th scope="col">activity</th>
			<th scope="col">remarks</th>
			<th scope="col">edit_by</th>
			<th scope="col">Jawaban</th>
		  </tr>
		</thead>
		<tbody>
			<?php
			if(isset($data_deleted_user)){ 
				foreach($data_deleted_user as $key => $d){
					?>
					<tr>
						<th scope="row"><?php echo ($key+1);?></th>
						<td><?php echo $d->id;?></td>
						<td><?php echo $d->username;?></td>
						<td><?php echo $d->activity;?></td>
						<td><?php echo $d->remarks;?></td>
						<td><?php echo $d->edit_by;?></td>
						<td><?php echo $d->edit_date;?></td>
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
	<?php  if(isset($data_new_user)){
		echo '<h5 class="card-title">User Sudah Registrasi Ulang dengan Data:</h5>';
	} else {
		echo '<h5 class="card-title">User Belum Registrasi Ulang</h5>';
	}
		?>
	  

	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">username</th>
			<th scope="col">user_alias</th>
			<th scope="col">registered_date</th>
			<th scope="col">approved_by</th>
			<th scope="col">status</th>
			<th scope="col">login_status</th>
			<th scope="col">last_login</th>
		  </tr>
		</thead>
		<tbody>
			<?php
			if(isset($data_new_user)){ 
				foreach($data_new_user as $key => $d){
					?>
					<tr>
						<th scope="row"><?php echo ($key+1);?></th>
						<td><?php echo $d->username;?></td>
						<td><?php echo $d->user_alias;?></td>
						<td><?php echo $d->registered_date;?></td>
						<td><?php echo $d->approved_by;?></td>
						<td><?php echo $d->status;?></td>
						<td><?php echo $d->login_status;?></td>
						<td><?php echo $d->last_login;?></td>
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

<script type="text/javascript">
$(document).ready(function(){
	$('#btn_click').click(function(){
		var temp = $('#jawaban');
		$temp.select();
		document.execCommand("copy");
		alert("Copy Text Berhasil");
	});
});
</script>
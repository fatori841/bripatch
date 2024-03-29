<div class="card mb-3">
	<div class="card-body">
<?php
	if(isset($user_profile)){
		if(count($user_profile) > 0) {
			if($is_safety_mode){
				echo '<h5 class="card-title" style="color:red;background-color:lithgrey;" align="center"> User ini dalam kondisi Safety Mode. Apabila Ingin merelease user ini Klik Tombol Release. ( Harus ada e-form patching terlebih dahulu. )</h5>';
			} else {
				echo '<h5 class="card-title" style="color:green;background-color:lithgrey;" align="center"> User ini tidak dalam kondisi Safety Mode.</h5>';
			}
		} else {
			echo '<h5 class="card-title" style="color:red;background-color:lithgrey;" align="center"> Maaf User tidak ditemukan.</h5>';
		}
	} else {
		echo '<h5 class="card-title" style="color:red;background-color:lithgrey;" align="center"> Maaf User tidak ditemukan.</h5>';
	}
?>
	</div>
</div>
<div class="card mb-3">
	<div class="card-body">
	  <h5 class="card-title">DB IB HA ( ibank ) tabel tbl_user_safety_mode </h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">username</th>
			<th scope="col">start</th>
			<th scope="col">status</th>
			<?php
				if($is_safety_mode){
					?>
					<th scope="col">Action</th>
					<?php
				}
			?>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($user_safety_mode)){
					if(is_array($user_safety_mode)){
						foreach($user_safety_mode as $key => $d){
							?>
							<tr>
								<th scope="row"><?php echo ($key+1);?></th>
								<td><?php echo $d->username;?></td>
								<td><?php echo $d->start;?></td>
								<td><?php echo $d->status;?></td>
								<?php
									if($is_safety_mode){
										?>
										<td><button class="btn btn-danger btn_release" type="submit" user_name="<?php echo $d->username;?>" > Release </button></td>
										<?php
									}
								?>
							</tr>
							<?php
						}
					} else {
						?>
						<tr>
							<td colspan = "4" align = "center"> No Data </td>
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
	  <h5 class="card-title">DB IB HA ( ibank ) tabel tbl_user_profile</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">name</th>
			<th scope="col">cellphone_number</th>
			<th scope="col">email_address</th>
			<th scope="col">cif</th>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($user_profile)){
					foreach($user_profile as $key => $d){
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->name;?></td>
							<td><?php echo $d->cellphone_number;?></td>
							<td><?php echo $d->email_address;?></td>
							<td><?php echo $d->cif;?></td>
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

<div class="col-12">
  <button class="btn btn-primary w-100" type="submit" id="search_user_livik_btn" user_name="<?php echo $this_username;?>">
	Show History Livik
  </button>
</div>
<div class="col-lg-12" id="form_result_livik"><?php echo isset($form_result_livik)?$form_result_livik:''; ?></div>


<script type="text/javascript">
$(document).ready(function(){
	$('#search_user_livik_btn').click(function(){
		var mydata = "username="+$(this).attr("user_name");
		$.ajax({
			type : "POST",
			url  : "<?=site_url('Brimo/search_safety_mode_livik');?>",
			data : mydata,
			beforeSend:function(){
				//$('#ajax-loader').show();
				$('#search_user_livik_btn').attr("disabled","disabled");
				$('#search_user_livik_btn').text('Loading...');
				$('#search_user_livik_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
			},
			error: function(){
				//$('#ajax-loader').hide();
				$('#search_user_livik_btn').removeAttr("disabled");
				$('#search_user_livik_btn').text("Show History Livik");
				alert('Error, Terjadi gagal sistem.');
			},
			success: function(data){
				//$('#ajax-loader').hide();
				$('#search_user_livik_btn').removeAttr("disabled");
				$('#search_user_livik_btn').text("Show History Livik");
				$('#form_result_livik').html(data);
			}
		});
		return false;
	});
	$('.btn_release').click(function(){
		var mydata = "username="+$(this).attr("user_name");
		var user_name = $(this).attr("user_name");
		var btn = $(this);
		if (confirm("Apakah ingin melakukan Release User ini ( "+user_name+" ) ?")) {
			$.ajax({
				type : "POST",
				url  : "<?=site_url('Brimo/release_safety_mode');?>",
				data : mydata,
				beforeSend:function(){
					//$('#ajax-loader').show();
					$('.btn_release').attr("disabled","disabled");
					btn.text('Loading...');
					btn.prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
				},
				error: function(){
					//$('#ajax-loader').hide();
					window.setTimeout(function(){
						$('.btn_release').removeAttr("disabled");
						btn.text('Release');
						alert('Error, Terjadi gagal sistem.');
						$("#search_user_btn").trigger('click');
					}, 1000);
				},
				success: function(data){
					//$('#ajax-loader').hide();
					window.setTimeout(function(){
						
						alert(data);
						$("#search_user_btn").trigger('click');
					}, 1000);
				}
			});
		}
		
		return false;
		
	});
});
</script>

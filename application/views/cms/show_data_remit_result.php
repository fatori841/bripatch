<div class="pagetitle">
  <h1 align="center">CMS - Show Data remit</h1>
</div>
<div class="card">
	<div class="card-body">
	  <h5 class="card-title">Data Remit</h5>

	  <!-- Table with stripped rows -->
	  <div style="overflow-x:auto;">
	  <table class="table table-striped table-sm">
		<thead>
		  <tr>
			<th scope="col">#</th>
			<th scope="col">NO_REMITANCE</th>
			<th scope="col">TRXTYPE</th>
			<th scope="col">STATUS</th>
			<th scope="col">DESCRIPTION</th>
			<th scope="col">detail</th>
			<?php 
				if(isset($search_type)){
					echo ($search_type == 'detail')? '<th scope="col">detail</th>':''; 
				}
			?>
		  </tr>
		</thead>
		<tbody>
			<?php
				if(isset($get_remit)){
					foreach($get_remit as $key => $d){
						?>
						<tr>
							<th scope="row"><?php echo ($key+1);?></th>
							<td><?php echo $d->NO_REMITANCE;?></td>
							<td><?php echo $d->TRXTYPE;?></td>
							<td><?php echo $d->STATUS;?></td>
							<td><?php echo $d->DESCRIPTION;?></td>	
							
							<td>
								<button>detail</button>
							</td>
									
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
<?php 
	if(isset($search_type)){
		if ($search_type == 'patching')
		{
			?>
				<script type="text/javascript">
				$(document).ready(function(){
					$('#clear_session_btn').click(function(){
						$.ajax({
							type : "POST",
							url  : "<?=site_url('Cms/update_clear_session');?>",
							data : "idcms="+$(this).attr("id_cms"),
							beforeSend:function(){
								//$('#ajax-loader').show();
								$('#clear_session_btn').attr("disabled","disabled");
								$('#clear_session_btn').text('Loading...');
								$('#clear_session_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
							},
							error: function(){
								//$('#ajax-loader').hide();
								$('#clear_session_btn').removeAttr("disabled");
								$('#clear_session_btn').text("Clear Session");
								alert('Error, Terjadi gagal sistem.');
							},
							success: function(data){
								//$('#ajax-loader').hide();
								$('#clear_session_btn').removeAttr("disabled");
								$('#clear_session_btn').text("Clear Session");
								alert(data);
								$('#search_data_user').trigger( "submit" );
							}
						});
						return false;
						
					});
				});
				</script>

			<?php
		}
	}
?>

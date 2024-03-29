<?php 
	$sch_active = 0;
	$sch_not_active = 0;
	if(isset($sch_mftpost)){
		foreach($sch_mftpost as $key => $d){
			if($d->restartstatus == 1){$sch_active += 1;}
			if($d->restartstatus == 3){$sch_active += 1;}
			if($d->restartstatus == 4){$sch_not_active += 1;}
			if($d->restartstatus == 5){$sch_not_active += 1;}
		}
	}
?>
<h2> Underconstruction </h2>
<section class="section dashboard">
   <div class="row">
	<div class="card-body">
		<div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-2 col-md-3">
              <div class="card info-card sales-card">
				<div class="card-body">
                  <h5 class="card-title">Parent <span> |  OnProcess</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-segmented-nav"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $get_trx_pasjay->ParentOnprocess ;?></h6>
                      

                    </div>
                  </div>
                </div>

              </div>
            </div>
			
			<div class="col-xxl-2 col-md-3">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Detail <span> |  OnProcess</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-segmented-nav"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $get_trx_pasjay->DetailOnprocess ;?></h6>
                     

                    </div>
                  </div>
                </div>

              </div>
            </div>
			
			<div class="col-xxl-2 col-md-3">
              <div class="card info-card sales-card">


                <div class="card-body">
                  <h5 class="card-title">Parent <span> |  Parkir</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-segmented-nav"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $get_trx_pasjay->ParentParkir ;?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div>
			<div class="col-xxl-2 col-md-3">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Detail <span> |  Parkir</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-segmented-nav"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $get_trx_pasjay->DetailParkir ;?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div>
			<div class="col-xxl-2 col-md-3">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title"><b>STOP </b><span> |  <b>Scheduller</b></span></h5>

                  <div class="d-flex align-items-center">
				  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
         
					  <button type="button" class="btn btn-danger" id ="close_mft" <?php if($sch_active == 0){ echo 'disabled'; } ?> disabled>
					  STOP </button>
					  
                  </div>
				  </br>
                  <div class="ps-3"> 
					  <button type="button" class="btn btn-outline-success" <?php if($sch_not_active > 0){ echo 'disabled'; } ?> disabled>START</button>
				  </div>
                  </div>
                </div>

              </div>
			  
            </div>
			<div class="col-xxl-2 col-md-3">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title"><b>Parkir</b> <span> |  <b>Transaksi</b></span></h5>

                  <div class="d-flex align-items-center">
				  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      
					  
					  <button type="button" class="btn btn-danger"disabled>Parkir</button>
                  </div>
				  </br>
                  <div class="ps-3"> 
					  <button type="button" class="btn btn-outline-success" disabled>RUN</button>
				  </div>
                  </div>
                </div>

              </div>
			  
            </div>
			
			<!-- End Sales Card -->
			<!-- Top Selling -->
            <div class="col-6">
              <div class="card top-selling">

                

                <div class="card-body pb-0">
                  <h5 class="card-title">SCH MFT <span>| PostBook</span></h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">SCH ID</th>
                        <th scope="col">SCH CODE</th>
                        <th scope="col">SERVERID	</th>
                        <th scope="col">LASTUPDATE</th>
                        <th scope="col">SCH 	STATUS</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					$array = array('560','570','580','590','600','610','620','630','640','650');
						if(isset($sch_mftpost)){
							foreach($sch_mftpost as $key => $d){
								if(in_array($d->id,$array)) {
					?>
					  <tr>
                        <th><?php echo $d->id;?></th>
                        <td><?php echo $d->schcode;?></td>
                        <td><?php echo $d->serverid;?></td>
                        <td><?php echo $d->lastupdate;?></td>
                        <td><?php 
								if($d->restartstatus == 1){
									echo "Restart OnProcess";
								}
								if($d->restartstatus == 3){
									echo "Active";
								}
								if($d->restartstatus == 4){
									echo "Shutdown OnProcess";
								}
								if($d->restartstatus == 5){
									echo "Inactive";
								}
								?>
								</td>
                      </tr>
							<?php }
						}
						}
						?>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Top Selling -->
            <!-- Top Selling -->
            <div class="col-6">
              <div class="card top-selling">

                <div class="card-body pb-0">
                  <h5 class="card-title">Sch MFT <span>| CheckBook</span></h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">SCH ID</th>
                        <th scope="col">SCH CODE</th>
                        <th scope="col">SERVERID	</th>
                        <th scope="col">LASTUPDATE</th>
                        <th scope="col">SCH 	STATUS</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					$array = array('760','770','780','790','800','810','820','830','840','850');
						if(isset($sch_mftpost)){
							foreach($sch_mftpost as $key => $d){
								if(in_array($d->id,$array)) {
					?>
					  <tr>
                        <th><?php echo $d->id;?></th>
                        <td><?php echo $d->schcode;?></td>
                        <td><?php echo $d->serverid;?></td>
                        <td><?php echo $d->lastupdate;?></td>
                        <td><?php 
								if($d->restartstatus == 1){
									echo "Restart OnProcess";
								}
								if($d->restartstatus == 3){
									echo "Active";
								}
								if($d->restartstatus == 4){
									echo "Shutdown OnProcess";
								}
								if($d->restartstatus == 5){
									echo "Inactive";
								}
								?>
								</td>
                      </tr>
							<?php }
						}
						}
						?>	
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Top Selling -->

            

          </div>

	</div>
</div>
</section>

<script type="text/javascript">
$(document).ready(function(){
	$('#close_mft').submit(function(){
		if (confirm("Apakah anda yakin ingin menutup semua scheduler bifast CMS?")) {
			$.ajax({
				type : "POST",
				url  : "<?=site_url('Cms/close_mft_allx');?>",
				data : $(this).serialize(),
				beforeSend:function(){
					//$('#ajax-loader').show();
					$('#close_bifast_btn').attr("disabled","disabled");
					$('#close_bifast_btn').text('Loading...');
					$('#close_bifast_btn').prepend('<span class="spinner-border spinner-border-sm" role="status" style="margin-right:5px;" aria-hidden="true"></span>');
				},
				error: function(){
					//$('#ajax-loader').hide();
					$('#close_bifast_btn').removeAttr("disabled");
					$('#close_bifast_btn').text("STOP");
					alert('Error, Terjadi gagal sistem.');
				},
				success: function(data){
					//$('#ajax-loader').hide();
					$('#close_bifast_btn').removeAttr("disabled");
					$('#close_bifast_btn').text("STOP");
					//$('#form_result').html(data);
				}
			});
			$("#search_data_sch_bifast").trigger('submit');
		}
		return false;
	});
	
});
</script>

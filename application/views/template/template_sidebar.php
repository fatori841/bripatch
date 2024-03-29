<!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
		<?php
			$parent_active_side =99999;
			foreach($sidemenu as $sm){
				if($sm->level == 0){
		?>
					<li class="nav-item">
						<a class="nav-link collapsed" href="#">
							<i class="bi"><img src="<?php echo base_url('assets/img/apps/'.$sm->icon); ?>" alt="<?php echo $sm->title;?>" width="75px"></i>
							<!--span><?php echo $sm->title;?></span-->
						</a>
					</li>
		<?php
				}
			}
		?>
		
		<?php
			foreach($sidemenu as $sm1){
				if($sm1->level == 1){
		?>
					<li class="nav-item">
						<a class="nav-link collapsed" data-bs-target="#id<?php echo $sm1->id;?>-nav" data-bs-toggle="collapse" href="#">
							<i class="<?php echo $sm1->icon;?>"></i><span><?php echo $sm1->title;?></span><i class="bi bi-chevron-down ms-auto"></i>
						</a>
						<ul id="id<?php echo $sm1->id;?>-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav" >
							<?php
								foreach($sidemenu as $sm2){
									if($sm2->level == 2 && $sm2->parent_id == $sm1->id){
										//echo $sm2->title;
										if (strtolower(uri_string()) == strtolower($sm2->url)){$parent_active_side = $sm2->parent_id;}
										?>
											<li>
												<a href="<?php echo site_url($sm2->url);?>" class="<?php echo (strtolower(uri_string()) == strtolower($sm2->url))?'active':''; ?>">
													<i class="bi bi-circle"></i><span><?php echo $sm2->title;?></span>
												</a>
											</li>
										<?php
										
									}
								}
							?>
						</ul>
					</li>
		<?php
				}
			}
		?>

    </ul>

  </aside><!-- End Sidebar-->
  <?php
  if ($parent_active_side != 99999)
  {?>
	<script type="text/javascript">
	$(document).ready(function(){
		$("#id<?php echo $parent_active_side;?>-nav").collapse('show');
	});
	</script>  
  <?php
  }
  ?>

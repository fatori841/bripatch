<script type="text/javascript">
	$(document).ready(function(){
		$('.apps-link').hover(function(){
			$(this).parent('.card').css("border", "#eee solid 3px");
		}, function(){
			$(this).parent('.card').css("border", "#fff solid 0px");
		});
	});
</script>
<div class="pagetitle">
  <h1 align="center">Our Apps</h1>
  <!--nav>
	<ol class="breadcrumb">
	  <li class="breadcrumb-item"><a href="index.html">Home</a></li>
	  <li class="breadcrumb-item">Pages</li>
	  <li class="breadcrumb-item active">Blank</li>
	</ol>
  </nav-->
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
	<?php
		foreach($menu as $m){
	?>
		<div class="col-lg-2 col-md-6">
		<!-- Card with an image on top -->
		  <div class="card text-center" style="border:#fff solid 0px">
			<a href="<?php echo site_url($m->url); ?>" class="card-link apps-link">
			<img src="<?php echo base_url('assets/img/apps/'.$m->icon); ?>" class="card-img-top" alt="<?php echo $m->title;?>" style="height:100%">
			<!--div class="card-body">
			  <h5 class="card-title"><?php echo $m->title;?></h5>
			</div-->
			</a>
		  </div><!-- End Card with an image on top -->
		</div>
	<?php
		}
	?>
  </div>
</section>
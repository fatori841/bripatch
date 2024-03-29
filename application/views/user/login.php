<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

				<div class="d-flex justify-content-center py-4">
				<a href="index.html" class="logo d-flex align-items-center w-auto">
				  <img src="<?php echo base_url('assets/img/bri-logo.png'); ?>" alt="">
				  <!--span class="d-none d-lg-block">Nice-Admin</span-->
				</a>
				</div><!-- End Logo -->

				<div class="card mb-3">

					<div class="card-body">

					  <div class="pt-4 pb-2">	
						<h5 class="card-title text-center pb-0 fs-4">Welcome, OPA !</h5>
						<p class="text-center small">Enter your username & password to login</p>
					  </div>
					  
					  <?php
						if(isset($msg_notif)){
							?>
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<i class="bi bi-exclamation-octagon me-1"></i>
								<span class="small"><?php echo $msg_notif; ?></span>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
							<?php
						}
					  ?>

					  <form id="login_form" class="row g-3 needs-validation" action="<?php echo site_url('User/login_submit');?>" method="post" novalidate>

						<div class="col-12">
						  <label for="username_txt" class="form-label">Username</label>
						  <input type="text" name="username_txt" class="form-control" id="username_txt" required>
						  <div class="invalid-feedback">Please enter your username.</div>
						</div>

						<div class="col-12">
						  <label for="password_txt" class="form-label">Password</label>
						  <input type="password" name="password_txt" class="form-control" id="password_txt" required>
						  <div class="invalid-feedback">Please enter your password.</div>
						</div>
						
						<div class="col-12">
						  <label for="team_txt" class="form-label">Team</label>
						  <!--input type="password" name="password_txt" class="form-control" id="password_txt" required-->
						  <select class="form-select" id="team_txt" name="team_txt" required>
							  <option value="" selected>Choose your team</option>
							  <?php
								foreach($team_list as $t){
									?>
									<option value="<?php echo $t->id; ?>"><?php echo $t->title; ?></option>
									<?php
								}
							  ?>
						  </select>
						  <div class="invalid-feedback">Please select your team.</div>
						</div>

						<div class="col-12">
						  <button class="btn btn-primary w-100" type="submit">Login</button>
						</div>
					  </form>

					</div>
					<p></p>
					<p></p>
				</div>

				<div class="credits">
				Developed by IBO Team - 2022
				</div>

			</div>
		</div>
	</div>

</section>
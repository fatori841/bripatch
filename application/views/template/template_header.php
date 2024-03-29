<!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="<?php echo site_url('Home/beranda');?>" class="logo d-flex align-items-center">
        <img src="<?php echo base_url('assets/img/bri-logo.png'); ?>" alt="">
        <!--span class="d-none d-lg-block">NiceAdmin</span-->
      </a>
	  <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item">

          <a class="nav-link nav-icon" href="<?php echo site_url('Home/beranda');?>">
            <i class="ri ri-bank-line"></i>
		  </a>

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="<?php echo file_exists('assets/img/avatar/'.$this->session->userdata('ibo_username').'.png')?base_url('assets/img/avatar/'.$this->session->userdata('ibo_username').'.png'):base_url('assets/img/avatar/avatar.png'); ?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $this->session->userdata('ibo_username');?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $this->session->userdata('ibo_name');?></h6>
              <span><?php echo $this->session->userdata('ibo_team_title');?> - <?php echo $this->session->userdata('ibo_level');?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?php echo site_url('User/logout'); ?>">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->
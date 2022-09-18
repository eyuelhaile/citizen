
<body>
   <!-- Layout wrapper -->
   <div class="layout-wrapper layout-content-navbar  ">
     <div class="layout-container">
     	<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

  
  <div class="app-brand demo ">
    <a href="index.html" class="app-brand-link">
      <span class="app-brand-logo demo">
          <!-- Logo goes here -->
      </span>
      <span class="app-brand-text demo menu-text fw-bolder ms-2">ETH ID Card</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  

  <ul class="menu-inner py-1">

    <?php foreach ($menu['menu'] as $key => $value) { ?>
    <li class="menu-item">
      <a href="<?php echo $value['link']; ?>" class="menu-link">
        <i class="<?php echo $value['icon']; ?>"></i>
        <div data-i18n="Analytics"><?php echo $value['module_name']; ?></div>
      </a>
    </li>
   <?php } ?>
  </ul>

</aside>
<!-- / Menu -->
<!-- Layout container -->
<div class="layout-page">
  <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
          <i class="bx bx-menu bx-sm"></i>
        </a>
      </div>      
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">	
    <!-- Search -->
        <div class="navbar-nav align-items-center">
          <div class="nav-item d-flex align-items-center">
            <label style="font-size: 20px !important;">Ethiopian National Identification Card System</label>
            
          </div>
        </div>
    <!-- /Search -->
        <ul class="navbar-nav flex-row align-items-center ms-auto">
          

          
          <!-- Place this tag where you want the button to render. -->

          


          <!-- User -->
          <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
              <div class="avatar avatar-online">
                <img src="<?php echo base_url() ?>assets/img/avatars/user.png" alt class="w-px-40 h-auto rounded-circle">
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="#">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                      <div class="avatar avatar-online">
                        <img src="<?php echo base_url() ?>assets/img/avatars/user.png" alt class="w-px-40 h-auto rounded-circle">
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <span class="fw-semibold d-block"><?php echo $session['full_name'] ?></span>
                      <small class="text-muted"><?php echo $session['type'] ?></small>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
             
              
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item" href="logout">
                  <i class="bx bx-power-off me-2"></i>
                  <span class="align-middle">Log Out</span>
                </a>
              </li>
            </ul>
          </li>
          <!--/ User -->
          

        </ul>
    </div>
    </nav>
    <!-- / Navbar -->
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
        	<div class="row">
</body>
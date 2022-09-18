<!DOCTYPE html>

 -->
<!-- beautify ignore:start -->
<html lang="en" class="light-style  customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

  
<!-- Mirrored from demos.themeselection.com/sneat-bootstrap-html-admin-template-free/html/auth-login-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 18 Aug 2022 08:32:58 GMT -->
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login Basic - Pages | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>
    
    <meta name="description" content="Most Powerful &amp; Comprehensive Bootstrap 5 HTML Admin Dashboard Template built for developers!" />
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
    <!-- Canonical SEO -->
    <link rel="canonical" href="">
    


    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/fonts/boxicons.css" />
    
    

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    
    

    <!-- Page CSS -->
    <!-- Page -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/css/pages/page-auth.css">
    <!-- Helpers -->
    <script src="<?php echo base_url() ?>assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?php echo base_url() ?>assets/js/config.js"></script>


</head>

<body>

  <!-- Content -->

<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            <a href="index.html" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">

                 
              </span>
              <span class="app-brand-text demo text-body fw-bolder">ETH NICS</span>
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-2">Welcome to </h4>
          <p class="mb-4">Ethiopia National ID Card System, Please Sign In</p>

          <form id="formAuthentication" class="mb-3"  method="POST">
            <div class="mb-3">
              <label for="email" class="form-label">Email or Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Enter your email or username" autofocus required>
            </div>
            <div class="mb-3 form-password-toggle">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
                <a href="auth-forgot-password-basic.html">
                  
                </a>
              </div>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required/>
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>
            <div class="mb-3">
              <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
            </div>
          </form>

          <p class="text-center">
            <span>New on our platform?</span>
            <a href="<?php echo base_url(); ?>index.php/citizen">
              <span>Create an account</span>
            </a>
          </p>
        </div>
      </div>
      <!-- /Register -->
    </div>
  </div>
</div>

<!-- / Content -->

  

  

  

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="assets/vendor/libs/jquery/jquery.js"></script>
  <script src="assets/vendor/libs/popper/popper.js"></script>
  <script src="assets/vendor/js/bootstrap.js"></script>
  <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  
  <script src="../assets/vendor/js/menu.js"></script>
  <script src="<?php echo base_url() ?>assets/js/sweetalert.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->
  
  

  <!-- Main JS -->
  <script src="../assets/js/main.js"></script>

  <!-- Page JS -->
  
  
  
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="../../../buttons.github.io/buttons.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
    $("form").submit(function (event) {
      event.preventDefault();
      var formData = {
        username: $("#username").val(),
        password: $("#password").val(),
      };

      var current_url = window.location.href;
      var url = "";
      if (current_url.indexOf('index.php') !== -1) {
          url = "login/authentication";
      }
      else{
          url = "index.php/login/authentication";
      }
  
      $.ajax({
        type: "POST",
        url: url,
        data: formData,
        dataType: "json",
        encode: true,
        success: OnSuccess,
        failure: function (response) {
            alert(response);
        },
        error: function (response) {
            alert(response);
        }
      }).done(function (data) {
        console.log(data);
      });
  
      
    });
  });
    function OnSuccess(response) {
      if(response.success == true){
      Swal.fire('Success', '', 'success').then(function() {
            var model = response;
            window.location = "<?php echo base_url().'index.php/'; ?>" + response.data;      
      });
    }
    else {
      Swal.fire(response.data, '', 'error').then(function() {
               
      });
    }
        
        
    };
</script>
  
</body>
</html>

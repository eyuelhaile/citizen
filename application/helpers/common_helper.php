<?php 


date_default_timezone_set('Africa/Addis_Ababa');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Ethiopian National Identification Card</title>
    
    <meta name="description" content="Most Powerful &amp; Comprehensive Bootstrap 5 HTML Admin Dashboard Template built for developers!" />
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
    <!-- Canonical SEO -->
    <link rel="canonical" href="">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="" />

    <!-- Fonts -->
    

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/fonts/boxicons.css" />
    
    

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/sweetalert.css" />
    <script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>  
    <script type="text/javascript">
        function saveUpdate(url, data)
        {
           $.ajax({
            type:'POST',
            url:url,
            cache : false,
            processData : false, 
            contentType : false, 
            data:data,
            success:function(){
                  //Will be implemented later
                  alert('Successfully Saved/Update');

            }
            });
        }
        function getData(url, params)
        {
           $.ajax({
            type:'POST',
            url:url,
            cache : false,
            processData : false, 
            contentType : false, 
            data:params,
            success:function(f, action){
                  //Will be implemented later
                  return action;

            }
            });
        }
    </script>
    <!-- Page CSS -->
    
    <!-- Helpers -->
    <script src="<?php echo base_url() ?>assets/vendor/js/helpers.js"></script>  
    <script src="<?php echo base_url() ?>assets/js/config.js"></script>
    
   


	 

</head>
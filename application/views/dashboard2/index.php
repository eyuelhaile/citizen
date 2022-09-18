<div class="col-lg-8 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
          <div class="card-body">
            <h5 class="card-title text-primary">Welcome  <?php echo $session['full_name'] ?> 🎉</h5>
            <p class="mb-4">Here you can check out your id card request Progress</p>
            <div class="row justify-content-end">
            <div class="d-grid gap-2 col-sm-6 mx-auto">
              <button type="button" id="varified" name="varified" class="btn btn-outline-danger btn-lg">Varified</button>
            </div>
          </div>

            
          </div>
        </div>
        <div class="col-sm-5 text-center text-sm-left">
          <div class="card-body pb-0 px-0 px-md-4">
            <img src="<?php echo base_url() ?>assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.html">
          </div>
        </div>
      </div>
    </div>
  </div>
<script type="text/javascript">
  function check() {
      $.ajax({
        type: "POST",
        url: 'dashboard2/check_status',
        dataType: "json",
        encode: true,
        success: function (response) {
          if(response.success == true){
           
            $('#varified').html(response.status);
             if($('#varified').hasClass('btn-outline-danger')){
                $('#varified').removeClass('btn-outline-danger');
                if(response.status == 'Pending' || response.status == 'Denied')
                   $('#varified').addClass('btn btn-outline-danger btn-lg');
                 else
                   $('#varified').addClass('btn btn-outline-success btn-lg');
             }
             if($('#varified').hasClass('btn-outline-success')){
                $('#varified').removeClass('btn-outline-success');
                if(response.status == 'Pending' || response.status == 'Denied')
                   $('#varified').addClass('btn btn-outline-danger btn-lg');
                 else
                   $('#varified').addClass('btn btn-outline-success btn-lg');
             }
            

          }
          else {
            $('#varified').html("Simething is wrong please contact system admin");
            $('#varified').addClass('btn btn-outline-danger btn-lg');
           
          }
          
        },
        failure: function (response) {
            console.log("failure");
        },
        error: function (response) {
            console.log("failure");
        }
      }).done(function (data) {
        console.log(data);
      });
    }
    setInterval(check(), 1000);

    
</script>
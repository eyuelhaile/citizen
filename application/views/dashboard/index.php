<div class="col-lg-8 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
          <div class="card-body">
            <h5 class="card-title text-primary">Welcome  <?php echo $session['full_name'] ?> 🎉</h5>
            <p class="mb-4">Thank you for using Ethiopia National ID Card System.</p>

            
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
  <div class="col-lg-4 col-md-4 order-1">
    <div class="row">
      <div class="col-lg-6 col-md-12 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="<?php echo base_url() ?>assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
              </div>
              
            </div>
            <span class="fw-semibold d-block mb-1">Approved Citizen</span>
            <h3 class="card-title mb-2"><?php echo $approved; ?></h3>
            <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> <?php echo $approved_percent; ?>%</small>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-12 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="<?php echo base_url() ?>assets/img/icons/unicons/wallet-info.png" alt="Credit Card" class="rounded">
              </div>
              
            </div>
            <span>Pending Citizen Request</span>
            <h3 class="card-title text-nowrap mb-1"><?php echo $pending ?></h3>
            <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i><?php echo $pending_percent ?>%</small>
          </div>
        </div>
      </div>
    </div>
  </div>
 
  <!--/ Total Revenue -->
  <div class="col-lg-8 mb-4 order-0">
    <div class="row">
      <div class="col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="<?php echo base_url() ?>assets/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded">
              </div>
              
            </div>
            <span class="d-block mb-1">Denied Citizen Requests</span>
            <h3 class="card-title text-nowrap mb-2"><?php echo $denied ?></h3>
            <small class="text-danger fw-semibold"><i class='bx bx-down-arrow-alt'></i> <?php echo $denied_percent ?>%</small>
          </div>
        </div>
      </div>
      <div class="col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="<?php echo base_url() ?>assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded">
              </div>
              
            </div>
            <span class="fw-semibold d-block mb-1">No of Region</span>
            <h3 class="card-title mb-2"><?php echo $region; ?></h3>
            <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> </small>
          </div>
        </div>
      </div>
      <div class="col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="<?php echo base_url() ?>assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded">
              </div>
              
            </div>
            <span class="fw-semibold d-block mb-1">No of Zones</span>
            <h3 class="card-title mb-2"><?php echo $zone; ?></h3>
            <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> </small>
          </div>
        </div>
      </div>
      <div class="col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="<?php echo base_url() ?>assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded">
              </div>
              
            </div>
            <span class="fw-semibold d-block mb-1">No of Woredas</span>
            <h3 class="card-title mb-2"><?php echo $woreda; ?></h3>
            <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> </small>
          </div>
        </div>
      </div>

      
  
    </div>
  </div>
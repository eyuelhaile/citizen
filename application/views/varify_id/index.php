<div class="row">
  <!-- Basic -->
  <div class="col-md-6">
    <div class="card mb-4">
      <h5 class="card-header">Varify with ID Number</h5>
      <div class="card-body demo-vertical-spacing demo-only-element">

        <div class="mb-3 col-md-12">
              <label for="id_number" class="form-label">Scan ID Number</label>
              <input class="form-control" type="text" name="region_name" id="id_number" placeholder="Scan ID Here" />
        </div>
    

      </div>
    </div>
  </div>

  <!-- Merged -->
  <div class="col-md-6">
    <div class="card mb-4">
      <h5 class="card-header">Citizen Information</h5>
        <div class="d-flex align-items-start align-items-sm-center gap-4" >
          <img src="../assets/img/avatars/1.png" id="img" alt="user-avatar" class="d-block rounded" height="150" width="150" id="uploadedAvatar" style="margin: auto;" />
          
        </div>
        <div class="card-body">
        <form id="citizeninfo">
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
            <div class="col-sm-10">
              <input type="text" id="name" name="name" class="form-control" id="basic-default-name"  readonly />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-company">ID Number</label>
            <div class="col-sm-10">
              <input type="text" name="id", id="id" class="form-control" id="basic-default-company"  readonly/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-email">Address</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">
                <input type="text" id="address" class="form-control" readonly />
              </div>
              
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-phone">Exp Date</label>
            <div class="col-sm-10">
              <input type="text" id="expire_date" class="form-control phone-mask" readonly />
            </div>
          </div>
        
          <div class="row justify-content-end">
            <div class="d-grid gap-2 col-sm-6 mx-auto">
              <button type="button" id="varified" name="varified" class="btn btn-outline-danger btn-lg">Varified</button>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>


</div>

<script type="text/javascript">
  $("#id_number").on('keyup', function () {
    var id_number = $(this).val();
    if(id_number.length >= 11){
      $.ajax({
        type: "POST",
        url: 'varify_id/varify',
        data: {id: id_number},
        dataType: "json",
        encode: true,
        success: function (response) {
          if(response.success == true){
            $("#img").attr("src", response.profile_pic);
            $('#name').val(response.full_name);
            $('#id').val(response.id_number);
            $('#address').val(response.address);
            $('#expire_date').val(response.exp_date);
            $('#varified').html("Varified");
             if($('#varified').hasClass('btn-outline-danger')){
                $('#varified').removeClass('btn-outline-danger');
                $('#varified').addClass('btn btn-outline-success btn-lg');
             }
             if($('#varified').hasClass('btn-outline-warning')){
                $('#varified').removeClass('btn-outline-warning');
                $('#varified').addClass('btn btn-outline-success btn-lg');
             }
            

          }
          else {
            $('#varified').html("Not Varified");
            if($('#varified').hasClass('btn-outline-success')){
                $('#varified').removeClass('btn-outline-success');
                $('#varified').addClass('btn btn-outline-danger btn-lg');
             }
             $('#name').val(response.full_name);
            $('#id').val(response.id_number);
            $('#address').val(response.address);
            $('#expire_date').val(response.exp_date);
            $("#img").attr("src", "");
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
   
      
   });
      

      
  

    
</script>
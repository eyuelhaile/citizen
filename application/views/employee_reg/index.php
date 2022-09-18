<div class="card mb-4">
      <h5 class="card-header">Profile Details</h5>
      <!-- Account -->
      <div class="card-body">
        <form id="formAccountSettings" method="POST">
        <div class="d-flex align-items-start align-items-sm-center gap-4">
          <img src="../assets/img/avatars/user.png" id="img" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
          <div class="button-wrapper">
            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
              <span class="d-none d-sm-block">Upload new photo</span>
              <i class="bx bx-upload d-block d-sm-none"></i>
              <input type="file" id="upload" name="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
            </label>
            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
              <i class="bx bx-reset d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Reset</span>
            </button>

            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
          </div>
        </div>
      </div>
      <hr class="my-0">
      <div class="card-body">
        
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="firstName" class="form-label">First Name</label>
              <input class="form-control" type="text" id="firstName" name="firstName" placeholder="First Name" autofocus required />
            </div>
            <div class="mb-3 col-md-6">
              <label for="lastName" class="form-label">Last Name</label>
              <input class="form-control" type="text" name="lastName" id="lastName" placeholder="Last Name" required/>
            </div>
            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">E-mail</label>
              <input class="form-control" type="text" id="email" name="email"  placeholder="john.doe@example.com" required/>
            </div>
            <div class="mb-3 col-md-6">
              <label for="organization" class="form-label">Age</label>
              <input type="number" class="form-control" id="age" name="age" value="Age" required/>
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="phoneNumber">Phone Number</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text">ETH (+251)</span>
                <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" placeholder="913 *** ***" />
              </div>
            </div>
            <div class="mb-3 col-md-6">
              <label for="sex" class="form-label">Sex</label>
              <select id="sex" name="sex" class="select2 form-select">
                <option value="-1">Select Sex</option>
                <option value="1">Male</option>
                <option value="0">Female</option>
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="country">Region</label>
              <select id="region" name="region" class="select2 form-select">
                
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="language" class="form-label">Zone</label>
              <select id="zone" name="zone" class="select2 form-select">
                <option value="-1">Please select region first</option>
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="timeZones" class="form-label">Woreda</label>
              <select id="woreda" name="woreda" class="select2 form-select">
                <option value="-1">Please select zone first</option>
                
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="kebele" class="form-label">Kebele</label>
              <input class="form-control" type="text" id="kebele" name="kebele"  />
            </div>
            <div class="mb-3 col-md-6">
              <label for="username" class="form-label">Username</label>
              <input class="form-control" type="text" id="username" name="username" placeholder="Username" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="role" class="form-label">Role</label>
              <select id="role" name="role" class="select2 form-select">
                <option value="-1">Role not available</option>
              </select>
            </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Save changes</button>
            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
          </div>
        </form>
      </div>
      <!-- /Account -->
    </div>
    <script type="text/javascript">
     var check_edit = "<?php if($employee['id'] == 0) echo 0; else echo 1;?>";
     console.log(check_edit);
    $(document).ready(function () {
        $("#region").change(function(){
        var region_id = $(this).val();
        $.ajax({
            url: 'employee_reg/zone_list',
            type: 'POST',
            data: {region_id: region_id},
            dataType: 'json',
            success:function(response){

                var len = response.data.length;

                $("#zone").empty();
                for( var i = 0; i<len; i++){
                    var id = response.data[i]['id'];
                    var name = response.data[i]['description'];
                    
                    $("#zone").append("<option value='"+id+"'>"+name+"</option>");

                }
            }
          });
        
        });
        $("#zone").change(function(){
        var zone_id = $(this).val();
        //console(zone_id);
        $.ajax({
            url: 'employee_reg/woreda_list',
            type: 'POST',
            data: {zone_id: zone_id},
            dataType: 'json',
            success:function(response){

                var len = response.data.length;

                $("#woreda").empty();
                for( var i = 0; i<len; i++){
                    var id = response.data[i]['id'];
                    var name = response.data[i]['description'];
                    
                    $("#woreda").append("<option value='"+id+"'>"+name+"</option>");

                }
            }
          });
        
        });
        $.ajax({
            url: 'employee_reg/region_list',
            type: 'POST',
            dataType: 'json',
            success:function(response){

                var len = response.data.length;
                console.log(response);

                $("#region").empty();
                for( var i = 0; i<len; i++){
                    var id = response.data[i]['id'];
                    var name = response.data[i]['description'];
                    
                    $("#region").append("<option value='"+id+"'>"+name+"</option>");

                }
            }
        });
        $.ajax({
            url: 'employee_reg/role_list',
            type: 'POST',
            dataType: 'json',
            success:function(response){

                var len = response.data.length;

                $("#role").empty();
                for( var i = 0; i<len; i++){
                    var id = response.data[i]['id'];
                    var name = response.data[i]['description'];
                    
                    $("#role").append("<option value='"+id+"'>"+name+"</option>");

                }
            }
        });
     $("form").submit(function (event) {
      event.preventDefault();
      var formData = {
        id       : (check_edit) ? "<?php echo $employee['id']; ?>" : 0,
        firstName: $("#firstName").val(),
        lastName: $("#lastName").val(),
        email: $("#email").val(),
        phoneNumber: $("#phoneNumber").val(),
        age: $("#age").val(),
        sex: $("#sex").children("option:selected").val(),
        region: $("#region").children("option:selected").val(),
        zone: $("#zone").children("option:selected").val(),
        woreda: $("#woreda").children("option:selected").val(),
        role: $("#role").children("option:selected").val(),
        username: $("#username").val(),
        kebele: $("#kebele").val(),
        upload: $("#upload"),
      };
      var save_url = "";
      if(check_edit == 1) save_url = "employee_reg/update_employee";
      else save_url = "employee_reg/save_employee";
      console.log(save_url);
      formData2 = new FormData(this);
      if(check_edit == 1)
         formData2.append('id', "<?php echo $employee['id']; ?>");
      $.ajax({
        type: "POST",
        url: save_url,
        data: formData2,
        processData: false,
        contentType: false,
        dataType: "json",
        encode: true,
        cache: false,
        success: function (response) {
          Swal.fire(response.data, '', 'success').then(function() {
            window.location.href = "<?php echo base_url(); ?>" + "index.php/employee_view";
          });
          
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
      

      
    });
     if(check_edit){
        $("#firstName").val("<?php echo $employee['fname']; ?>");
        $("#lastName").val("<?php echo $employee['lname']; ?>");
        $("#email").val("<?php echo $employee['email']; ?>");
        $("#age").val("<?php echo $employee['age']; ?>");
        $("#phoneNumber").val("<?php echo $employee['phoneNumber']; ?>");
        $("#sex").val("<?php echo $employee['sex']; ?>");
        $("#kebele").val("<?php echo $employee['kebele']; ?>");
        $("#username").val("<?php echo $employee['username']; ?>");
        $("#region").val("<?php echo $employee['region_id']; ?>");
        $("#zone").val("<?php echo $employee['zone_id']; ?>");
        $("#woreda").val("<?php echo $employee['woreda_id']; ?>");
        $("#img").attr("src", "<?php echo $employee['profile_pic']; ?>");
     }
  });
    function OnSuccess(response) {
        var model = response;
        window.location = "<?php echo base_url().'index.php/'; ?>" + response.data;
        
    };
    document.getElementById('upload').onchange = function (evt) {
    var tgt = evt.target || window.event.srcElement,
        files = tgt.files;
    
    // FileReader support
    if (FileReader && files && files.length) {
        var fr = new FileReader();
        fr.onload = function () {
            document.getElementById('img').src = fr.result;
        }
        fr.readAsDataURL(files[0]);
    }
    
    // Not supported
    else {
        // fallback -- perhaps submit the input to an iframe and temporarily store
        // them on the server until the user's session ends.
    }
}

</script>
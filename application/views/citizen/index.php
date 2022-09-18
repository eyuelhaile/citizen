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
              <input class="form-control" type="text" id="firstName" name="firstName" placeholder="First Name" autofocus />
            </div>
            <div class="mb-3 col-md-6">
              <label for="middleName" class="form-label">Middle Name</label>
              <input class="form-control" type="text" name="middleName" id="middleName" placeholder="Middle Name" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="lastName" class="form-label">Last Name</label>
              <input class="form-control" type="text" name="lastName" id="lastName" placeholder="Last Name" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="motherName" class="form-label">Mother Full Name</label>
              <input class="form-control" type="text" name="motherName" id="motherName" placeholder="Mother Full Name" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">E-mail</label>
              <input class="form-control" type="text" id="email" name="email"  placeholder="john.doe@example.com" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="organization" class="form-label">Age</label>
              <input type="number" class="form-control" id="age" name="age" value="Age" />
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
              <label class="form-label" for="country">Nationality</label>
              <select id="nationality" name="nationality" class="select2 form-select">
                
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
              <input class="form-control" type="number" id="kebele" name="kebele"  />
            </div>
            <div class="mb-3 col-md-6">
              <label for="maritalStatus" class="form-label">Marital Status</label>
              <select id="maritalStatus" name="maritalStatus" class="select2 form-select">
                <option>Select Marital Status</option>
                <option>Single</option>
                <option>Married</option>
                <option>Divorced</option>
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="educationalStatus" class="form-label">Educational Status</label>
              <select id="educationalStatus" name="educationalStatus" class="select2 form-select">
                <option>Select Educational Status</option>
                <option>Illiterate</option>
                <option>Elemtary</option>
                <option>High School</option>
                <option>Diploma</option>
                <option>Degree</option>
                <option>Masters</option>
                <option>Doctoral</option>
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="profession" class="form-label">Profession</label>
              <input class="form-control" type="text" id="profession" name="profession" placeholder="Profession" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="workplace" class="form-label">Workplace</label>
              <input class="form-control" type="text" id="workplace" name="workplace" placeholder="Workplace" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="username" class="form-label">Username</label>
              <input class="form-control" type="text" id="username" name="username" placeholder="Username" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="password" class="form-label">Password</label>
              <input class="form-control" type="text" id="password" name="password" placeholder="Password" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="bloodType" class="form-label">Blood Type</label>
              <select id="bloodType" name="bloodType" class="select2 form-select">
                <option >Select Blood Type</option>
                <option >A</option>
                <option >B</option>
                <option >A-</option>
                <option >B-</option>
                <option >A+</option>
                <option >B+</option>
                <option >AB</option>
                <option >O+</option>
                <option >O-</option>
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
            url: 'citizen_reg/nationality_list',
            type: 'POST',
            dataType: 'json',
            success:function(response){

                var len = response.data.length;
                console.log(response);

                $("#nationality").empty();
                for( var i = 0; i<len; i++){
                    var id = response.data[i]['id'];
                    var name = response.data[i]['description'];
                    
                    $("#nationality").append("<option value='"+id+"'>"+name+"</option>");

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
     formData2 = new FormData(this);
      $.ajax({
        type: "POST",
        url: "citizen_reg/save_citizen",
        data: formData2,
        processData: false,
        contentType: false,
        dataType: "json",
        encode: true,
        cache: false,
        success: function (response) {
          Swal.fire(response.data, '', 'success').then(function() {
            window.location.href = "<?php echo base_url(); ?>";
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
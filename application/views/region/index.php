<div class="row">
  <!-- Basic -->
  <div class="col-md-6">
    <div class="card mb-4">
      <h5 class="card-header">Add/Edit Region</h5>
      <div class="card-body demo-vertical-spacing demo-only-element">
        <form id="formAccountSettings" method="POST">
        <div class="mb-3 col-md-12">
              <label for="region_name" class="form-label">Region Name</label>
              <input class="form-control" type="text" name="region_name" id="region_name" placeholder="Region Name" />
        </div>
        <div class="mb-3 col-md-12">
              <label for="region_code" class="form-label">Region Code</label>
              <input class="form-control" type="text" name="region_code" id="region_code" placeholder="Region Code" />
        </div>
        <input type="hidden" name="id" id="id">
        <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Save changes</button>
            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
        </div>
        
        </form>

      </div>
    </div>
  </div>

  <!-- Merged -->
  <div class="col-md-6">
    <div class="card mb-4">
      <h5 class="card-header">Region List</h5>
      <div class="table-responsive text-nowrap">
    <table class="table" id="region">
      <thead>
        <tr class="text-nowrap">
          <th>#</th>
          <th>Region Name</th>
          <th>Region Code</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Table cell</td>
          <td>Table cell</td>
          <td>
          <div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i>Edit</a>
              <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
            </div>
          </div>
        </td>
        </tr>
     
      </tbody>
    </table>
  </div>
    </div>
  </div>


</div>

<script type="text/javascript">
    $(document).ready(function () {
        
        $.ajax({
            url: 'region/region_list',
            type: 'POST',
            dataType: 'json',
            success:function(response){

                var len = response.data.length;

                var model = response.data;
                var row = $("#region tbody tr:last-child").removeAttr("style").clone(true);
                $("#region tr").not($("#region thead tr:first-child")).remove();

                
                var i = 1;
                $.each(model, function () {
                    var user = this;
                    var last_column = '<div class="dropdown">'+
                                  '<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>'+
                                  '<div class="dropdown-menu">'+
                                    '<a class="dropdown-item" onClick="editLoad('+user.id+', \'' +user.description+ '\', \'' +user.region_code+ '\');"><i class="bx bx-edit-alt me-1"></i>Edit</a>'+
                                    '<a class="dropdown-item" onClick="deleteRegion('+user.id+')"><i class="bx bx-trash me-1"></i> Delete</a>'+
                                  '</div>'+
                                '</div>';
                    $("th", row).eq(0).html(i);
                    $("td", row).eq(1).html(user.description);
                    $("td", row).eq(2).html(user.region_code);
                    $("td", row).eq(3).html(last_column);
                    $("#region").append(row);
                    row = $("#region tbody tr:last-child").clone(true);
                    i++;
                });
            }
        });
      
  });
  $("form").submit(function (event) {
      event.preventDefault();
      var save_url = "";
      var check_edit = 0;
      if(!$("#id").val()) save_url = "region/save_region";
      else save_url = "region/update_region";
      formData2 = new FormData(this);
      //if($("#id").val() != null)
         //formData2.append('id', $("#id").val());
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
            window.location.href = "<?php echo base_url(); ?>" + "index.php/region";
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
    function editLoad(id, region_name, region_code){
      console.log(region_code);
      $("#id").val(id);
      $("#region_name").val(region_name);
      $("#region_code").val(region_code);
    };
    function deleteRegion(id) {
        Swal.fire({
         title: 'Are you sure you want to Delete?',
         showDenyButton: true,
         confirmButtonText: 'Yes',
         denyButtonText: `No`,
       }).then((result) => {
         if (result.isConfirmed) {
           $.ajax({
              type: "POST",
              url: "region/region_delete",
              data: {id: id},
              dataType: "json",
              encode: true,
              success: function (response) {
                if(response.success == true){
                  Swal.fire(response.data, '', 'success').then(function() {;
                  window.location.href = "<?php echo base_url(); ?>" + "index.php/region";
                  });
                }
                else {
                  Swal.fire(response.data, '', 'error').then(function() {;
                   window.location.href = "<?php echo base_url(); ?>" + "index.php/region";
                  });
                }
                
              },
              failure: function (response) {
                  Swal.fire("Error", '', 'error');
              },
              error: function (response) {
                  console.log("failure");
              }
            }).done(function (data) {
              console.log(data);
            });
           
         } else if (result.isDenied) {
           Swal.fire('Changes are not saved', '', 'info')
         }
       })
    };
    function pagination(){
      $(document).ready(function(){
        $('#region').after('<div id="nav"></div>');
        var rowsShown = 15;
        var rowsTotal = $('#region tbody tr').length;
        var numPages = rowsTotal/rowsShown;
        for(i = 0;i < numPages;i++) {
            var pageNum = i + 1;
            $('#nav').append('<a href="#" rel="'+i+'">'+pageNum+'</a> ');
        }
        $('#region tbody tr').hide();
        $('#region tbody tr').slice(0, rowsShown).show();
        $('#nav a:first').addClass('active');
        $('#nav a').bind('click', function(){

            $('#nav a').removeClass('active');
            $(this).addClass('active');
            var currPage = $(this).attr('rel');
            var startItem = currPage * rowsShown;
            var endItem = startItem + rowsShown;
            $('#region tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).
            css('display','table-row').animate({opacity:1}, 300);
        });
      });
    }

    
</script>
<div class="row">
  <!-- Basic -->
  <div class="col-md-6">
    <div class="card mb-4">
      <h5 class="card-header">Add/Edit Zone</h5>
      <div class="card-body demo-vertical-spacing demo-only-element">
        <form id="formAccountSettings" method="POST">
        <div class="mb-3 col-md-12">
              <label class="form-label" for="country">Region</label>
              <select id="region" name="region" class="select2 form-select">
                
              </select>
        </div>
        <div class="mb-3 col-md-12">
              <label for="zone_name" class="form-label">Zone Name</label>
              <input class="form-control" type="text" name="zone_name" id="zone_name" placeholder="Zone Name" />
        </div>
        <div class="mb-3 col-md-12">
              <label for="zone_code" class="form-label">Zone Code</label>
              <input class="form-control" type="text" name="zone_code" id="zone_code" placeholder="Zone Code" />
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
      <h5 class="card-header">Zone List</h5>
      <div class="table-responsive text-nowrap">
    <table class="table" id="zone">
      <thead>
        <tr class="text-nowrap">
          <th>#</th>
          <th>Region Name</th>
          <th>Zone Name</th>
          <th>Zone Code</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Table cell</td>
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
            url: 'zone/zone_list',
            type: 'POST',
            dataType: 'json',
            success:function(response){

                var len = response.data.length;
                var model = response.data;
                var row = $("#zone tbody tr:last-child").removeAttr("style").clone(true);
                $("#zone tr").not($("#zone thead tr:first-child")).remove();

                
                var i = 1;
                $.each(model, function () {
                    var user = this;
                    var last_column = '<div class="dropdown">'+
                                  '<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>'+
                                  '<div class="dropdown-menu">'+
                                    '<a class="dropdown-item" onClick="editLoad('+user.id+', \'' +user.description+ '\', \'' +user.zone_code+ '\',\'' +user.region_id+ '\');"><i class="bx bx-edit-alt me-1"></i>Edit</a>'+
                                    '<a class="dropdown-item" onClick="deleteZone('+user.id+')"><i class="bx bx-trash me-1"></i> Delete</a>'+
                                  '</div>'+
                                '</div>';
                    $("th", row).eq(0).html(i);
                    $("td", row).eq(1).html(user.region);
                    $("td", row).eq(2).html(user.description);
                    $("td", row).eq(3).html(user.zone_code);
                    $("td", row).eq(4).html(last_column);
                    $("#zone").append(row);
                    row = $("#zone tbody tr:last-child").clone(true);
                    i++;
                });
                pagination();
            }
        });
      
  });
  $("form").submit(function (event) {
      event.preventDefault();
      var save_url = "";
      var check_edit = 0;
      console.log($("#id").val());
      if(!$("#id").val()) save_url = "zone/save_zone";
      else save_url = "zone/update_zone";
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
            window.location.href = "<?php echo base_url(); ?>" + "index.php/zone";
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
    function editLoad(id, zone_name, zone_code, region_id){
      $("#id").val(id);
      $("#zone_name").val(zone_name);
      $("#zone_code").val(zone_code);
      //$('#region option:eq('+region_id+')').prop('selected', true);
      $('#region option[value="'+region_id+'"]').attr("selected", "selected");
    };
    function deleteZone(id) {
        Swal.fire({
         title: 'Are you sure you want to Delete?',
         showDenyButton: true,
         confirmButtonText: 'Yes',
         denyButtonText: `No`,
       }).then((result) => {
         if (result.isConfirmed) {
           $.ajax({
              type: "POST",
              url: "zone/zone_delete",
              data: {id: id},
              dataType: "json",
              encode: true,
              success: function (response) {
                if(response.success == true){
                  Swal.fire(response.data, '', 'success').then(function() {;
                  window.location.href = "<?php echo base_url(); ?>" + "index.php/zone";
                  });
                }
                else {
                  Swal.fire(response.data, '', 'error').then(function() {;
                   window.location.href = "<?php echo base_url(); ?>" + "index.php/zone";
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
        $('#zone').after('<div id="nav"></div>');
        var rowsShown = 15;
        var rowsTotal = $('#zone tbody tr').length;
        var numPages = rowsTotal/rowsShown;
        for(i = 0;i < numPages;i++) {
            var pageNum = i + 1;
            $('#nav').append('<a href="#" rel="'+i+'">'+pageNum+'</a> ');
        }
        $('#zone tbody tr').hide();
        $('#zone tbody tr').slice(0, rowsShown).show();
        $('#nav a:first').addClass('active');
        $('#nav a').bind('click', function(){

            $('#nav a').removeClass('active');
            $(this).addClass('active');
            var currPage = $(this).attr('rel');
            var startItem = currPage * rowsShown;
            var endItem = startItem + rowsShown;
            $('#zone tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).
            css('display','table-row').animate({opacity:1}, 300);
        });
      });
    }
    

    
</script>
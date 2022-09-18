<div class="card">
  <h5 class="card-header">Citizen Request List</h5>
  <div class="table-responsive text-nowrap">
    <table class="table" id="citizen">
      <thead>
        <tr class="text-nowrap">
          <th>#</th>
          <th>Full Name</th>
          <th>Sex</th>
          <th>Age</th>
          <th>Region</th>
          <th>Zone</th>
          <th>Woreda</th>
          <th>Kebele</th>
          <th>Phone</th>
          <th>ID No</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Table cell</td>
          <td>Table cell</td>
          <td>Table cell</td>
          <td>Table cell</td>
          <td>Table cell</td>
          <td>Table cell</td>
          <td>Table cell</td>
          <td>Table cell</td>
          <td>Table cell</td>
          <td><span class="badge bg-label-success me-1">Completed</span></td>
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
<script type="text/javascript">
    $(document).ready(function () {
        
        $.ajax({
            url: 'citizen_view/citizen_list',
            type: 'POST',
            dataType: 'json',
            success:function(response){

                var len = response.data.length;

                var model = response.data;
                var row = $("#citizen tbody tr:last-child").removeAttr("style").clone(true);
                $("#citizen tr").not($("#citizen thead tr:first-child")).remove();

                
                var i = 1;
                $.each(model, function () {
                  console.log(i);
                    var user = this;
                    var last_column = '<div class="dropdown">'+
                                  '<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>'+
                                  '<div class="dropdown-menu">'+
                                    '<a class="dropdown-item" onClick="approveEmp('+user.id+')"><i class="bx bx-edit-alt me-1"></i>Approve</a>'+
                                    '<a class="dropdown-item" onClick="denyEmp('+user.id+')"><i class="bx bx-trash me-1"></i> Deny</a>'+
                                    '<a class="dropdown-item" onClick="printID('+user.id+')"><i class="bx bx-printer me-1"></i> Print ID</a>'+
                                  '</div>'+
                                '</div>';
                      var status = '<span class="'+user.status_label+'">'+user.status+'</span>';
                    $("th", row).eq(0).html(i);
                    $("td", row).eq(1).html(user.full_name);
                    $("td", row).eq(2).html(user.sex);
                    $("td", row).eq(3).html(user.age);
                    $("td", row).eq(4).html(user.region);
                    $("td", row).eq(5).html(user.zone);
                    $("td", row).eq(6).html(user.woreda);
                    $("td", row).eq(7).html(user.kebele);
                    $("td", row).eq(8).html(user.phone_no);
                    $("td", row).eq(9).html(user.citizen_id);
                    $("td", row).eq(10).html(status);
                    $("td", row).eq(11).html(last_column);
                    $("#citizen").append(row);
                    row = $("#citizen tbody tr:last-child").clone(true);
                    i++;
                });
            }
        });
      
  });
     function OnSuccess(response) {
        var model = response.data;
        var row = $("#employee tr:last-child").removeAttr("style").clone(true);
        $("#employee tr").not($("#employee tr:first-child")).remove();
        var i = 1;
        $.each(model, function () {
            var user = this;
            $("td", row).eq(0).html(i);
            $("td", row).eq(1).html(user.user_id);
            $("td", row).eq(2).html(user.api_key);
            $("td", row).eq(3).html(user.session_path);
            $("td", row).eq(4).html(user.status);
            $("#employee").append(row);
            row = $("#employee tr:last-child").clone(true);
            i++;
        });
    };
    function approveEmp(id) {
        Swal.fire({
         title: 'Are you sure you want to Approve?',
         showDenyButton: true,
         confirmButtonText: 'Yes',
         denyButtonText: `No`,
       }).then((result) => {
         if (result.isConfirmed) {
           $.ajax({
              type: "POST",
              url: "citizen_view/citizen_approve",
              data: {id: id},
              dataType: "json",
              encode: true,
              success: function (response) {
                  Swal.fire(response.data, '', 'success');
                  window.location.href = "<?php echo base_url(); ?>" + "index.php/citizen_view";
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
    function denyEmp(id) {
        Swal.fire({
         title: 'Are you sure you want to Deny?',
         showDenyButton: true,
         confirmButtonText: 'Yes',
         denyButtonText: `No`,
       }).then((result) => {
         if (result.isConfirmed) {
           $.ajax({
              type: "POST",
              url: "citizen_view/citizen_deny",
              data: {id: id},
              dataType: "json",
              encode: true,
              success: function (response) {
                  Swal.fire(response.data, '', 'success');
                  window.location.href = "<?php echo base_url(); ?>" + "index.php/citizen_view";
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
    function printID(id) {
        Swal.fire({
         title: 'Are you sure you want to Print id card?',
         showDenyButton: true,
         confirmButtonText: 'Yes',
         denyButtonText: `No`,
       }).then((result) => {
         if (result.isConfirmed) {
           $.ajax({
              type: "POST",
              url: "citizen_view/exportpdfIDNational",
              data: {id: id},
              dataType: "json",
              encode: true,
              success: function (response) {
                if(response.success == false){
                  Swal.fire(response.data, '', 'error');
                }
                else {
                  window.open("<?php echo base_url(); ?>" + response.filename, 'PDFWindow', 'toolbar=0,menubar=0,location=0,di rectories=0,status=0,resizable=0');
                  //Swal.fire(response.data, '', 'success');
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

    
</script>
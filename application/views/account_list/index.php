<div class="card">
  <h5 class="card-header">Account List</h5>
  <div class="table-responsive text-nowrap">
    <table class="table" id="accounts">
      <thead>
        <tr class="text-nowrap">
          <th>#</th>
          <th>Full Name</th>
          <th>Username</th>
          <th>Email</th>
          <th>Password</th>
          <th>type</th>
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
  <div class="col-lg-4 col-md-6">
        <small class="text-light fw-semibold">Vertically centered</small>
        <div class="mt-3">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
            Launch modal
          </button>

          <!-- Modal -->
          <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form id="form" method="post">
                    <input type="hidden" name="id" id="id">
                  <div class="row">
                    <div class="col mb-3">
                      <label for="nameWithTitle" class="form-label">Name</label>
                      <input type="text" id="nameWithTitle" class="form-control" placeholder="Enter Name" disabled>
                    </div>
                  </div>
                 <div class="row">
                    <div class="col mb-3">
                      <label for="nameWithTitle" class="form-label">New Password</label>
                      <input type="text" id="password" name="password" class="form-control" placeholder="New Password">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Change Password</button>
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        
        $.ajax({
            url: 'account_list/accounts',
            type: 'POST',
            dataType: 'json',
            success:function(response){

                var len = response.data.length;

                var model = response.data;
                var row = $("#accounts tbody tr:last-child").removeAttr("style").clone(true);
                console.log(row);
                $("#accounts tr").not($("#accounts thead tr:first-child")).remove();

                
                var i = 1;
                $.each(model, function () {
                    var user = this;
                    var last_column = '<div class="dropdown">'+
                                  '<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>'+
                                  '<div class="dropdown-menu">'+
                                    '<a class="dropdown-item" data-id="'+user.id+'" data-bs-toggle="modal" data-bs-target="#modalCenter"><i class="bx bx-edit-alt me-1"></i>Change Password</a>'+
                                    '<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalCenter"><i class="bx bx-trash me-1"></i> Active/Deactive</a>'+
                                  '</div>'+
                                '</div>';
                    $("th", row).eq(0).html(i);
                    $("td", row).eq(1).html(user.full_name);
                    $("td", row).eq(2).html(user.username);
                    $("td", row).eq(3).html(user.email);
                    $("td", row).eq(4).html(user.password);
                    $("td", row).eq(5).html(user.type);
                    $("td", row).eq(6).html(last_column);
                    $("#accounts").append(row);
                    row = $("#accounts tbody tr:last-child").clone(true);
                    i++;
                });
            }
        });
      
  });
    $('#modalCenter').on('data-bs-toggle', function(e) {
        //get data-id attribute of the clicked element
        var id = $(e.relatedTarget).data('id');
        console.log("id: " + id);
        //populate the textbox
        //$(e.currentTarget).find('input[name="bookId"]').val(bookId);
    });

    function changePassword(id) {
        Swal.fire({
         title: 'Are you sure you want to delete?',
         showDenyButton: true,
         confirmButtonText: 'Yes',
         denyButtonText: `No`,
       }).then((result) => {
         if (result.isConfirmed) {
           $.ajax({
              type: "POST",
              url: "employee_view/employee_delete",
              data: {id: id},
              dataType: "json",
              encode: true,
              success: function (response) {
                  Swal.fire(response.data, '', 'success');
                  window.location.href = "<?php echo base_url(); ?>" + "index.php/employee_view";
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
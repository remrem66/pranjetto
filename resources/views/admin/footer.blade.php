<footer class="main-footer">
    
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

<!-- jQuery -->
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('admin/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('admin/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('admin/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('admin/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('admin/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('admin/plugins/toastr/toastr.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('admin/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('admin/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin/dist/js/demo.js')}}"></script>
<!-- DataTables -->
<!-- <script src="{{asset('admin/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script> -->

<script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('js/datatables.min.js')}}"></script>
<!-- Sweet Alert -->
<script src="{{asset('admin/sweetalert/sweetalert2.all.min.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script>

 $(function () {

$('#room').DataTable({

    dom: 'Bfrtip',
    buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
});

var sales =  $('#sales').DataTable({

    dom: 'Bfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ],
    columns: [
        {
            title: "Description",
            data: "description"
        },
        {
          title: "Amount",
          data: "sales_amount"
        },
        {
          title: "Date",
          data: "date"
        }
    ],
    ajax: {
        url : "/getSales/0", dataSrc : ""
    },
    deferRender: true,
    aaSorting: []
});

$("#btnDaily").on('click', function() {
  sales.ajax.url("/getSales/0").load();
});

$("#btnWeekly").on('click', function() {
  sales.ajax.url("/getSales/1").load();
});

$("#btnMonthly").on('click', function() {
  sales.ajax.url("/getSales/2").load();
});

// var r = new XMLHttpRequest(); r.open("POST", "/getSales/", true);
// r.onreadystatechange = function () {   if (r.readyState != 4 || r.status !=
// 200) return;   alert("Success: " + r.responseText); };
// r.send("banana=yellow");

});

  $(document).ready(function () {
    bsCustomFileInput.init();
  });

  @if(Session::has('message'))
    var type = "{{Session::get('alert-type', 'info')}}";
    switch(type){
        case 'info':
            toastr.info("{{Session::get('message')}}");
            break;
        
        case 'warning':
            toastr.warning("{{Session::get('message')}}");
            break;

        case 'success':
            toastr.success("{{Session::get('message')}}");
            break;

        case 'error':
            toastr.error("{{Session::get('message')}}");
            break;
    }
  @endif

  $('.RoomStatus').click(function(e){
    e.preventDefault();

    var data = $(this).attr("id");
    data = data.split("-");
    var room_id = data[0];
    var status = data[1];

    if(status == 0){
      Swal.fire({
        title: 'Are you sure?',
        text: "You want to disable this room?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, disable it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: '{{route("ChangeRoomStatus")}}',
            type: 'GET',
            data: {
              status: status,
              room_id: room_id
            },
            dataType: 'HTML',
            success: function(response){
              Swal.fire({
                title: "Successfuly Disabled!",
                icon: 'success', 
                type: "success"
              })
              .then(function(){
                  location.reload();
              });
            }
          })
        }
      })
    }
    else{
      Swal.fire({
        title: 'Are you sure?',
        text: "You want to enable this room?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, enable it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: '{{route("ChangeRoomStatus")}}',
            type: 'GET',
            data: {
              status: status,
              room_id: room_id
            },
            dataType: 'HTML',
            success: function(response){
              Swal.fire({
                title: "Successfuly Enabled!",
                icon: 'success', 
                type: "success"
              })
              .then(function(){
                  location.reload();
              });
            }
          })
        }
      })
    }
  })

  $('.RoomEdit').click(function(e){
    e.preventDefault();

    var room_id = $(this).attr("id");

    $.ajax({
      url: '{{route("GetRoomInfo")}}',
      type: 'GET',
      data: {
        room_id: room_id
      },
      dataType: 'JSON',
      success: function(response){
        document.getElementById("room_num").value = response.room_num;
        document.getElementById("floor").value = response.floor;
        document.getElementById("room_name").value = response.room_name;
        document.getElementById("category").value = response.category;
        document.getElementById("capacity").value = response.capacity;
        document.getElementById("12hr_price").value = response.twelvehr_price;
        document.getElementById("24hr_price").value = response.twentyfourhr_price;
        document.getElementById("description").value = response.description;
        document.getElementById("room_id").value = response.room_id;
      }
    })
  })

  $('.SaveRoomEdit').click(function(e){
    var form = $('form')[0]; // You need to use standard javascript object here
    var formData = new FormData(form);
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to edit this room?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, save changes!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: '{{route("EditRoom")}}',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'HTML',
            success: function(response){
              Swal.fire({
                title: "Successfuly Edited!",
                icon: 'success', 
                type: "success"
              })
              .then(function(){
                  location.reload();
              });
            }
          })
        }
      })
  })

  $('.PictureModification').click(function(e){
    e.preventDefault();

    var room_id = $(this).attr("id");

    document.getElementById("picroom_id").value = room_id;
  })

  $('.SavePictures').click(function(e){

    var form = $('form')[1]; // You need to use standard javascript object here
    var formData = new FormData(form);
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to upload all these pictures?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, upload!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: '{{route("UploadPictures")}}',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'HTML',
            success: function(response){
              Swal.fire({ title: "Successfuly uploaded!", type: "success" });
              window.setTimeout(function(){ 
                location.reload();
              } ,1300);
            }
          })
        }
      })

  })

  $('.initialpay').click(function(e){

    Swal.fire({
        title: 'Are you sure?',
        text: "You want to confirm initial payment?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
      }).then((result) => {
        if (result.value) {
          var data = $(this).attr("id");
          data = data.split("-");

          var reservation_id = data[0];
          var price = data[1];
          var name = data[2];

          $.ajax({
            url: '{{route("ConfirmInitial")}}',
            type: 'GET',
            data: {
              reservation_id: reservation_id,
              price: price,
              name: name
            },
            dataType: 'HTML',
            success: function(response){
              Swal.fire({
                title: "Successfully Confirmed!",
                icon: 'success', 
                type: "success"
              })
              .then(function(){
                  location.reload();
              });
            }
          })
        }
      })
  })

  $('.completionofblance').click(function(e){

    Swal.fire({
        title: 'Are you sure?',
        text: "You want to complete payment?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
      }).then((result) => {
        if (result.value) {
          var data = $(this).attr("id");
          data = data.split("-");
        
          var reservation_id = data[0];
          var price = data[1];
          var name = data[2];
        
          $.ajax({
            url: '{{route("CompletePayment")}}',
            type: 'GET',
            data: {
              reservation_id: reservation_id,
              price: price,
              name: name
            },
            dataType: 'HTML',
            success: function(response){
              Swal.fire({
                title: "Successfully Confirmed!",
                icon: 'success', 
                type: "success"
              })
              .then(function(){
                  location.reload();
              });
            }
          })
        }
      })
    })

    $('.picsamainpage').click(function(e){

      var id = $(this).attr("id");

        document.getElementById("picsamain").value = id;
      
    });

    $('.SavePictureMainpage').click(function(e){

      var form = $('form')[0]; // You need to use standard javascript object here
      var formData = new FormData(form);
      Swal.fire({
        title: 'Are you sure?',
        text: "You want to upload this picture?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, upload!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: '{{route("UploadPicturesForMainpage")}}',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'HTML',
            success: function(response){
              Swal.fire({
                title: "Successfully Uploaded!",
                icon: 'success', 
                type: "success"
              })
              .then(function(){
                  location.reload();
              });
            }
          })
        }
      })
    })

    $('.UserStatus').click(function(e){

      var data = $(this).attr("id");
      data = data.split("-");
      var user_id = data[0];
      var status = data[1];

      if(status == 0){
        Swal.fire({
          title: 'Are you sure?',
          text: "You want to disable this user?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, disable it!'
        })
        .then((result) => {
          if (result.value) {
            $.ajax({
              url: '{{route("ChangeUserStatus")}}',
              type: 'GET',
              data: {
                user_id: user_id,
                status: status
              },
              dataType: 'HTML',
              success: function(response){
                Swal.fire({
                  title: "Successfully Disabled!",
                  icon: 'success', 
                  type: "success"
                })
                .then(function(){
                    location.reload();
                });
              }
            })
          }
        })
      }
      else{
        Swal.fire({
          title: 'Are you sure?',
          text: "You want to enable this user?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, enable it!'
        })
        .then((result) => {
          if (result.value) {
            $.ajax({
              url: '{{route("ChangeUserStatus")}}',
              type: 'GET',
              data: {
                user_id: user_id,
                status: status
              },
              dataType: 'HTML',
              success: function(response){
                Swal.fire({
                  title: "Successfully Enabled!",
                  icon: 'success', 
                  type: "success"
                })
                .then(function(){
                    location.reload();
                });
              }
            })
          }
        })
      }
    })

    $('.CancelReservation').click(function(e){

      var reservation_id = $(this).attr("id");

      Swal.fire({
          title: 'Are you sure?',
          text: "You want to cancel the reservation?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, cancel it!'
        })
        .then((result) => {
          if (result.value) {
            $.ajax({
              url: '{{route("CancelReservation")}}',
              type: 'GET',
              data: {
                reservation_id: reservation_id
              },
              dataType: 'HTML',
              success: function(response){
                Swal.fire({
                  title: "Successfully Cancelled!",
                  icon: 'success', 
                  type: "success"
                })
                .then(function(){
                    location.reload();
                });
              }
            })
          }
        })
    })

    $('.deleteroom').click(function(e){
      var room_id = $(this).attr("id");

      Swal.fire({
          title: 'Are you sure?',
          text: "You want to delete this room?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        })
        .then((result) => {
          if (result.value) {
            $.ajax({
              url: '{{route("DeleteRoom")}}',
              type: 'GET',
              data: {
                room_id: room_id
              },
              dataType: 'HTML',
              success: function(response){
                Swal.fire({
                  title: "Successfully Deleted!",
                  icon: 'success', 
                  type: "success"
                })
                .then(function(){
                    location.reload();
                });
              }
            })
          }
        })
    })

    $('.AmenityEdit').click(function(e){
    e.preventDefault();

    var amenity_id = $(this).attr("id");

    $.ajax({
      url: '{{route("GetAmenityInfo")}}',
      type: 'GET',
      data: {
        amenity_id: amenity_id
      },
      dataType: 'JSON',
      success: function(response){
        document.getElementById("amenity_name").value = response.amenity_name;
        document.getElementById("amenity_price").value = response.price;
        document.getElementById("amenity_description").value = response.description;
        document.getElementById("amenity_id").value = response.amenity_id;
      }
    })
  })

  $('.SaveAmenityEdit').click(function(e){
    var form = $('form')[0]; // You need to use standard javascript object here
    var formData = new FormData(form);
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to edit this item?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, save changes!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: '{{route("EditAmenity")}}',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'HTML',
            success: function(response){
              Swal.fire({
                title: "Successfuly Edited!",
                icon: 'success', 
                type: "success"
              })
              .then(function(){
                  location.reload();
              });
            }
          })
        }
      })
  })

  $('.deleteamenity').click(function(e){
      var amenity_id = $(this).attr("id");

      Swal.fire({
          title: 'Are you sure?',
          text: "You want to delete this item?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        })
        .then((result) => {
          if (result.value) {
            $.ajax({
              url: '{{route("DeleteAmenity")}}',
              type: 'GET',
              data: {
                amenity_id: amenity_id
              },
              dataType: 'HTML',
              success: function(response){
                Swal.fire({
                  title: "Successfully Deleted!",
                  icon: 'success', 
                  type: "success"
                })
                .then(function(){
                    location.reload();
                });
              }
            })
          }
        })
    })

    $('.AmenityStatus').click(function(e){
    e.preventDefault();

    var data = $(this).attr("id");
    data = data.split("-");
    var amenity_id = data[0];
    var status = data[1];

    if(status == 0){
      Swal.fire({
        title: 'Are you sure?',
        text: "You want to disable this item?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, disable it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: '{{route("ChangeAmenityStatus")}}',
            type: 'GET',
            data: {
              status: status,
              amenity_id: amenity_id
            },
            dataType: 'HTML',
            success: function(response){
              Swal.fire({
                title: "Successfuly Disabled!",
                icon: 'success', 
                type: "success"
              })
              .then(function(){
                  location.reload();
              });
            }
          })
        }
      })
    }
    else{
      Swal.fire({
        title: 'Are you sure?',
        text: "You want to enable this item?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, enable it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: '{{route("ChangeAmenityStatus")}}',
            type: 'GET',
            data: {
              status: status,
              amenity_id: amenity_id
            },
            dataType: 'HTML',
            success: function(response){
              Swal.fire({
                title: "Successfuly Enabled!",
                icon: 'success', 
                type: "success"
              })
              .then(function(){
                  location.reload();
              });
            }
          })
        }
      })
    }
  })

</script>
</body>
</html>
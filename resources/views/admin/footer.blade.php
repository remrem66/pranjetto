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
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>

<script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('js/datatables.min.js')}}"></script>
<!-- Sweet Alert -->
<script src="{{asset('admin/sweetalert/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('admin/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script>

 $(function () {

$('#room').DataTable({

    dom: 'Bfrtip',
    buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
});

$('#walkin').DataTable();

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
        url : "getSales/0", dataSrc : ""
    },
    deferRender: true,
    aaSorting: []
});

$("#btnDaily").on('click', function() {
  sales.ajax.url("/getSales/0").load();
});

$("#search_sales_date").submit(function(e) {
  e.preventDefault();
  $.ajax({
    url: "{{url('filter_sales')}}",
    type: "get",
    data: 'fromdate=' + $('#from_date').val() + '&todate=' + $('#to_date').val(),
    success: function(data)
      {
        if(data == '' || data == null) {
          $('#sales').dataTable().fnClearTable();
        } else {
          $('#sales').dataTable().fnClearTable();
          $('#sales').dataTable().fnAddData(data);
        }
        
      }
  });
  
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
     
        document.getElementById("category").value = response.category;
        document.getElementById("capacity").value = response.capacity;
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

          var data = $(this).attr("id");
          data = data.split("-");
        
          var reservation_id = data[0];
          var price = data[1];
          var name = data[2];

          $('#reservation_id').val(reservation_id);
          $('#price').val(price);
          $('#name').val(name);
         
    })

    $('.completionofwalkin').click(function(e){

      var data = $(this).attr("id");
      data = data.split("-");

      var walkin_id = data[0];
      var price = data[1];
      var name = data[2];

      $('#walkin_id').val(walkin_id);
      $('#price').val(price);
      $('#name').val(name);

  })

    $('#Sbmtfinalcheckout').click(function(e){

          var reservation_id = $('#reservation_id').val();
          var price = $('#price').val();
          var name = $('#name').val();
          var discount = $("input[name='discount']:checked").val();

          if(!discount){
            alert("please select if there is a discount or none");
          }
          else{
            Swal.fire({
              title: 'Are you sure?',
              text: "You want to complete this transaction?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes!'
            })
              .then((result) => {
              if (result.value) {
                $.ajax({
                  url: '{{route("CompletePayment")}}',
                  type: 'GET',
                  data: {
                    reservation_id: reservation_id,
                    price: price,
                    name: name,
                    discount: discount
                  },
                  dataType: 'HTML',
                  success: function(response){
                    Swal.fire({
                      title: "Success!",
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



    $('.picsamainpage').click(function(e){

      var id = $(this).attr("id");

        document.getElementById("picsamain").value = id;
      
    });

    $('.newroomwalkinmodal').on('hidden.bs.modal',function(e){

      location.reload();
    });

    $('#errorBooking').on('hidden.bs.modal',function(e){

location.reload();
});
    

     $('.onlinereschedmodal').on('hidden.bs.modal',function(e){

location.reload();
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

    $('.wow').click(function(e){

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

    $('.CancelReservationWalkin').click(function(e){

var walkin_id = $(this).attr("id");

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
        url: '{{route("CancelReservationWalkin")}}',
        type: 'GET',
        data: {
          walkin_id: walkin_id
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
  });

   $('.roomwalkin').click(function(e){

    var data = $(this).attr("id");
    data = data.split("-");
    var room_id = data[0];
    var capacity = data[1];
    var price = data[2];
    var quantity = data[3];
    var x = 1;
    var y = 1;
    
    for(x; x <= capacity; x++){
        $('#number_of_persons').append($('<option>', {
            value: x,
            text: x
        }));
    }

    for(y; y <= quantity; y++){
        $('#quantity').append($('<option>', {
            value: y,
            text: y
        }));
    }

    document.getElementById("total_price").innerHTML = "₱" + price;
    document.getElementById("tot_price").value = price;
    document.getElementById("fix_price").value = price;
    document.getElementById("capacity").value = capacity;
    document.getElementById("room_id").value = room_id;
  });

  $(function(){

    $('.roomwalkin').click(function(e){

      var data = $(this).attr("id");
      data = data.split("-");
      var room_id = data[0];
    
      $.ajax({
          url: '{{route("disableddates")}}',
          type: 'GET',
          data: {
              room_id: room_id
          },
          dataType: 'HTML',
          success: function(response){
            
            var array = response;

            $( "#checkin_datepicker" ).datepicker({
                minDate: new Date(),
                beforeShowDay: function(date){
                    var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                    return [ array.indexOf(string) == -1 ]
                }
            });
        }
    })

  });

});

$( "#from_date" ).datepicker();
$( "#to_date" ).datepicker();

$('#quantity').change(function(e){

      var extra_person = $('#extra_person').val();
      var fix_price = $('#fix_price').val();
      var start_date =  $('#checkin_datepicker').val(); 
      var end_date =  $('#checkout_datepicker').val();
      var quantity =  $('#quantity').val();

      $.ajax({
          url: '{{route("changeprcwithqty")}}',
          type: 'GET',
          data: {
              extra_person: extra_person,
              fix_price: fix_price,
              start_date: start_date,
              end_date: end_date,
              quantity: quantity
          },
          dataType: 'HTML',
          success: function(response){
              document.getElementById("total_price").innerHTML = "₱" + response;
              document.getElementById("tot_price").value = response;
          }
      })
})

$('#checkin_datepicker').change(function(e){

        var room_id = $('#room_id').val(); 
        var check_in =  $('#checkin_datepicker').val(); 
        
        $.ajax({
                url: '{{route("disabledcheckoutdates")}}',
                type: 'GET',
                data: {
                    room_id: room_id,
                    check_in: check_in,
                },
                dataType: 'HTML',
                success: function(response){

                    var array = response;
                    

                    $('#checkout_datepicker').prop("disabled", false);
                    
                    $('#checkout_datepicker').datepicker({
                        minDate: check_in,
                        beforeShowDay: function(date){
                            var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                            return [ array.indexOf(string) == -1 ]
                        }
                    })
                }
            })
    })

    $('#checkout_datepicker').change(function(e){

      var extra_person = $('#extra_person').val();
      var categ = $('#categ').val();
      var fix_price = $('#fix_price').val();
      var start_date =  $('#checkin_datepicker').val(); 
      var end_date =  $('#checkout_datepicker').val();

      $.ajax({
          url: '{{route("changeenddate")}}',
          type: 'GET',
          data: {
              extra_person: extra_person,
              fix_price: fix_price,
              start_date: start_date,
              end_date: end_date
          },
          dataType: 'HTML',
          success: function(response){

              $('#quantity').prop("disabled", false);
              document.getElementById("total_price").innerHTML = "₱" + response;
              document.getElementById("tot_price").value = response;
          }
      })
  })

  $('#extra_person').change(function(e){

    var extra_person = $('#extra_person').val();

    var fix_price = $('#fix_price').val();
    var start_date =  $('#checkin_datepicker').val(); 
    var end_date =  $('#checkout_datepicker').val(); 
    var quantity =  $('#quantity').val(); 

$.ajax({
    url: '{{route("getextrapersonprice")}}',
    type: 'GET',
    data: {
        extra_person: extra_person,
        fix_price: fix_price,
        start_date: start_date,
        end_date: end_date,
        quantity: quantity
    },
    dataType: 'HTML',
    success: function(response){

        document.getElementById("total_price").innerHTML = "₱" + response;
        document.getElementById("tot_price").value = response;
    }
    
  })
});

 $('#number_of_persons').change(function(e){

var capacity = $('#capacity').val()
var persons = $('#number_of_persons').val()

if(persons == capacity){
    $('#extra_person').prop("disabled", false);
}
else{
    $('#extra_person').prop("disabled", true);
}
})

$("#SbmtRoomWalkIn").click(function(e){

e.preventDefault();

var form = $('form')[0]; // You need to use standard javascript object here
var formData = new FormData(form);
Swal.fire({
    title: 'Are you sure?',
    text: "You want to execute this action?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, save changes!'
})
.then((result) => {
    if(result.value){
        $.ajax({
            url: '{{route("AddRoomWalkIn")}}',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'HTML',
            success: function(response){
              if(response != ""){
                    var obj = JSON.parse(response);
               
                    var x;
                
                    for(x = 0; x < obj.error.length; x++){
                        $('#validation').append("<li>" + obj.error[x] + "</li>");
                    }
                    $('#errorBooking').modal('show');
                }
                else{
                  Swal.fire({
                    title: "Successfuly Executed!",
                    icon: 'success', 
                    type: "success"
                })
                .then(function(){
                    location.reload();
                });
                }
                
            }
        })
    }
})
});

$('.additionalamenity').click(function(e){

  var data = $(this).attr("id");
  data = data.split("-");
  var reservation_id = data[0];
  var total_price = data[1];
  $('#reservation_id').val(reservation_id);
  $('#price').val(total_price);
          
  
});

$('.additionalamenitywalkin').click(function(e){

var data = $(this).attr("id");
data = data.split("-");
var walkin_id = data[0];
var total_price = data[1];
$('#walkin_id').val(walkin_id);


$('#price').val(total_price);
        

});

$('#Sbmtadditional').click(function(e){

  var reservation_id = $('#reservation_id').val();
  var total_price = $('#price').val();
          
  var amenity = $('#amenities_total').val();
  
  if(amenity < 0){
    alert("Please input a valid amount");
  }
  else{
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to execute this action?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: '{{route("AddAdditional")}}',
            type: 'GET',
            data: {
              reservation_id: reservation_id,
              amenity: amenity,
              total_price: total_price
            },
            dataType: 'HTML',
            success: function(response){
              Swal.fire({
                title: "Success!",
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
});

$('#Sbmtadditionalwalkin').click(function(e){

var walkin_id = $('#walkin_id').val();
var total_price = $('#price').val();


var amenity = $('#amenities_total').val();

if(amenity < 0){
  alert("Please input a valid amount");
}
else{
  Swal.fire({
      title: 'Are you sure?',
      text: "You want to execute this action?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: '{{route("AddAdditionalwalkin")}}',
          type: 'GET',
          data: {
            walkin_id: walkin_id,
            amenity: amenity,
            total_price: total_price
          },
          dataType: 'HTML',
          success: function(response){
            Swal.fire({
              title: "Success!",
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
});

$('#discount').click(function(e){

  var test = $('#discount').val();
  var reservation_id = $('#reservation_id').val();

  $.ajax({
    url: '{{route("CheckTotalBalance")}}',
    type: 'GET',
    data: {
      test: test,
      reservation_id: reservation_id
    },
    dataType: 'HTML',
    success: function(response){
      document.getElementById("total_balance").innerHTML = "₱" + response;
    }
  })

});

$('#discount1').click(function(e){

  var test = $('#discount1').val();
  var reservation_id = $('#reservation_id').val();

  $.ajax({
    url: '{{route("CheckTotalBalance")}}',
    type: 'GET',
    data: {
      test: test,
      reservation_id: reservation_id
    },
    dataType: 'HTML',
    success: function(response){
      
      document.getElementById("total_balance").innerHTML = "₱" + response;
    }
  })
});

$('#disc').click(function(e){

var test = $('#disc').val();
var walkin_id = $('#walkin_id').val();



$.ajax({
  url: '{{route("CheckTotalBalanceWalkin")}}',
  type: 'GET',
  data: {
    test: test,
    walkin_id: walkin_id
  },
  dataType: 'HTML',
  success: function(response){
    document.getElementById("total_balance_walkin").innerHTML = "₱" + response;
  }
})

});

$('#disc1').click(function(e){

var test = $('#disc1').val();
var walkin_id = $('#walkin_id').val();

$.ajax({
  url: '{{route("CheckTotalBalanceWalkin")}}',
  type: 'GET',
  data: {
    test: test,
    walkin_id: walkin_id
  },
  dataType: 'HTML',
  success: function(response){
    
    document.getElementById("total_balance_walkin").innerHTML = "₱" + response;
  }
})
});

$('.initialpaywalkin').click(function(e){

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

      var walkin_id = data[0];
      var price = data[1];
      var name = data[2];

      $.ajax({
        url: '{{route("ConfirmInitialWalkin")}}',
        type: 'GET',
        data: {
          walkin_id: walkin_id,
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

$('#Sbmtfinalcheckoutwalkin').click(function(e){

          var walkin_id = $('#walkin_id').val();
          var price = $('#price').val();
          var name = $('#name').val();
          var discount = $("input[name='discount']:checked").val();

          if(!discount){
            alert("please select if there is a discount or none");
          }
          else{
            Swal.fire({
              title: 'Are you sure?',
              text: "You want to complete this transaction?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes!'
            })
              .then((result) => {
              if (result.value) {
                $.ajax({
                  url: '{{route("CompletePaymentWalkin")}}',
                  type: 'GET',
                  data: {
                    walkin_id: walkin_id,
                    price: price,
                    name: name,
                    discount: discount
                  },
                  dataType: 'HTML',
                  success: function(response){
                    Swal.fire({
                      title: "Success!",
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


$("#pop").on("click", function() {
   $('#imagepreview').attr('src', $('#imageresource').attr('src')); // here asign the image to the modal when the user click the enlarge link
   $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
});
$("#pop_pop").on("click", function() {
   $('#gallerypreview').attr('src', $('#imageresource').attr('src')); // here asign the image to the modal when the user click the enlarge link
   $('#gallerymodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
});

$('.online_resched').click(function(e){

    var data = $(this).attr("id");
    data = data.split("-");
    var reservation_id = data[0];
    var room_id = data[1];
    var checkindate = new Date(data[2]);

    
    $.ajax({
        url: '{{route("disableddates")}}',
        type: 'GET',
        data: {
          room_id: room_id
          },
          dataType: 'HTML',
          success: function(response){

              var array = response;
                    
                $('#re_checkin').datepicker({
                      minDate: checkindate,
                      beforeShowDay: function(date){
                          var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                          return [ array.indexOf(string) == -1 ]
                      }
                })
            
            $('#reservation_id').val(reservation_id);
            $('#room_id').val(room_id);
          }

    })
})

$('.walkin_resched').click(function(e){

var data = $(this).attr("id");
data = data.split("-");
var walkin_id = data[0];
var room_id = data[1];

$.ajax({
    url: '{{route("disableddates")}}',
    type: 'GET',
    data: {
      room_id: room_id
      },
      dataType: 'HTML',
      success: function(response){

          var array = response;
                
            $('#checkin_re').datepicker({
                  minDate: new Date(),
                  beforeShowDay: function(date){
                      var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                      return [ array.indexOf(string) == -1 ]
                  }
            })
        
        $('#walkin_id').val(walkin_id);
        $('#room_id').val(room_id);
      }

})
})

    $('#re_checkin').change(function(e){

var room_id = $('#room_id').val(); 
var check_in =  $('#re_checkin').val(); 

$.ajax({
        url: '{{route("disabledcheckoutdates")}}',
        type: 'GET',
        data: {
            room_id: room_id,
            check_in: check_in,
        },
        dataType: 'HTML',
        success: function(response){

            var array = response;
            

            $('#re_checkout').prop("disabled", false);
            
            $('#re_checkout').datepicker({
                minDate: check_in,
                beforeShowDay: function(date){
                    var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                    return [ array.indexOf(string) == -1 ]
                }
            })
        }
    })
})

$('#checkin_re').change(function(e){

var room_id = $('#room_id').val(); 
var check_in =  $('#checkin_re').val(); 

$.ajax({
        url: '{{route("disabledcheckoutdates")}}',
        type: 'GET',
        data: {
            room_id: room_id,
            check_in: check_in,
        },
        dataType: 'HTML',
        success: function(response){

            var array = response;
            

            $('#checkout_re').prop("disabled", false);
            
            $('#checkout_re').datepicker({
                minDate: check_in,
                beforeShowDay: function(date){
                    var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                    return [ array.indexOf(string) == -1 ]
                }
            })
        }
    })
})

$('#Sbmtreschedonline').click(function(e){

  var reservation_id = $('#reservation_id').val();
  var room_id = $('#room_id').val(); 
  var check_in =  $('#re_checkin').val();
  var check_out =  $('#re_checkout').val();

          if(check_in == "" || check_out == ""){
            alert("Please fill necessarry details");
          }
          else{
            Swal.fire({
              title: 'Are you sure?',
              text: "You want to change this schedule?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes!'
            })
              .then((result) => {
              if (result.value) {
                $.ajax({
                  url: '{{route("OnlineChangeSched")}}',
                  type: 'GET',
                  data: {
                    reservation_id: reservation_id,
                    room_id: room_id,
                    check_in: check_in,
                    check_out: check_out
                  },
                  dataType: 'HTML',
                  success: function(response){
                    Swal.fire({
                      title: "Success!",
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

$('#Sbmtreschedwalkin').click(function(e){

var walkin_id = $('#walkin_id').val();
var room_id = $('#room_id').val(); 
var check_in =  $('#checkin_re').val();
var check_out =  $('#checkout_re').val();

        if(check_in == "" || check_out == ""){
          alert("Please fill necessarry details");
        }
        else{
          Swal.fire({
            title: 'Are you sure?',
            text: "You want to change this schedule?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
          })
            .then((result) => {
            if (result.value) {
              $.ajax({
                url: '{{route("WalkinChangeSched")}}',
                type: 'GET',
                data: {
                  walkin_id: walkin_id,
                  room_id: room_id,
                  check_in: check_in,
                  check_out: check_out
                },
                dataType: 'HTML',
                success: function(response){
                  Swal.fire({
                    title: "Success!",
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

$('.onlinestatuschange').click(function(e){

  var data = $(this).attr("id");
  data = data.split("-");
  var reservation_id = data[0];
  var status = data[1];

  Swal.fire({
            title: 'Are you sure?',
            text: "You want to do this action?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
          })
            .then((result) => {
            if (result.value) {
              $.ajax({
                url: '{{route("OnlineStatusChange")}}',
                type: 'GET',
                data: {
                  reservation_id: reservation_id,
                  status: status
                },
                dataType: 'HTML',
                success: function(response){


                  var redir = '{{route("print_test", ":id")}}';
                  redir = redir.replace(':id',reservation_id);

                  window.open(redir);
                  
                  Swal.fire({
                    title: "Success!",
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

$('.Savetogallery').click(function(e){
    var form = $('form')[0]; // You need to use standard javascript object here
    var formData = new FormData(form);
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to upload this image?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: '{{route("Uploadtogallery")}}',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'HTML',
            success: function(response){
              Swal.fire({
                title: "Successfuly Uploaded!",
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

  $('.deleteimage').click(function(e){

    var gallery_id = $(this).attr("id");

    Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this image?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: '{{route("Deletetogallery")}}',
            type: 'GET',
            data: {
              gallery_id: gallery_id
            },
            dataType: 'HTML',
            success: function(response){
              Swal.fire({
                title: "Successfuly Deleted!",
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

  $('.IncUpdateSlot').click(function(e){

    var room_id = $(this).attr("id");
    var slot = 1;

    Swal.fire({
        title: 'Are you sure?',
        text: "You want to execute this action?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: '{{route("IncreaseSlot")}}',
            type: 'GET',
            data: {
              room_id: room_id,
              slot: slot
            },
            dataType: 'HTML',
            success: function(response){
              Swal.fire({
                title: "Successfuly Executed!",
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
  });

  $('.ManUpdateSlot').click(function(e){

var room_id = $(this).attr("id");
$('#man_room_id').val(room_id);
});

$('.DecUpdateSlot').click(function(e){

var room_id = $(this).attr("id");
var slot = 1;
Swal.fire({
    title: 'Are you sure?',
    text: "You want to execute this action?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: '{{route("DecreaseSlot")}}',
        type: 'GET',
        data: {
          room_id: room_id,
          slot: slot
        },
        dataType: 'HTML',
        success: function(response){
          Swal.fire({
            title: "Successfuly Executed!",
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
});

  

  $('.SaveManual').click(function(e){

var room_id = $('#man_room_id').val();
var slot = $('#man_slot').val();

if(slot < 0){
  alert("please input a valid quantity");
}
else{
  Swal.fire({
    title: 'Are you sure?',
    text: "You want to execute this action?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: '{{route("ManualSlot")}}',
        type: 'GET',
        data: {
          room_id: room_id,
          slot: slot
        },
        dataType: 'HTML',
        success: function(response){
          Swal.fire({
            title: "Successfuly Executed!",
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
});

$('.SaveDecrease').click(function(e){

var room_id = $('#dec_room_id').val();
var slot = $('#dec_slot').val();


});



</script>
</body>
</html>
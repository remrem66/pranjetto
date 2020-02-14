@include('admin.header')
@include('admin.navbar')


<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Online Reservations</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Reservations</h3>
            </div>
            <div class="card-body">
              <table id="room" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Room Description</th>
                  <th>Customer Name</th>
                  <th>Reservation Code</th>
                  <th>Date of Reservation</th>
                  <th>Uploaded Receipt</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $result)
                <tr>
                  <td>{{$result->room_name}}</td>
                  <td>{{$result->name}}</td>
                  <td>{{$result->reservation_code}}</td>
                  <td>{{date("M-d-Y",strtotime($result->check_in))}} - {{date("M-d-Y",strtotime($result->check_out))}}</td>
                  <td>
                  @if(!empty($result->receipt_image))
                    <a href="#" id="pop">
                      <img id="imageresource" src="{{URL::asset('images/'.$result->receipt_image)}}" style="width: 300px; height: 100px;"></img>
                    </a>
                    @endif
                  </td>
                  
                  <td>
                    @if(!empty($result->receipt_image))
                    <button class="btn btn-info initialpay" id="{{$result->reservation_id}}-{{$result->total_price}}-{{$result->name}}">Confirm Payment</button>
                    @endif
                    
                    
                </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>         
            <div class="modal fade" id="imagemodal">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Receipt Preview</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                          <img src="" id="imagepreview" style="width: 450px; height: 264px;" >
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@include('admin.footer')
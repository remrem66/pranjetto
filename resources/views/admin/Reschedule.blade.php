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
              <h3 class="card-title">Reschedule Reservations</h3>
            </div>
            <div class="card-body">
              <table id="" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Room Description</th>
                  <th>Customer Name</th>
                  <th># of pax</th>
                  <th>Date of Reservation</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $result)
                <tr>
                  <td>{{$result->room_name}} </td>
                  <td>{{$result->name}}</td>
                  <td>{{$result->no_of_persons}}</td>
                  <td>{{date("M-d-Y",strtotime($result->check_in))}} - {{date("M-d-Y",strtotime($result->check_out))}}</td>
                  <td>
                    <button class="btn btn-warning online_resched" id="{{$result->reservation_id}}-{{$result->room_id}}" data-toggle="modal" data-target=".onlinereschedmodal">Change Schedule</button>
                </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            
          </div>
          <div class="modal fade onlinereschedmodal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"></h4>
                        <button type="button" class="close closeModal" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                          <div class="form-group row">
                              <label class="col-form-label col-md-5 col-sm-5 ">Check in:</label>
                              <div class="col-md-7 col-sm-7 ">
                                  <input type="text" id="re_checkin" class="form-control">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-form-label col-md-5 col-sm-5 ">Check out:</label>
                              <div class="col-md-7 col-sm-7 ">
                                  <input type="text" id="re_checkout" class="form-control" disabled>
                                  <input type="hidden" id="reservation_id">
                                  <input type="hidden" id="room_id">
                              </div>
                          </div>                  
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="Sbmtreschedonline">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Walk-in Reservations</h3>
            </div>
            <div class="card-body">
              <table id="" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Room Description</th>
                  <th>Customer Name</th>
                  <th># of pax</th>
                  <th>Date of Reservation</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data1 as $result1)
                <tr>
                  <td>{{$result1->room_name}} </td>
                  <td>{{$result1->customer_name}}</td>
                  <td>{{$result1->no_of_persons}}</td>
                  <td>{{date("M-d-Y",strtotime($result1->check_in))}} - {{date("M-d-Y",strtotime($result1->check_out))}}</td>
                  <td>
                    <button class="btn btn-info walkin_resched" id="{{$result1->walkin_id}}-{{$result1->room_id}}" data-toggle="modal" data-target=".walkinreschedmodal">Change Schedule</button>
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <div class="modal fade walkinreschedmodal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"></h4>
                        <button type="button" class="close closeModal" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                          <div class="form-group row">
                              <label class="col-form-label col-md-5 col-sm-5 ">Check in:</label>
                              <div class="col-md-7 col-sm-7 ">
                                  <input type="text" id="checkin_re" class="form-control">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-form-label col-md-5 col-sm-5 ">Check out:</label>
                              <div class="col-md-7 col-sm-7 ">
                                  <input type="text" id="checkout_re" class="form-control" disabled>
                                  <input type="hidden" id="walkin_id">
                                  <input type="hidden" id="room_id">
                              </div>
                          </div>                  
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="Sbmtreschedwalkin">Save changes</button>
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
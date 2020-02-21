@include('admin.header')
@include('admin.navbar')


<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$title}}</h1>
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
                  <th>Reservation Code</th>
                  <th>Room Description</th>
                  <th>Customer Name</th>
                  <th># of pax</th>
                  <th>Date of Reservation</th>
                  <th>Quantity</th>
                  <th>Total Price</th>
                  <th>Amount Paid</th>
                  <th>Balance</th>
                  <th>status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $result)
                <tr>
                  @if($result->reservation_status == 0 || $result->reservation_status == 1)
                  <td>{{$result->reservation_code}}</td>
                  <td>{{$result->category}}</td>
                  <td>{{$result->name}}</td>
                  <td>{{$result->no_of_persons}}</td>
                  <td>{{date("m-d-y",strtotime($result->check_in))}} - {{date("m-d-y",strtotime($result->check_out))}}</td>
                  <td>{{$result->quantity}}</td>
                  <td>{{$result->total_price}}</td>
                  <td>{{$result->amount_paid}}</td>
                  <td>
                    @if(!empty($result->amount_paid))
                    {{$result->total_price - $result->amount_paid}}
                    @endif
                  </td>
                  <td>
                    @if($result->reservation_status == 1 || $result->reservation_status == 2)
                      Pending
                    @endif
                    @if($result->reservation_status == 3)
                      Checked-in
                    @endif
                    @if($result->reservation_status == 4)
                      Checked-out
                    @endif
                    </td>
                  <td>
                    
                    @if($result->reservation_status == 0)
                    <button class="btn btn-info initialpay" id="{{$result->reservation_id}}-{{$result->total_price}}-{{$result->name}}">Confirm Payment</button>
                    
                    @endif
                    @if($result->reservation_status == 1)
                    <button class="btn btn-info completionofblance" id="{{$result->reservation_id}}-{{$result->total_price - $result->amount_paid}}-{{$result->name}}" data-toggle="modal" data-target=".finalcheckoutmodal">Complete Balance</button>
                    <button class="btn btn-warning additionalamenity" id="{{$result->reservation_id}}-{{$result->total_price}}" data-toggle="modal" data-target=".addamenitymodal">Add Amenity</button>
                    
                    @endif
                    <button class="btn btn-danger wow" id="{{$result->reservation_id}}">Cancel</button>
                    @if($result->reservation_status == 2)
                    <button class="btn btn-info onlinestatuschange" id="{{$result->reservation_id}}-3">Check in</button>
                    
                    @endif
                    @if($result->reservation_status == 3)
                    <button class="btn btn-info onlinestatuschange" id="{{$result->reservation_id}}-4">Check out</button>
                    
                    @endif
                    
                </td>
                @endif
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            
          </div>
        </div>
      </div>
      <div class="modal fade finalcheckoutmodal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"></h4>
                        <button type="button" class="close closeModal" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                          <div class="form-group row">
                              <label class="col-form-label col-md-6 col-sm-6 ">Senior Discount?</label>
                              <div class="col-md-6 col-sm-6 ">
                                <div style="margin-top: 7px;">
                                    <input type="radio" name="discount" id="discount" value="1"> Yes
                                    <input type="radio" name="discount" id="discount1" value="0"> No
                                </div>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-form-label col-md-6 col-sm-6 ">Total balance:</label>
                              <div class="col-md-6 col-sm-6 ">
                                <h5 id="total_balance" style="margin-top: 8px;"> </h5>
                              </div>
                          </div>
                          
                                  <input type="hidden" id="reservation_id" class="form-control" >
                                  <input type="hidden" id="price" class="form-control" >
                                  <input type="hidden" id="name" class="form-control">

                      
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="Sbmtfinalcheckout">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade addamenitymodal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"></h4>
                        <button type="button" class="close closeModal" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                          <div class="form-group row">
                              <label class="col-form-label col-md-6 col-sm-6 ">Amenities</label>
                              <div class="col-md-6 col-sm-6 ">
                                  <input type="text" id="amenities_total" class="form-control">
                              </div>
                          </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="Sbmtadditional">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </div>

@include('admin.footer')
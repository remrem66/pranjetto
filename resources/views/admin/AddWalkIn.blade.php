@include('admin.header')
@include('admin.navbar')


<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Rooms</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Room Information</h3>
            </div>
            <div class="card-body">
              <table id="walkin" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Room Number</th>
                  <th>Floor</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Capacity</th>
                  <th>Price</th>
                  <th>Slot</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $result)
                <tr>
                  <td>{{$result->room_num}}</td>
                  <td>{{$result->floor}}</td>
                  <td>{{$result->room_name}}</td>
                  <td>{{$result->category}}</td>
                  <td>{{$result->capacity}}</td>
                  <td>{{$result->twentyfourhr_price}}</td>
                  <td>{{$result->slot}}</td>
                  <td>
                    <button class="btn btn-primary roomwalkin" id="{{$result->room_id}}-{{$result->capacity}}-{{$result->twentyfourhr_price}}-{{$result->slot}}" data-toggle="modal" data-target=".newroomwalkinmodal">Add Reservation </button>
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade newroomwalkinmodal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Customer Information</h4>
                        <button type="button" class="close closeModal" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                        @csrf
                            <div class="form-group row">
                                <label class="col-form-label col-md-2 col-sm-2 ">Full Name</label>
                                <div class="col-md-10 col-sm-10 ">
                                    <input type="text" name="customer_name" class="form-control" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2 col-sm-2 ">Email Address</label>
                                <div class="col-md-10 col-sm-10 ">
                                    <input type="email" name="email_address" class="form-control" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2 col-sm-2 ">Contact #</label>
                                <div class="col-md-10 col-sm-10 ">
                                    <input type="text" name="contact_num" class="form-control" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2 col-sm-2 ">Pax</label>
                                <div class="col-md-10 col-sm-10 ">
                                    <select name="number_of_persons" id="number_of_persons" class="form-control">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2 col-sm-2 ">Extra Mattress</label>
                                <div class="col-md-10 col-sm-10 ">
                                    <input type="number" name="extra_mattress" id="extra_person" class="form-control" min="1" disabled>
                                    <input type="hidden" name="room_id" id="room_id">
                                    <input type="hidden" name="tot_price" id="tot_price">
                                    <input type="hidden" id="categ">
                                    <input type="hidden" id="price">
                                    <input type="hidden" id="fix_price">
                                    <input type="hidden" id="capacity">
                                </div> 
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2 col-sm-2 ">Check-in Date</label>
                                <div class="col-md-10 col-sm-10 ">
                                    <input type="text" name="check_in" id="checkin_datepicker" class="form-control" value="">
                                </div> 
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2 col-sm-2 ">Check-out Date</label>
                                <div class="col-md-10 col-sm-10 ">
                                    <input type="text" name="check_out" id="checkout_datepicker" class="form-control" value="" disabled="disabled">
                                </div> 
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2 col-sm-2 ">Quantity</label>
                                <div class="col-md-10 col-sm-10 ">
                                    <select name="quantity" id="quantity" class="form-control" disabled required>
                                        
                                    </select>
                                </div> 
                            </div>
                            <br>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2 col-sm-2 ">Total Price:</label>
                                <div class="col-md-10 col-sm-10 ">
                                    <h4 id="total_price">  </h4>
                                </div> 
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="SbmtRoomWalkIn">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </div>

@include('admin.footer')
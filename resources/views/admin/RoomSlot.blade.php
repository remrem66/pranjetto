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
              <table id="room" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <!-- <th>Room Number</th> -->
                  
                  <th>Category</th>
                  <th>Capacity</th>
                  <th>Slot</th>
                  <th>24-Hour Price</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $result)
                <tr>
                  
                  <td>{{$result->category}}</td>
                  <td>{{$result->capacity}}</td>
                  <td>{{$result->slot}}</td>
                  <td>{{$result->twentyfourhr_price}}</td>
                  <td>
                    <button class="btn btn-primary IncUpdateSlot" id="{{$result->room_id}}" >Increase Slot</button>
                    <button class="btn btn-warning ManUpdateSlot" id="{{$result->room_id}}" data-toggle="modal" data-target="#ManualInputSlot">Manually Input SLot</button>
                    <button class="btn btn-danger DecUpdateSlot" id="{{$result->room_id}}">Decrease Slot</button>
                   
                </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      
            <div class="modal fade" id="ManualInputSlot">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Manual Input Slot</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <div class="form-group row">
                              <label class="col-form-label col-md-6 col-sm-6 ">Slot: </label>
                              <div class="col-md-6 col-sm-6 ">
                                  <input type="text" id="man_slot" class="form-control">
                                  <input type="hidden" id="man_room_id" class="form-control">
                              </div>
                          </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary SaveManual">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
           
    </section>
  </div>

@include('admin.footer')
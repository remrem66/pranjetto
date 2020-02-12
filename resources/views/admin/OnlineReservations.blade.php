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
                  <th># of pax</th>
                  <th>Date of Reservation</th>
                  <th>Total Price</th>
                  <th>Amount Paid</th>
                  <th>Balance</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $result)
                <tr>
                  <td>{{$result->room_name}} {{$result->room_num}}</td>
                  <td>{{$result->name}}</td>
                  <td>{{$result->no_of_persons}}</td>
                  <td>{{date("M-d-Y",strtotime($result->check_in))}} - {{date("M-d-Y",strtotime($result->check_out))}}</td>
                  <td>{{$result->total_price}}</td>
                  <td>{{$result->amount_paid}}</td>
                  <td>
                    @if(!empty($result->amount_paid))
                    {{$result->total_price - $result->amount_paid}}
                    @endif
                  </td>
                  <td>
                    @if($result->reservation_status == 0)
                    <button class="btn btn-info initialpay" id="{{$result->reservation_id}}-{{$result->total_price}}-{{$result->name}}">Confirm Payment</button>
                    <button class="btn btn-danger CancelReservation" id="{{$result->reservation_id}}">Cancel</button>
                    @endif
                    @if($result->reservation_status == 1)
                    <button class="btn btn-info completionofblance" id="{{$result->reservation_id}}-{{$result->total_price - $result->amount_paid}}-{{$result->name}}">Complete Balance</button>
                    @endif
                    
                </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            
          </div>
        </div>
      </div>
    </section>
  </div>

@include('admin.footer')
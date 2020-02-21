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
                    
                    <button class="btn btn-info onlinestatuschange" id="{{$result->reservation_id}}-3">Check in</button>
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
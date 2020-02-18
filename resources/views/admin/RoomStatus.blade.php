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
                  <th>Floor</th>
                  <th>Category</th>
                  <th>Capacity</th>
                  <!-- <th>12-Hour Price<twelvehr></th> -->
                  <th>24-Hour Price</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $result)
                <tr>
                  <td>{{$result->floor}}</td>
                  <td>{{$result->category}}</td>
                  <td>{{$result->capacity}}</td>
                  <td>{{$result->twentyfourhr_price}}</td>
                  <td>
                    @if($result->status == 1)
                    <button class="btn btn-danger RoomStatus" id="{{$result->room_id}}-0">Disable</button>
                    @endif
                    @if($result->status == 0)
                    <button class="btn btn-success RoomStatus" id="{{$result->room_id}}-1">Enable</button>
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
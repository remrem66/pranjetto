@include('admin\header')
@include('admin\navbar')


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
                  <th>Room Number</th>
                  <th>Floor</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Capacity</th>
                  <th>24-Hour Price</th>
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

@include('admin\footer')
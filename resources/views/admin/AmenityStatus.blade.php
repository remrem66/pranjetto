@include('admin.header')
@include('admin.navbar')


<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Amenities</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Amenity Information</h3>
            </div>
            <div class="card-body">
              <table id="room" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Amenity Name</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $result)
                <tr>
                  <td>{{$result->amenity_name}}</td>
                  <td>{{$result->description}}</td>
                  <td>{{$result->price}}</td>
                  <td>
                    @if($result->status == 1)
                    <button class="btn btn-danger AmenityStatus" id="{{$result->amenity_id}}-0" data-toggle="modal" data-target="#EditAmenity">Disable</button>
                    @endif
                    @if($result->status == 0)
                    <button class="btn btn-success AmenityStatus" id="{{$result->amenity_id}}-1" data-toggle="modal" data-target="#EditAmenity">Enable</button>
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
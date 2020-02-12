@include('admin\header')
@include('admin\navbar')


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
                    <button class="btn btn-info AmenityEdit" id="{{$result->amenity_id}}" data-toggle="modal" data-target="#EditAmenity">Edit</button>
                    <button class="btn btn-danger deleteamenity" id="{{$result->amenity_id}}">Delete</button>
                </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <div class="modal fade" id="EditAmenity">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Amenity</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="edit_room_form">
                            @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Amenity Name</label>
                                        <input type="text" name="amenity_name" id="amenity_name" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Price</label>
                                        <input type="text" name="price" id="amenity_price" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Description</label>
                                        <textarea name="description" id="amenity_description" class="form-control"></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputFile">Picture</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="picture" accept="image/*" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    
                                <input type="hidden" id="amenity_id" name="amenity_id">
                            </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary SaveAmenityEdit">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@include('admin\footer')
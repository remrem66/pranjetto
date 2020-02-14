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
                  <th>Name</th>
                  <th>Category</th>
                  <th>Capacity</th>
                  <th>Slot</th>
                  <th>Price</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $result)
                <tr>
                  <td>{{$result->floor}}</td>
                  <td>{{$result->room_name}}</td>
                  <td>{{$result->category}}</td>
                  <td>{{$result->capacity}}</td>
                  <td>{{$result->slot}}</td>
                  <td>{{$result->twentyfourhr_price}}</td>
                  <td>
                    <button class="btn btn-info RoomEdit" id="{{$result->room_id}}" data-toggle="modal" data-target="#EditRoom">Edit</button>
                    <button class="btn btn-warning PictureModification" id="{{$result->room_id}}" data-toggle="modal" data-target="#ModificationPicture">Add/Edit Pictures</button>
                    <button class="btn btn-danger deleteroom" id="{{$result->room_id}}">Delete</button>
                </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <div class="modal fade" id="EditRoom">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Room</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="edit_room_form">
                            @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Room Number</label>
                                        <input type="text" name="room_num" id="room_num" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Floor</label>
                                        <input type="text" name="floor" id="floor" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Category</label>
                                        <select name="category" id="category" class="form-control">
                                            <option> </option>
                                            <option value="Topaz"> Topaz </option>
                                            <option value="Emerald"> Emerald </option>
                                            <option value="Turquoise"> Turquoise </option>
                                            <option value="Garnet"> Garnet </option>
                                            <option value="Jade"> Jade </option>
                                            <option value="Pearl"> Pearl </option>
                                            <option value="Sapphire"> Sapphire </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Room Name</label>
                                        <input type="text" name="room_name" id="room_name" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Capacity</label>
                                        <select name="capacity" id="capacity" class="form-control">
                                            <option> </option>
                                            <option value="2"> 2 </option>
                                            <option value="3"> 3 </option>
                                            <option value="4"> 4 </option>
                                            <option value="5"> 5 </option>
                                            <option value="6"> 6 </option>
                                            <option value="7"> 7 </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Slot</label>
                                        <input type="text" name="slot" id="slot" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Price</label>
                                        <input type="text" name="24hr_price" id="24hr_price" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputFile">Main Picture</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="main_pic" accept="image/*" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="exampleInputEmail1">Description</label>
                                        <textarea name="description" id="description" class="form-control"></textarea>
                                    </div>
                                </div>
                                <input type="hidden" id="room_id" name="room_id">
                            </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary SaveRoomEdit">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="ModificationPicture">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add/Edit Pictures</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="edit_pictures_form">
                            @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="exampleInputFile">Picture 1</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="pic1" accept="image/*" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputFile">Picture 2</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="pic2" accept="image/*" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="exampleInputFile">Picture 3</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="pic3" accept="image/*" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputFile">Picture 4</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="pic4" accept="image/*" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="picroom_id" name="picroom_id">
                            </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary SavePictures">Save changes</button>
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
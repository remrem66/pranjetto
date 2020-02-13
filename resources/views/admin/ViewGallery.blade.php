@include('admin.header')
@include('admin.navbar')


<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gallery Management</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <button class="btn btn-primary" data-toggle="modal" data-target="#AddImageGallery">Add Image </button>
            </div>
            <div class="card-body">
              <table id="room" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Picture</th>
                  <th>Date Uploaded</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>
                @foreach($data as $result)
                <tr>
                  <td>{{$result->gallery_id}}</td>
                  <td><a href="#" id="pop_pop">
                      <img id="imageresource" src="{{URL::asset('gallery/'.$result->image)}}" style="width: 300px; height: 100px;"></img>
                    </a>
                   
                  </td>
                  <td>{{date("M-d-Y",strtotime($result->date))}}</td>
                  <td><button class="btn btn-danger deleteimage" id="{{$result->gallery_id}}">Delete</button></td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <div class="modal fade" id="AddImageGallery">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Image</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form>
                        @csrf
                        <div class="row">
                              
                                    <div class="col-md-12">
                                        <label for="exampleInputFile">Picture</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="image" accept="image/*" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary Savetogallery">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="gallerymodal">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Image Preview</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                          <img src="" id="gallerypreview" style="width: 450px; height: 264px;" >
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
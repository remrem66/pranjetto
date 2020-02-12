@include('admin.header')
@include('admin.navbar')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Amenity</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Amenity Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{route('AddAmenity')}}" method="post" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Amenity Name</label>
                            <input type="text" name="amenity_name" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Price</label>
                            <input type="text" name="price" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="exampleInputFile">Picture</label>
                            <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" name="pic" accept="image/*" id="exampleInputFile">
                                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@include('admin.footer')
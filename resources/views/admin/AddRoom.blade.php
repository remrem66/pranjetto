@include('admin.header')
@include('admin.navbar')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Room</h1>
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
                <h3 class="card-title">Room Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{route('AddRoom')}}" method="post" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Category</label>
                            <input type="text" name="catgeory" class="form-control" value="{{old('category')}}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Capacity</label>
                            <select name="capacity" class="form-control" required>
                                <option> </option>
                                <option value="2"> 2 </option>
                                <option value="3"> 3 </option>
                                <option value="4"> 4 </option>
                                <option value="5"> 5 </option>
                                <option value="6"> 6 </option>
                                <option value="7"> 7 </option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
        
                        
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Price</label>
                            <input type="number" name="24hr_price" class="form-control" value="{{old('24hr_price')}}" required>
                            
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputFile">Main Picture</label>
                            <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" name="main_pic" accept="image/*" id="exampleInputFile" required>
                                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        
                        <div class="col-md-6">
                            <label for="exampleInputFile">Slot</label>
                            <input type="number" name="slot" class="form-control" value="{{old('slot')}}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Description</label>
                            <textarea name="description" class="form-control" value="{{old('description')}}" required></textarea>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
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
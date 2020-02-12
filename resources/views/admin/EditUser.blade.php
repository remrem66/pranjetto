@include('admin.header')
@include('admin.navbar')


<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">User Information</h3>
            </div>
            <div class="card-body">
              <table id="room" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Contact Number</th>
                  <th>Username</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $result)
                <tr>
                  <td>{{$result->name}}</td>
                  <td>{{$result->email}}</td>
                  <td>{{$result->contact_num}}</td>
                  <td>{{$result->username}}</td>
                  <td>
                  @if($result->user_status == 1)
                    <button class="btn btn-danger UserStatus" id="{{$result->user_id}}-0">Disable</button>
                  @endif
                  @if($result->user_status == 0)
                    <button class="btn btn-success UserStatus" id="{{$result->user_id}}-1">Enable</button>
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
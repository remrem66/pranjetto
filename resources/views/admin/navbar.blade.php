<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-male"></i>
          <span> Admin</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="{{route('AdminLogout')}}" class="dropdown-item">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
          <div class="dropdown-divider"></div>
        </div>
      </li>
    </ul>
  </nav>
  
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{route('AdminDashboard')}}" class="brand-link">
      <img src="admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{session('name')}} User</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview menu">
            <a href="{{route('AdminDashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-hotel"></i>
              <p>
                Room Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('AddRoomView')}}" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Add Room Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('EditRoomView')}}" class="nav-link">
                  <i class="fas fa-edit nav-icon"></i>
                  <p>Edit Rooms</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('RoomStatusView')}}" class="nav-link">
                  <i class="fas fa-exclamation-circle nav-icon"></i>
                  <p>Enable/Disable Rooms</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('RoomSlotView')}}" class="nav-link">
                  <i class="fab fa-get-pocket nav-icon"></i>
                  <p>Update Room Slots</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('ViewRooms')}}" class="nav-link">
                  <i class="fas fa-person-booth nav-icon"></i>
                  <p>View Rooms</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="{{route('MainpageSetting')}}" class="nav-link">
                  <i class="fas fa-tv nav-icon"></i>
                  <p>Mainpage Settings</p>
                </a>
              </li> -->
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-campground"></i>
              <p>
                Amenities Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('AddAmenitiesView')}}" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Add Amenities</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('EditAmenityView')}}" class="nav-link">
                  <i class="fas fa-edit nav-icon"></i>
                  <p>Edit Amenities</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('AmenityStatusView')}}" class="nav-link">
                  <i class="fas fa-exclamation-circle nav-icon"></i>
                  <p>Enable/Disable Amenities</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('ViewAmenities')}}" class="nav-link">
                  <i class="fas fa-binoculars nav-icon"></i>
                  <p>View Amenities</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Reservations
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{route('WalkInView')}}" class="nav-link">
                  <i class="fas fa-walking nav-icon"></i>
                  <p>New Walk in</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('OnlineReservations')}}" class="nav-link">
                  <i class="fas fa-calendar-check nav-icon"></i>
                  <p>Online Reservations</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('WalkInReservations')}}" class="nav-link">
                  <i class="fas fa-hiking nav-icon"></i>
                  <p>Walk-in Reservations</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('UploadedReceipts')}}" class="nav-link">
                  <i class="fas fa-file-invoice nav-icon"></i>
                  <p>Uploaded Receipts</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('Reschedule')}}" class="nav-link">
                  <i class="fas fa-clock nav-icon"></i>
                  <p>Reschedule</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                User Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('UserEdit')}}" class="nav-link">
                  <i class="fas fa-user-edit nav-icon"></i>
                  <p>Enable/Disable User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('ViewUsers')}}" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>View Users</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview menu">
            <a href="{{route('GalleryManagement')}}" class="nav-link">
              <i class="nav-icon fas fa-camera-retro"></i>
              <p>
                Gallery Management
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview menu">
            <a href="{{route('SalesReports')}}" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Sales Report
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
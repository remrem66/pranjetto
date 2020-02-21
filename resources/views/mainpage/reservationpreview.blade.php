@include('mainpage.header')
@include('mainpage.navbar')


<div class="section big-55-height over-hide">
    <div class="parallax parallax-top" style="background-image: url('{{asset('images/roomSapphire.jpg')}}')"></div>
    <div class="dark-over-pages"></div>
    <div class="hero-center-section pages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 parallax-fade-top">
                    <div class="hero-text"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<form method="POST" action="ProfileEdit">
@csrf
<div class="section padding-top z-bigger">
	<div class="container">
		<div class="row justify-content-center padding-bottom-smaller">
			<h6>Reservations</h6>
			<table id="room" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Reservation Code</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Contact Number</th>
                  <th>Room Name</th>
                  <th>Room Capacity</th>
                  <th>24-Hour Price</th>
                  <th>View Details</th>
                </tr>
                </thead>
                <tbody>
                @foreach($userReservations as $result)
                <tr>
                  <td>{{$result->reservation_code}}</td>
                  <td>{{$result->user_details->name}}</td>
                  <td>{{$result->user_details->email}}</td>
                  <td>{{$result->user_details->contact_num}}</td>
                  <td>{{$result->room_details->category}}</td>
                  <td>{{$result->no_of_persons}}</td>
                  <td>{{$result->total_price}}</td>
                  <td><a href="{{route('viewReservationDetails',$result->reservation_id)}}"><button type="button" class=" btn btn-primary">View</button></a>
                  @if ($result->reservation_status == 0 || $result->resevation_status == 1 )
                  <a href="{{route('cancelReservation',$result->reservation_id)}}" onclick="return confirm('Are you sure you want to cancel this reservation?')"><button type="button" class=" btn btn-danger">Cancel</button></a></td>
                  @endif
                </tr>
                @endforeach
                </tbody>
              </table>
				
			</div>
			
		</div>	
	</div>
	</form>

@include('mainpage.footer')

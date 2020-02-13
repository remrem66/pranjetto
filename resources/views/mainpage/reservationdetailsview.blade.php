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


<div class="section padding-top z-bigger">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 mt-4 mt-lg-0">
            <div class="section pt-4">
              <div class="row">
                <div class="col-12">
                  <h5 class="mb-3">Reservation Details</h5>
                </div>
                <div class="col-lg-6">
                  <p><strong class="color-black">Name:</strong> Up to {{$data->name}} person</p> 
                  <p><strong class="color-black">Reservation Code:</strong> {{$data->reservation_code}}</p> 
                </div>  
                <div class="col-lg-6">
                  <p><strong class="color-black">Room Name:</strong> {{$data->room_details->room_name}}</p> 
                  <p><strong class="color-black">Room Num:</strong> {{$data->room_details->room_num}}</p>  
                </div>
                <div class="col-lg-6">
                  <p><strong class="color-black">Capacity: </strong>{{$data->room_details->capacity}}</p>  
                </div>
                <div class="col-lg-6">
                  <p><strong class="color-black">Total Price:</strong>₱{{$data->total_price}}</p> 
                </div>
              </div>
            </div>
          </div>
      <div class="col-lg-4 order-first order-lg-last">
        <div class="col-12"><h5 class="mb-3">Upload Receipt</h5></div>
        <form method="post" action="{{route('reservationUpload')}}" enctype="multipart/form-data">
          @csrf
          <input type="file" required name="image" class="btn btn-primary" accept="image/*" style="margin-bottom:10px;">
          
          <input type="hidden" name="reservation_id" value="{{$data->reservation_id}}">
          <input class="btn btn-primary" type="submit">
        </form>
        @if($data->receipt_image != null)
        <div style="width: 500px; border: 5px solid black;">
          <img style="max-width: 100%; max-height: 100%; display: block;" src="{{URL::asset('images/'.$data->receipt_image)}}">
        </div>
        @endif
      </div>
    </div>
	</div>	
</div>


@include('mainpage.footer')

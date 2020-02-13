@include('mainpage.header')
@include('mainpage.navbar')

<div class="section big-55-height over-hide z-bigger">
	
    <div class="parallax parallax-top" style="background-image: url('mainpage/img/room.jpg')"></div>
    <div class="dark-over-pages"></div>

    <div class="hero-center-section pages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 parallax-fade-top">
                    <div class="hero-text">Amenities</div>
                </div>
            </div>
        </div>
    </div>
</div>

	<div class="section padding-top-bottom over-hide background-grey">
		<div class="container">
			<div class="row justify-content-center">
            @foreach($data as $result)
                <div class="col-md-6 mt-4 mt-md-0">
					<div class="room-box background-white">
						<div class="room-name">{{$result->amenity_name}}</div>
						<div class="room-per">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star-o"></i>
						</div>
						<img src="images/{{$result->image}}" alt="">
						<div class="room-box-in">
							<h5 class="">{{$result->amenity_name}}</h5>
							<p class="mt-3">{{$result->description}}</p>
							
							<div class="room-icons mt-4 pt-4">
								
								<h6 class="">Price: ₱{{$result->price}}</h6>
							</div>
						</div>
					</div>
				</div>
            @endforeach
			
			</div>	
		</div>		
    </div>

@include('mainpage.footer')
@include('mainpage.header')
@include('mainpage.navbar')

<div class="section big-55-height over-hide z-bigger">
	
    <div class="parallax parallax-top" style="background-image: url('mainpage/img/room.jpg')"></div>
    <div class="dark-over-pages"></div>

    <div class="hero-center-section pages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 parallax-fade-top">
                    <div class="hero-text">{{$name}}</div>
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
						<div class="room-name">{{$result->room_name}}</div>
						<div class="room-per">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star-o"></i>
						</div>
						<img src="images/{{$result->main_pic}}" alt="">
						<div class="room-box-in">
							<h5 class="">{{$result->room_name}}</h5>
							<p class="mt-3">{{$result->description}}</p>
							<a class="mt-1 btn btn-primary" href="{{route('RoomPreview',$result->room_id)}}">Book now (₱{{$result->twentyfourhr_price}}) </a>
							<div class="room-icons mt-4 pt-4">
								<img src="mainpage/img/4.svg" alt="">
								<img src="mainpage/img/2.svg" alt="">
								<img src="mainpage/img/6.svg" alt="">
								<img src="mainpage/img/1.svg" alt="">
								<a href="{{route('RoomPreview',$result->room_id)}}">full info</a>
							</div>
						</div>
					</div>
				</div>
            @endforeach
			
			</div>	
		</div>		
    </div>

@include('mainpage.footer')
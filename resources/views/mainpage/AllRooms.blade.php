@include('mainpage.header')
@include('mainpage.navbar')

<div class="section big-55-height over-hide z-bigger">
	
    <div class="parallax parallax-top" style="background-image: url('mainpage/img/room.jpg')"></div>
    <div class="dark-over-pages"></div>

    <div class="hero-center-section pages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 parallax-fade-top">
                    <div class="hero-text">Rooms Available</div>
                </div>
            </div>
        </div>
    </div>
</div>

	<div class="section padding-top-bottom over-hide background-grey">
		<div class="container">
			<div class="row justify-content-center">
            @foreach($categories as $category)
                <div class="col-md-6 mt-4 mt-md-0">
					<div class="room-box background-white">
						<div class="room-name">{{$category->category}}</div>
						<div class="room-per">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star-o"></i>
						</div>
						<img src="images/{{$category->main_pic}}" alt="">
						<div class="room-box-in">
							<h5 class="">{{$category->category}}</h5>
							<p class="mt-3">Available rooms: 
								{{$category->slot}}
							</p>
							@if(session('logged') != true)
							<a class="mt-1 btn btn-primary" href="{{route('login')}}">Login </a>
							@endif
							@if(session('logged') == true)
							<a class="mt-1 btn btn-primary" href="{{route('RoomPreview',$category->room_id)}}">Book now (₱{{$category->twentyfourhr_price}}) </a>
							@endif
							<div class="room-icons mt-4 pt-4">
								<img src="mainpage/img/4.svg" alt="">
								<img src="mainpage/img/2.svg" alt="">
								<img src="mainpage/img/6.svg" alt="">
								<img src="mainpage/img/1.svg" alt="">
							</div>
							
						</div>
					</div>
				</div>
            @endforeach
			
			</div>	
		</div>		
    </div>

@include('mainpage.footer')
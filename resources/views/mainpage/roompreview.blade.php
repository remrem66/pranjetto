@include('mainpage.header')
@include('mainpage.navbar')
<style>
#startDate{
	position: relative;
	display: block;
	margin: 0;
	padding: 0;
	padding-left: 15px;
	padding-top: 12px;
	padding-bottom: 12px;
	width: 100%;
	font-family: 'Poppins', sans-serif;
	font-size: 13px;
	line-height: 1.2;
	text-transform: uppercase;
	letter-spacing: 1px;
	font-weight: 300;
	text-align: left;
	color: #fff;
	border: solid 1px rgba(255,255,255,.1);
	outline: none;
	cursor: pointer;
	background-color: transparent;
	transition: border-color .2s ease-out;
}
#endDate{
	position: relative;
	display: block;
	margin: 0;
	padding: 0;
	padding-left: 15px;
	padding-top: 12px;
	padding-bottom: 12px;
	width: 100%;
	font-family: 'Poppins', sans-serif;
	font-size: 13px;
	line-height: 1.2;
	text-transform: uppercase;
	letter-spacing: 1px;
	font-weight: 300;
	text-align: left;
	color: #fff;
	border: solid 1px rgba(255,255,255,.1);
	outline: none;
	cursor: pointer;
	background-color: transparent;
	transition: border-color .2s ease-out;
}
#extra_mattress{
	position: relative;
	display: block;
	margin: 0;
	padding: 0;
	padding-left: 15px;
	padding-top: 12px;
	padding-bottom: 12px;
	width: 100%;
	font-family: 'Poppins', sans-serif;
	font-size: 13px;
	line-height: 1.2;
	text-transform: uppercase;
	letter-spacing: 1px;
	font-weight: 300;
	text-align: left;
	color: #fff;
	border: solid 1px rgba(255,255,255,.1);
	outline: none;
	cursor: pointer;
	background-color: transparent;
	transition: border-color .2s ease-out;
}

</style>

<div class="section big-55-height over-hide">
	
    <div class="parallax parallax-top" style="background-image: url('{{asset('mainpage/img/room.jpg')}}')"></div>
    <div class="dark-over-pages"></div>

    <div class="hero-center-section pages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 parallax-fade-top">
                    <div class="hero-text">Rooms Gallery</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section padding-top-bottom z-bigger">
		<div class="section z-bigger">		
			<div class="container">
				<div class="row">
					<div class="col-lg-8 mt-4 mt-lg-0">
						<div class="section">
							<div class="customNavigation rooms-sinc-1-2">
								<a class="prev-rooms-sync-1"></a>
								<a class="next-rooms-sync-1"></a>
							</div>		
							<div id="rooms-sync1" class="owl-carousel">
                                <div class="item">	
								    <img src="{{asset('images/'.$data->main_pic)}}" alt="">					
							    </div>
                            @for($x = 0; $x < count($pictures); $x++)
								<div class="item">
									<img src="{{asset('images/'.$pictures[$x])}}" alt="">						
								</div>
                            @endfor
							</div>
						</div>
						<div class="section">
							<div id="rooms-sync2" class="owl-carousel">
                                <div class="item">	
								    <img src="{{asset('images/'.$data->main_pic)}}" alt="">					
							    </div>
                            @for($y = 0; $y < count($pictures); $y++)
								<div class="item">
									<img src="{{asset('images/'.$pictures[$y])}}" alt="">						
								</div>
                            @endfor
							</div>
						</div>
						<div class="section pt-5">
							<h5>description</h5>
							<p class="mt-3">{{$data->description}}</p>
						</div>
						<div class="section pt-4">
							<div class="row">
								<div class="col-12">
									<h5 class="mb-3">Overview</h5>
								</div>
								<div class="col-lg-6">
									<p><strong class="color-black">Occupancy:</strong> Up to {{$data->capacity}} person</p>	
									<p><strong class="color-black">Smoking:</strong> No smoking</p>	
								</div>	
								<div class="col-lg-6">
									<p><strong class="color-black">Room service:</strong> Yes</p>	
									<p><strong class="color-black">Swimming pool:</strong> Yes</p>	
								</div>
								<div class="col-lg-6">
									<p><strong class="color-black">24-hr Rate:</strong>₱{{$data->twentyfourhr_price}}</p>	
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 order-first order-lg-last">
						<div class="section background-dark p-4">	
							<div class="row">
								<div class="col-12">
									<div class="row">	
										<div class="col-12">
											<div class="form-item">
												<span class="fontawesome-calendar"></span>
												<input class="form-control" type="text" autocomplete="off" id="startDate" name="start" placeholder="check-in date" value="{{session('check_in')}}"/>
												<span class="date-text date-depart"></span>
											</div>
										</div>
										<div class="col-12 pt-4">
											<div class="form-item">
												<span class="fontawesome-calendar"></span>
												<input class="form-control" type="text" autocomplete="off" id="endDate" name="end" disabled="disabled" placeholder="check-out date" value="{{session('check_out')}}"/>
												<span class="date-text date-return"></span>
											</div>
										</div>
									</div>	
								</div>
								<div class="col-12">
									<div class="row">
										<div class="col-12 pt-4">
											<select class="wide" id="no_of_persons">
												<option value="0" data-display="# of persons"></option>
												@for($x = 0; $x < $data->capacity; $x++)
												<option value="{{$x+1}}">{{$x+1}}</option>
												@endfor
											</select>
										</div>
										<div class="col-12 pt-4">
											<select class="wide" id="quantity">
												<option value="0" data-display="Quantity"></option>
												@for($x = 0; $x < $data->slot; $x++)
												<option value="{{$x+1}}">{{$x+1}}</option>
												@endfor
											</select>
										</div>
										<div class="col-12 pt-4">
											<input class="form-control" type="number" autocomplete="off" id="extra_mattress" name="end" placeholder="Extra Mattress" min="1" disabled="disable">
											<input type="hidden" id="room_id" value="{{$data->room_id}}">
											<input type="hidden" id="fix_price" value="{{$data->twentyfourhr_price}}">
											<input type="hidden" id="capacity" value="{{$data->capacity}}">
											
										</div>
									</div>
								</div>
								<div class="col-12 pt-4">
									@if(session('logged') != true)
									<a class="booking-button" href="{{route('login')}}">Login to reserve</a>
									@endif
									@if(session('logged') == true)
									<button class="btn booking-button roomonlinereserve">book now</button>
									@endif
									@if(session('more') == true)
									<a href="{{route('MoreRooms')}}" class="btn booking-button">Reserve More</a>
									@endif
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>					
		</div>
	</div>
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                		<div class="modal-dialog modal-lg" role="document">
                    		<div class="modal-content">
                        		<div class="modal-header">
                            		<h5 class="modal-title" id="exampleModalLabel">Reservation Details</h5>
                            		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                		<span aria-hidden="true">&times;</span>
                            		</button>
                        		</div>
                    			<form>
                        			@csrf
                            		<div class="modal-body">
                                		<div class="form-group row">
											<label class="col-form-label col-md-1 col-sm-1 ">Name</label>
                                    		<div class="col-md-5 col-sm-5 ">
                                        		<h5> {{session('name')}} </h5>
											</div>
											<label class="col-form-label col-md-2 col-sm-2 ">Contact #: </label>
                                    		<div class="col-md-4 col-sm-4 ">
                                        		<h5> {{session('contact_num')}} </h5>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-1 col-sm-1 ">Email:</label>
                                    		<div class="col-md-5 col-sm-5">
                                        		<h6 style="margin-top:8px;"> {{session('email')}} </h6>
											</div>
											<label class="col-form-label col-md-2 col-sm-2 "># of persons: </label>
                                    		<div class="col-md-4 col-sm-4 ">
												<h5 id="totalperson">  </h5>
												<input type="hidden" id="total_price">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-2 col-sm-2 ">Check-in:</label>
                                    		<div class="col-md-4 col-sm-4 ">
                                        		<h5 id="in_check">  </h5>
											</div>
											<label class="col-form-label col-md-2 col-sm-2 ">Check-out:</label>
                                    		<div class="col-md-4 col-sm-4 ">
                                        		<h5 id="out_check">  </h5>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-2 col-sm-2">Extra mattress</label>
                                    		<div class="col-md-4 col-sm-4 ">
												<h5 id="mattress_extra">  </h5>
												<input type="hidden" id="user_id" value="{{session('user_id')}}">
												<input type="hidden" id="email" value="{{session('email')}}">
											</div>
											<label class="col-form-label col-md-2 col-sm-2 ">Quantity</label>
                                    		<div class="col-md-4 col-sm-4 ">
                                        		<h5 id="qty">  </h5>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-2 col-sm-2 ">Total Price</label>
                                    		<div class="col-md-4 col-sm-4 ">
                                        		<h5 id="tot_price">  </h5>
											</div>
										</div>
										
                            		</div>
                            		<div class="modal-footer">
                                		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                		<button type="button" class="btn btn-primary" id="sbmtOnlineReservation">Confirm Check Out</button>
                                		<div id="paypal-button"></div>
                            		</div>
                        		</form>
                    		</div>
                		</div>
            		</div>


@include('mainpage.footer')
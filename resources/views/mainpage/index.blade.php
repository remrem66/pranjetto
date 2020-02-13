@include('mainpage.header')
@include('mainpage.navbar')
<style>
#start1{
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
#end1{
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
::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
  color: white;
  opacity: 7; /* Firefox */
}

</style>
	<div class="section background-dark over-hide">
	<form action="{{route('AllRooms')}}" method="POST">
	@csrf
		<div class="hero-center-section">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-10 col-sm-8 parallax-fade-top">
						<div class="hero-text">Discover your paradise under the sky</div>
					</div>
					<div class="col-12 mt-3 mb-5 parallax-fade-top">
						<div class="hero-stars">
							<i class="fa fa-star-o"></i>
							<i class="fa fa-star-o"></i>
							<i class="fa fa-star-o"></i>
							<i class="fa fa-star-o"></i>
							<i class="fa fa-star-o"></i>
							
						</div>
						
					</div>
					@if(session('logged') != true)
					<div class="col-6 col-sm-4 col-lg-2">
						<a href="{{route('login')}}" class="btn booking-button">book now</a>
					</div>
					@endif
					@if(session('logged') == true)
					<div class="col-12 mt-3 parallax-fade-top">
						<div class="booking-hero-wrap">
							<div class="row justify-content-center">
								
								
								<div class="col-5 no-mob">
								
									<div class="input-daterange input-group">
										<div class="row">
										
											<div class="col-6">
												<div class="form-item">
													<span class="fontawesome-calendar"></span>
													<input class="input-sm" type="text" autocomplete="off" id="start1" name="start" placeholder="check-in date" />
													<span class="date-text date-depart"></span>
												</div>
											</div>
											<div class="col-6">
												<div class="form-item">
													<span class="fontawesome-calendar"></span>
													<input class="input-sm" type="text" autocomplete="off" id="end1" name="end" placeholder="check-out date" disabled/>
													<span class="date-text date-return"></span>
												</div>
											</div>
										
										</div>
									</div>	
								</div>
								
								<div class="col-6  col-sm-4 col-lg-2">
									<button type="submit" class="btn booking-button">book now</button>
								</div>
								
							</div>
						</div>
					</div>
					@endif
				</div>
			</div>
		</div>
		</form>
		<div>
			
		</div>
		<div class="slideshow">
			<div class="slide slide--current parallax-top">
				<figure class="slide__figure">
					<div class="slide__figure-inner">
						<div class="slide__figure-img" style="background-image: url('mainpage/img/mainpage.jpeg')"></div>
						<div class="slide__figure-reveal"></div>
					</div>
				</figure>
			</div>
			<div class="slide parallax-top">
				<figure class="slide__figure">
					<div class="slide__figure-inner">
						<div class="slide__figure-img" style="background-image: url('mainpage/img/mainpage2.jpg')"></div>
						<div class="slide__figure-reveal"></div>
					</div>
				</figure>
			</div>
			<div class="slide parallax-top">
				<figure class="slide__figure">
					<div class="slide__figure-inner">
						<div class="slide__figure-img" style="background-image: url('mainpage/img/mainpage3.jpg')"></div>
						<div class="slide__figure-reveal"></div>
					</div>
				</figure>
			</div>
			<!-- revealer -->
			<div class="revealer">
				<div class="revealer__item revealer__item--left"></div>
				<div class="revealer__item revealer__item--right"></div>
				
			</div>
			<nav class="arrow-nav fade-top">
				<button class="arrow-nav__item arrow-nav__item--prev">
					<svg class="icon icon--nav"><use xlink:href="#icon-nav"></use></svg>
				</button>
				<button class="arrow-nav__item arrow-nav__item--next">
					<svg class="icon icon--nav"><use xlink:href="#icon-nav"></use></svg>
				</button>
			</nav>
			<!-- navigation -->
			<nav class="nav fade-top">
			
				<button class="nav__button">
					<span class="nav__button-text"></span>
				</button>
				
				<h2 class="nav__chapter">discover your paradise</h2>
				<div class="toc">
				
					<a class="toc__item" href="#entry-1">
						<span class="toc__item-title">discover your paradise</span>
					</a>
					<a class="toc__item" href="#entry-2">
						<span class="toc__item-title">unpretentious comfort</span>
					</a>
					<a class="toc__item" href="#entry-3">
						<span class="toc__item-title">azure sea sparkling</span>
					</a>
				</div>
			</nav>
			<!-- little sides -->
			<div class="slideshow__indicator"></div>
			<div class="slideshow__indicator"></div>
		</div>
	</div>
	
	<div class="section padding-top-bottom over-hide">
		<div class="container">
			<div class="row">
				<div class="col-md-6 align-self-center">
					<div class="row justify-content-center">
						<div class="col-10">
							<div class="subtitle text-center mb-4">Pranjetto Resort</div>
							<h2 class="text-center">Here is a tribute to good life!</h2>
							<p class="text-center mt-5">Enjoy the resfreshing and soulful vibe of Pranjetto Resort which also comes with a delightful hospitality environment and services to all recreational and leisure activities.</p>
						</div>
					</div>
				</div>
				<div class="col-md-6 mt-4 mt-md-0">
					<div class="img-wrap">
						<img src="images/m1.jpg" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="section background-grey over-hide">
		<div class="container-fluid px-0">
			<div class="row mx-0">
				<div class="col-xl-6 px-0">
					<div class="img-wrap" id="rev-1">
						<img src="images/waw.jpeg" alt="">
					</div>
				</div>
				<div class="col-xl-6 px-0 mt-4 mt-xl-0 align-self-center">
					<div class="row justify-content-center">
						<div class="col-10 col-xl-8 text-center">
							<h3 class="text-center">Private pool suite</h3>
							<p class="text-center mt-4">Pranjetto Resort brings you the best getaway for the day with the most relaxing pool and best ambiance that any resort could offer.</p>
						</div>	
					</div>
				</div>
			</div>
			<div class="row mx-0">
				<div class="col-xl-6 px-0 mt-4 mt-xl-0 pb-5 pb-xl-0 align-self-center">
					<div class="row justify-content-center">
						<div class="col-10 col-xl-8 text-center">
							<h3 class="text-center">Sea view suite</h3>
							<p class="text-center mt-4">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.</p>
							
						</div>	
					</div>
				</div>
				<div class="col-xl-6 px-0 order-first order-xl-last mt-5 mt-xl-0">
					<div class="img-wrap" id="rev-2">
						<img src="images/m3.jpg" alt="">
						
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<br>
	<div class="section background-dark over-hide">
		
	</div>
	
	
	
	
	
	
	
	
@include('mainpage.footer')
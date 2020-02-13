<div class="loader">
		<div class="loader__figure"></div>
	</div>

	<svg class="hidden">
		<svg id="icon-nav" viewBox="0 0 152 63">
			<title>navarrow</title>
			<path d="M115.737 29L92.77 6.283c-.932-.92-1.21-2.84-.617-4.281.594-1.443 1.837-1.862 2.765-.953l28.429 28.116c.574.57.925 1.557.925 2.619 0 1.06-.351 2.046-.925 2.616l-28.43 28.114c-.336.327-.707.486-1.074.486-.659 0-1.307-.509-1.69-1.437-.593-1.442-.315-3.362.617-4.284L115.299 35H3.442C2.032 35 .89 33.656.89 32c0-1.658 1.143-3 2.552-3H115.737z"/>
		</svg>
	</svg>

	<nav id="menu-wrap" class="menu-back cbp-af-header">
		<div class="menu">
			<a href="index.html" >
				<div class="logo">
					<img src="images/pranjetto1.png" alt="">
				</div>
			</a>
			<ul>
				<li>
					<a class="curent-page" href="{{route('index')}}">home</a>
				</li>
				<li>
					<a href="{{route('galleryview')}}">Gallery</a>
				</li>
				<li>
					<a href="{{route('about')}}">about us</a>
				</li>
				<li>
					<a href="{{route('Amenities')}}">amenities</a>
				</li>
				@if(session('logged') == true)
				<li>
					<a href="{{route('reservations')}}">Your Reservation</a>
				</li>
				@endif
				@if(session('logged') != true)
				<li>
					<a href="{{route('login')}}">Login</a>
				</li>
				@endif
				@if(session('logged') == true)
					<li>
						<a href="#"> Profile Management </a>
						<ul>
							<li><a href="{{route('editprofileview')}}">Edit Profile</a></li>
							<li><a href="{{route('changepasswordview')}}">Change Password</a></li>
							<li><a href="{{route('logout')}}">Logout</a></li>
						</ul>
					</li>
				@endif
			</ul>
		</div>
	</nav>
		
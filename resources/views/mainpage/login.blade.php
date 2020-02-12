@include('mainpage.header')
@include('mainpage.navbar')

<div class="section big-55-height over-hide">
    <div class="parallax parallax-top" style="background-image: url('{{asset('mainpage/img/room.jpg')}}')"></div>
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
<form action="{{route('AuthenticateUser')}}" method="POST">
@csrf
<div class="section padding-top z-bigger">
	<div class="container">
			<div class="row justify-content-center padding-bottom-smaller">
				<div class="col-md-8">
					<div class="subtitle with-line text-center mb-4"></div>
					<h3 class="text-center padding-bottom-small">Login to your account</h3>
				</div>
				<div class="section clearfix"></div>
				<div class="col-md-4 ajax-form">
					<input name="username" type="text" placeholder="Username" autocomplete="off"/>
				</div>
				<div class="col-md-4 mt-4 mt-md-0 ajax-form">
					<input name="password" type="password"  placeholder="Password" autocomplete="off"/>
				</div>
                
				<div class="section clearfix"></div>
                <?php if (isset($message)): ?>
					<div class="section clearfix"></div>
                	<br>
			    	<div class="alert alert-danger alert-dismissible" role="alert">
			        	<?= $message ?>
			    	</div>
				<?php endif ?>
				<div class="col-md-8 mt-3 ajax-checkbox">
					<ul class="list">
						<li class="list__item">
							<label class="label--checkbox">
                                <a href="{{route('register')}}"> Create an account </a>
							</label>
						</li>
					</ul>
				</div>
                <br>
                <br>
				<div class="col-md-8 mt-3 ajax-form text-center">
					<button type="submit" class="send_message" id="send" data-lang="en"><span>submit</span></button>
				</div>
				<div class="section clearfix"></div>
				<div class="col-md-8 padding-top-bottom">
					<div class="sep-line"></div>
				</div>
				
			</div>
			
		</div>	
	</div>
</form>

@include('mainpage.footer')
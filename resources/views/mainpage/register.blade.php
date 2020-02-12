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
<form method="POST" action="UserAuthentication">
@csrf
<div class="section padding-top z-bigger">
	<div class="container">
		<div class="row justify-content-center padding-bottom-smaller">
			<div class="col-md-8">
				<div class="subtitle with-line text-center mb-4"></div>
				<h3 class="text-center padding-bottom-small">Create an account</h3>
			</div>
			<div class="section clearfix"></div>
			
			<div class="row">
				<div class="col-md-6 ajax-form">
					<input name="fname" type="text" placeholder="First Name" autocomplete="off"/>
				</div>
				<div class="col-md-6 ajax-form">
					<input name="lname" type="text"  placeholder="Last Name" autocomplete="off"/>
				</div>
			</div>
			<div class="section clearfix"></div>
			<br>
			<div class="row">
				<div class="col-md-6 ajax-form">
					<input name="contact_num" type="text" placeholder="Contact Number" autocomplete="off"/>
				</div>
				<div class="col-md-6 mt-6 ajax-form">
					<input name="email" type="email"  placeholder="Email Address" autocomplete="off"/>
				</div>
			</div>
            <div class="section clearfix"></div>
			<br>
			<div class="row">
				<div class="col-md-6 ajax-form">
					<input name="username" type="text" placeholder="Username" autocomplete="off"/>
				</div>
				<div class="col-md-6 mt-6 ajax-form">
					<input name="password" type="password"  placeholder="Password" autocomplete="off"/>
				</div>
			</div>
			<div class="section clearfix"></div>
			<br>
			<div class="row">
				<div class="col-md-12 mt-12 ajax-form">
					<input name="confirm_pass" type="password" placeholder="Confirm Password" autocomplete="off"/>
				</div>
				
			</div>
			
			<?php if (isset($message)): ?>
				<div class="section clearfix"></div>
                <br>
			    <div class="alert alert-danger alert-dismissible" role="alert">
			        <?= $message ?>
			    </div>
			<?php endif ?>
				<div class="section clearfix"></div>
                <br>
				<div class="col-md-8 mt-3 ajax-checkbox">
					<ul class="list">
						<li class="list__item">
							<label class="label--checkbox">
                                <a href="{{route('login')}}"> Login to your account </a>
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
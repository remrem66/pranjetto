@include('mainpage.header')
@include('mainpage.navbar')

<div class="section big-55-height over-hide z-bigger">
	
    <div class="parallax parallax-top" style="background-image: url('mainpage/img/room.jpg')"></div>
    <div class="dark-over-pages"></div>

    <div class="hero-center-section pages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 parallax-fade-top">
                    <div class="hero-text">Gallery</div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="section padding-top-bottom over-hide">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 align-self-center">
                <div class="subtitle with-line text-center mb-4">gallery</div>
                <h3 class="text-center padding-bottom-small">images</h3>
            </div>
            <div class="section clearfix"></div>
            @foreach($data as $result)
            <div class="col-md-4">
                <a href="{{asset('gallery/'.$result->image)}}" data-fancybox="gallery">							 
                    <div class="img-wrap gallery-small">
                        <img src="{{asset('gallery/'.$result->image)}}" alt="">
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>

@include('mainpage.footer')
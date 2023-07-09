@extends('layouts.main')

@section('content')


        <!-- home page slider ----->
        <div class="custom-banner">
            <div class="container-fluid p-0">
                <div class="owl-new-slider owl-carousel owl-theme">

                  @forelse($sliders as $slider) 
                    <div class="item">
                        <img src="{{ URL::asset('public/uploads/slider/'.$slider->photo)}}" alt="" class="">
                        <div class="caption">
                            <h2 class="banner-heading">{{$slider->title_text}}</h2>
                            <p class="banner-paragraph">{!! $slider->details_text !!}</p>
                            <div class="slider-button">
                            <a href="{{route('video-details',['id'=>base64_encode($slider->video_id)] )}}" class="btn slider-btn-one"><span><i class="fa fa-play" aria-hidden="true"></i></span> Play</a>
                            <a href="{{route('about-us')}}" class="btn slider-btn-two"><span><i class="fa fa-info-circle" aria-hidden="true"></i></span> More Info</a>
                            </div>  
                        </div>
                    </div>
                    @empty
                  @endforelse

                </div>
                <div class="owl-theme">
                    <div class="owl-controls">
                      <div class="custom-nav owl-nav"></div>
                    </div>
                  </div>
            </div>
        </div>
        <!---- border div ---->
        <div class="custom-border"></div>
        <!---// border div --->
        <!-- //home page slider --->

        @if(Auth::guard('frontend')->user()->premium_member == '1')

            <!----- prime video area ---->
            <section class="prime-area section-top-gap section-bottom-gap">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="video-area-title">
                                <h3>Today's Prime Videos</h3>
                            </div>
                        </div> 
                    </div>

                    <div class="row">

                        @forelse($prime_videos as $prime)

                            @if($prime->shows == '1')

                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <div class="detail-poster-area">
                                        <div class="box-images mt-2">
                                            <a href="{{route('video-details',['id'=>base64_encode($prime->video_id)] )}}">
                                            <div class="box-video relative">
                                                <img src="{{ !empty($prime->video->video_image) ? URL::asset('public/uploads/video/'.$prime->video->video_image) : '' }}" class="img-fluid w-100" alt="Image">
                                                <span class="absolute play-buttons-icon">
                                                    <i class="fa fa-play icon-play"></i>
                                                </span>
                                            </div>
                                            </a>
                                        </div>
                                        <div class="video-post-date custom-prime">
                                            <span class="video-posts-author primr-time-title">Morning Video</span>
                                            <div class="video-watch-share-item">
                                                <span class="btn-watchlist">
                                                    <i class="fa fa-clock-o" aria-hidden="true"></i> 
                                                    Starts On : {{date('h:i A', strtotime($prime->start))}}
                                                </span>
                                                <span class="video-posts-author">
                                                    <i class="fa fa-calendar" aria-hidden="true"></i> 
                                                    {{date('jS F, Y', strtotime($prime->start))}}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endif

                            @if($prime->shows == '2')

                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <div class="detail-poster-area">
                                        <div class="box-images mt-2">
                                            <a href="{{route('video-details',['id'=>base64_encode($prime->video_id)] )}}">
                                            <div class="box-video relative">
                                                <img src="{{ !empty($prime->video->video_image) ? URL::asset('public/uploads/video/'.$prime->video->video_image) : '' }}" class="img-fluid w-100" alt="Image">
                                                <span class="absolute play-buttons-icon">
                                                    <i class="fa fa-play icon-play"></i>
                                                </span>
                                            </div>
                                            </a>
                                        </div>
                                        <div class="video-post-date custom-prime">
                                            <span class="video-posts-author primr-time-title">Evening Video</span>
                                            <div class="video-watch-share-item">
                                                <span class="btn-watchlist">
                                                    <i class="fa fa-clock-o" aria-hidden="true"></i> 
                                                    Starts On : {{date('h:i A', strtotime($prime->start))}}
                                                </span>
                                                <span class="video-posts-author">
                                                    <i class="fa fa-calendar" aria-hidden="true"></i> 
                                                    {{date('jS F, Y', strtotime($prime->start))}}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endif

                        @empty
                        <marquee class="help-block"><i class="fa fa-video-camera"></i> Prime Videos are Not Available Right Now !</marquee>
                        @endforelse

                    </div>
                </div>        
            </section>
            <!---- end prime video area --->

        @endif

        <!----- video carousel ---->
        <section class="video-area section-top-gap section-bottom-gap">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="video-area-title">
                            <h3>trending now</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="owl-carousel video-slider">

                            @forelse($trending_videos as $trend)
                                <div class="post-slide">
                                    <div class="post-img">
                                        <img src="{{!empty($trend->image)? URL::asset('public/uploads/video/'.$trend->image) : '' }}" alt="Video Image">
                                        <a href="{{route('video-details',['id'=>base64_encode($trend->id)] )}}" class="over-layer"><i class="icofont-play-alt-2"></i></a>
                                        <span class="video-item-content">{{$trend->video_name}}</span>
                                    </div>
                                </div>
                            @empty
                            @endforelse

                            


                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!---// video carousel ---->

        <!--- big video ---->
        <section class="video-area section-top-gap section-bottom-gap">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="video-area-title">
                            <h3>Popular Movies</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="owl-carousel big-video-slider">

                            @forelse($popular_videos as $popular)
                                <div class="post-slide">
                                    <div class="post-img">
                                        <img src="{{!empty($popular->video_image)? URL::asset('public/uploads/video/'.$popular->video_image) : '' }}" alt="Video Image">
                                        <a href="{{route('video-details',['id'=>base64_encode($popular->id)] )}}" class="over-layer"><i class="icofont-play-alt-2"></i></a>
                                        <span class="video-item-content-two">{{$popular->video_name}}</span>
                                    </div>
                                </div>
                            @empty
                            @endforelse

                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!---big video---->

        <!----- latest video carousel ---->
        <section class="video-area section-top-gap section-bottom-gap">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="video-area-title">
                            <h3>Latest Movies</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="owl-carousel video-slider">


                            @forelse($latest_videos as $latest)
                                <div class="post-slide">
                                    <div class="post-img">
                                        <img src="{{!empty($latest->image)? URL::asset('public/uploads/video/'.$latest->image) : '' }}" alt="Video Image">
                                        <a href="{{route('video-details',['id'=>base64_encode($latest->id)] )}}" class="over-layer"><i class="icofont-play-alt-2"></i></a>
                                        <span class="video-item-content">{{$latest->video_name}}</span>
                                    </div>
                                </div>
                            @empty
                            @endforelse

                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!---// video carousel ---->

        <!---------- footer -------->
        <!---- border div ---->
        <div class="custom-border"></div>
        <!---// border div --->

@stop

@section('page_js')


@endsection

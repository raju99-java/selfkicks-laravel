@extends('layouts.main')

@section('content')

        <!---------bradecrumbs ---->
        <div class="custombreadcrumbs">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-12 col-lg-6">
                        <div class="bread-content">
                            <h1>Watch List</h1>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="bread-content-menu">
                            <ul class="list-unstyled">
                                <li class="list-inline-item"><a href="{{route('/')}}">Home</a></li>
                                <li class="list-inline-item"><i class="fa fa-caret-right" aria-hidden="true"></i></li>
                                <li class="list-inline-item">Watch List</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--------//bradecrumbs ---->

        <!----- movie carousel ---->
        <section class="video-area section-top-gap section-bottom-gap">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="video-area-title">
                            <h3>My Watch List</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="owl-carousel another-slider">

                        @forelse($watch_lists as $watch_list)
                            <div class="post-slide">
                                <div class="post-img">
                                    <div class="watchlist-item-button">
                                        @csrf
                                        <a href="javascript:;" onclick="removeWatchList(this)" data-id="{{base64_encode($watch_list->id)}}" title="Remove">
                                            <i class="fa fa-times"></i>Remove
                                        </a>
                                    </div>
                                    <img src="{{ !empty($watch_list->video->image) ? URL::asset('public/uploads/video/'.$watch_list->video->image) : '' }}" alt="Video Image">
                                    <a href="{{route('video-details',['id'=>base64_encode($watch_list->video_id)] )}}" class="over-layer"><i class="icofont-play-alt-2"></i></a>
                                    <span class="video-item-content">{{!empty($watch_list->video->video_name) ? $watch_list->video->video_name : 'NA' }}</span>
                                </div>
                            </div>
                        @empty
                        @endforelse

                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!---// movie carousel ---->

        <!----- movie carousel ---->
        <!-- <section class="video-area section-top-gap section-bottom-gap">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="video-area-title">
                            <h3>Shows</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="owl-carousel another-slider">
                            <div class="post-slide">
                                <div class="post-img">
                                    <div class="watchlist-item-button">
                                        <a href="#" title="Remove">
                                            <i class="fa fa-times"></i>Remove
                                        </a>
                                    </div>
                                    <img src="{{ URL::asset('public/frontend/img/video-1.jpg')}}" alt="Video Image">
                                    <a href="#" class="over-layer"><i class="icofont-play-alt-2"></i></a>
                                    <span class="video-item-content">Samrat Prithviraj</span>
                                </div>
                            </div>

                            <div class="post-slide">
                                <div class="post-img">
                                    <div class="watchlist-item-button">
                                        <a href="#" title="Remove">
                                            <i class="fa fa-times"></i>Remove
                                        </a>
                                    </div>
                                    <img src="{{ URL::asset('public/frontend/img/video-2.jpg')}}" alt="Video Image">
                                    <a href="#" class="over-layer"><i class="icofont-play-alt-2"></i></a>
                                    <span class="video-item-content">Samrat Prithviraj</span>
                                </div>
                            </div>

                            <div class="post-slide">
                                <div class="post-img">
                                    <div class="watchlist-item-button">
                                        <a href="#" title="Remove">
                                            <i class="fa fa-times"></i>Remove
                                        </a>
                                    </div>
                                    <img src="{{ URL::asset('public/frontend/img/video-3.jpg')}}" alt="Video Image">
                                    <a href="#" class="over-layer"><i class="icofont-play-alt-2"></i></a>
                                    <span class="video-item-content">Samrat Prithviraj</span>
                                </div>
                            </div>

                            <div class="post-slide">
                                <div class="post-img">
                                    <div class="watchlist-item-button">
                                        <a href="#" title="Remove">
                                            <i class="fa fa-times"></i>Remove
                                        </a>
                                    </div>
                                    <img src="{{ URL::asset('public/frontend/img/video-4.jpg')}}" alt="Video Image">
                                    <a href="#" class="over-layer"><i class="icofont-play-alt-2"></i></a>
                                    <span class="video-item-content">Samrat Prithviraj</span>
                                </div>
                            </div>

                            <div class="post-slide">
                                <div class="post-img">
                                    <div class="watchlist-item-button">
                                        <a href="#" title="Remove">
                                            <i class="fa fa-times"></i>Remove
                                        </a>
                                    </div>
                                    <img src="{{ URL::asset('public/frontend/img/video-5.jpg')}}" alt="Video Image">
                                    <a href="#" class="over-layer"><i class="icofont-play-alt-2"></i></a>
                                    <span class="video-item-content">Samrat Prithviraj</span>
                                </div>
                            </div>

                            <div class="post-slide">
                                <div class="post-img">
                                    <div class="watchlist-item-button">
                                        <a href="#" title="Remove">
                                            <i class="fa fa-times"></i>Remove
                                        </a>
                                    </div>
                                    <img src="{{ URL::asset('public/frontend/img/video-6.jpg')}}" alt="Video Image">
                                    <a href="#" class="over-layer"><i class="icofont-play-alt-2"></i></a>
                                    <span class="video-item-content">Samrat Prithviraj</span>
                                </div>
                            </div>

                            <div class="post-slide">
                                <div class="post-img">
                                    <div class="watchlist-item-button">
                                        <a href="#" title="Remove">
                                            <i class="fa fa-times"></i>Remove
                                        </a>
                                    </div>
                                    <img src="{{ URL::asset('public/frontend/img/video-3.jpg')}}" alt="Video Image">
                                    <a href="#" class="over-layer"><i class="icofont-play-alt-2"></i></a>
                                    <span class="video-item-content">Samrat Prithviraj</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!---// movie carousel ---->

        <!---------- footer -------->
        <!---- border div ---->
        <div class="custom-border"></div>
        <!---// border div --->
        
@stop

@section('page_js')


@endsection
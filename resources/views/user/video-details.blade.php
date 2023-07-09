@extends('layouts.main')

@section('content')

        <!-- video details area ---->
        <section class="page-content-area pt-3 pb-3">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-12 col-sm-12 col-lg-7 col-xl-7 mb-4">
                        <div class="detail-poster-area">
                            <div class="box-images mt-2" id="watch-embeded-video" >
                                
                                    @csrf
                                    <a data-fancybox="" href="javascript:;" onclick="watchVideo(this)" data-id="{{base64_encode($unique_video->id)}}" />
                                    

                                    <div class="box-video relative">
                                        <img src="{{ !empty($unique_video->video_image) ? URL::asset('public/uploads/video/'.$unique_video->video_image) : '' }}" class="img-fluid w-100" alt="Image">
                                        <span class="absolute play-buttons-icon">
                                            <i class="fa fa-play icon-play"></i>
                                        </span>
                                    </div>
                                    </a>
                                


                            </div>
                            
                        </div>
                        
                    </div>
                    
                    <div class="col-md-12 col-sm-12 col-lg-5 col-xl-5 mb-4">
                        <div class="poster-dtl-item">
                           <h2><a href="#">{{$unique_video->video_name}}</a></h2>
                           <ul class="list-unstyled">
                            <li class="list-inline-item">{{!empty($unique_video->features) ? $unique_video->features : 'NA'}}</li>
                           </ul>
                           <p class="des-bold-text"><strong>Actors:</strong>&nbsp;
                                <a title="actors">{{!empty($unique_video->actors) ? $unique_video->actors : 'NA'}}</a>
                                
                           </p>
                           <p class="des-bold-text"><strong>Directors:</strong>&nbsp;
                                <a title="directors">{{!empty($unique_video->directors) ? $unique_video->directors : 'NA'}}</a>
                           </p>
                           <div class="movie-details-para">
                            <p>{!! !empty($unique_video->description) ? $unique_video->description : '' !!}</p>
                           </div>  

                                <!-- <span class="video-posts-author"><i class="fa fa-eye"></i>51 Views</span> -->
                                <!-- <span class="video-posts-author"><i class="fa fa-calendar"></i>Jan 02 20223</span> -->

                                @if($unique_video->prime == '0')
                                <div class="">
                                    <span class="btn-watchlist">
                                        @csrf
                                        <a href="javascript:;" onclick="addWatchList(this)" data-id="{{base64_encode($unique_video->id)}}" class="btn" title="watchlist">
                                        <i class="fa fa-plus"></i>Add to Watchlist
                                        </a>
                                    </span>
                                </div>
                                @endif


                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!--// video details area -->

        <!----- video carousel ---->
        <section class="video-area section-top-gap section-bottom-gap">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="video-area-title">
                            <h3>You May Also Like</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="owl-carousel video-slider">

                            @forelse($video_carousel as $carousel)
                                <div class="post-slide">
                                    <div class="post-img">
                                        <img src="{{ !empty($carousel->image) ? URL::asset('public/uploads/video/'.$carousel->image) : '' }}" alt="Video Image">
                                        <a href="{{route('video-details',['id'=>base64_encode($carousel->id)] )}}" class="over-layer"><i class="icofont-play-alt-2"></i></a>
                                        <span class="video-item-content">Samrat Prithviraj</span>
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


        <!-- Modal -->
        <div class="modal fade" id="adModal" tabindex="-1" role="dialog" aria-labelledby="adModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content custom-modal-body">
                <div class="modal-header modal-custom-header">
                <h5 class="modal-title modal-custom-title" id="forgotModalBtnLabel">video ad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="cross">
                        <i class="icofont-close-circled"></i>
                    </span>
                </button>
                </div>
                <div class="modal-body">

                
                    <video width="100%" height="240" autoplay>
                        <source src="{{URL::asset('public/uploads/ad/'.$video_ad->value)}}" type="video/mp4">
                    </video>

                </div>
            </div>
            </div>
        </div>
        
@stop

@section('page_js')

<script>
    function watchVideo(obj) {
    
        var id = $(obj).data('id');
        console.log(id);
        var csrf_token = $('input[name=_token]').val();
        currentRequest = $.ajax({
            type: 'POST',
            headers: {'X-CSRF-TOKEN': csrf_token},
            url: "{{route('watch-video')}}",
            dataType: 'json',
            data: {video_id: id},
            beforeSend: function () {
                if (currentRequest !== null) {
                    currentRequest.abort();
                }
            },
            success: function (resp) {
                if (resp.status == 'success') {
                    // success_msg(resp.msg);
                    var video = resp.content;
                    // console.log(video);

                    $('#watch-embeded-video').html(video);
                    $('#adModal').modal({backdrop: 'static', keyboard: false},'show');
                    $('.close').hide();
                    setTimeout(() => {

                        $('.close').show();

                        setTimeout(() => {
                            $('#adModal').modal('hide');
                        },2000);
                        
                    }, 13000);
                    
                }
                if (resp.status == 'error') {
                    error_msg(resp.msg);
                }
                
            }
        });
    }
</script>

@endsection
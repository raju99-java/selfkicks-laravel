@extends('layouts.main')

@section('content')

        <!---------bradecrumbs ---->
        <div class="custombreadcrumbs">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-12 col-lg-6">
                        <div class="bread-content">
                            <h1>Thank You</h1>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="bread-content-menu">
                            <ul class="list-unstyled">
                                <li class="list-inline-item"><a href="{{route('/')}}">Home</a></li>
                                <li class="list-inline-item"><i class="fa fa-caret-right" aria-hidden="true"></i></li>
                                <li class="list-inline-item">Thank You</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--------//bradecrumbs ---->
        
        <!------ user dashboard ---->
        <section class="dashboard-bg-area my-5 mx-xl-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 offset-lg-2 offset-md-0">
                        <div class="others-page-bg">
                            <div class="banner-below-div-content-area text-center">
                                <h3>Thank You!</h3>
                                <p class="small-p">Thanks for share your query with Us. We will get back to You soon...</p>
                            </div>
                            

                                <div class="row align-items-center justify-content-center m-top10">
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-3 mt-lg-6">
                                        <div class="form-group user-btn">
                                            
                                            <a href="{{route('/')}}" class="btn submit-button">Back To Home</a>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>    
                </div>    
            </div>                
        </section>
        <!------// user dashboard -->

        
        <!---- border div ---->
        <div class="custom-border"></div>
        <!---// border div --->
        
@stop

@section('page_js')


@endsection
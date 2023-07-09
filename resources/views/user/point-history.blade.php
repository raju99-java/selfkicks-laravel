@extends('layouts.main')

@section('content')


        <!---------bradecrumbs ---->
        <div class="custombreadcrumbs">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-12 col-lg-6">
                        <div class="bread-content">
                            <h1>Point History</h1>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="bread-content-menu">
                            <ul class="list-unstyled">
                                <li class="list-inline-item"><a href="{{route('/')}}">Home</a></li>
                                <li class="list-inline-item"><i class="fa fa-caret-right" aria-hidden="true"></i></li>
                                <li class="list-inline-item">Point History</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--------//bradecrumbs ---->
        
        <!------ user dashboard ---->
        <section class="table-div m-top20 m-bottom20">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-xl-12 col-lg-12">
                        <div class="table-wrapper">
                            <div class="table-title-section">
                                <h3>Point History</h3>           
                            </div>
                            <div style="overflow: auto;">
                                <table class="table table-striped table-dark table-hover table-bordered my-table mt-3 mb-5">
                                    <thead class="custom-head">
                                      <tr>
                                        <th scope="col">Plan</th>
                                        <th scope="col">Points</th>
                                        <th scope="col">Prime Video</th>
                                        <th scope="col">Total Earning</th>
                                        <th scope="col">Date</th>
                                      </tr>
                                    </thead>
                                    <tbody>

                                        @forelse($point_history as $point)
                                            <tr>
                                                <th scope="row"><span class="current-plan-item">{{$point->subscription->name}}</span></th>
                                                <td>{{$point->points}}</td>
                                                <td>{{$point->video->video_name}}</td>
                                                <td>{{$point->user->total_points}}</td>
                                                <td><span class="expires-plan-item">{{date('jS F, Y h:i A', strtotime($point->date))}}</span></td>
                                            </tr>
                                        @empty
                                                <tr>
                                                    <td colspan="5">
                                                        <p style="text-align:center;"><span class="current-plan-item">No Data Found!</span></p>
                                                    </td>
                                                    
                                                </tr>
                                        @endforelse
                                      
                                    </tbody>
                                  </table>
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
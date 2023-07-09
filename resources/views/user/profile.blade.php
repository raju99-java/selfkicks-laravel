@extends('layouts.main')

@section('content')

    <!------ inner body ------>
        
        <!---------bradecrumbs ---->
        <div class="custombreadcrumbs">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-12 col-lg-6">
                        <div class="bread-content">
                            <h1>Manage Profile</h1>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="bread-content-menu">
                            <ul class="list-unstyled">
                                <li class="list-inline-item"><a href="{{route('/')}}">Home</a></li>
                                <li class="list-inline-item"><i class="fa fa-caret-right" aria-hidden="true"></i></li>
                                <li class="list-inline-item">Manage Profile</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--------//bradecrumbs ---->
        
        <!------ user dashboard ---->
        <section class="dashboard-bg-area mt-5 mb-5">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 offset-lg-2 offset-md-0">
                        <div class="edit-profile-form dashboard-bg">
                            <form id="update-profile-form" class="custom-form" action="{{route('my-profile')}}" method="post">
                                @csrf
                                <div class="row">

                                    <input type="hidden" name="id"  value="{{$user->id}}" >
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <div class="formRow">
                                            <div class="formRow--item">
                                                <p class="form-label">Name</p>
                                                <label for="username" class="formRow--input-wrapper js-inputWrapper">
                                                    <input type="text" name="full_name" class="formRow--input js-input form-control black-input-box" id="username" placeholder="" value="{{ (old('full_name')!="") ? old('full_name') : $user->full_name}}" ><span class="placeholder">Name</span>
                                                </label>
                                                <span class="help-block" id="error-full_name"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <div class="formRow">
                                            <div class="formRow--item">
                                                <p class="form-label">Email</p>
                                                <label for="emailid" class="formRow--input-wrapper js-inputWrapper">
                                                    <input type="email" name="email" class="formRow--input js-input form-control black-input-box" id="emailid" placeholder="" value="{{ (old('email')!="") ? old('email') : $user->email}}" ><span class="placeholder">Email ID</span>
                                                </label>
                                                <span class="help-block" id="error-email"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <div class="formRow">
                                            <div class="formRow--item">
                                                <p class="form-label">New Password</p>
                                                <label for="password" class="formRow--input-wrapper js-inputWrapper">
                                                    <input type="password" name="password" class="formRow--input js-input form-control black-input-box" id="password" placeholder="" value="{{ (old('password')!="") ? old('password') : $user->password }}" ><span class="placeholder">Password</span>
                                                </label>
                                                <span class="help-block" id="error-password"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <div class="formRow">
                                            <div class="formRow--item">
                                                <p class="form-label">Phone Number</p>
                                                <label for="phoneno"  class="formRow--input-wrapper js-inputWrapper">
                                                    <input type="tel" name="phone" class="formRow--input js-input form-control black-input-box" id="phoneno" placeholder="" value="{{ (old('phone')!="") ? old('phone') : $user->phone}}" ><span class="placeholder">Phone Number</span>
                                                </label>
                                                <span class="help-block" id="error-phone"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="formRow">
                                            <div class="formRow--item">
                                                <p class="form-label">Full Address</p>
                                                <label for="user_address"  class="formRow--input-wrapper js-inputWrapper">
                                                    <input type="text" name="address" class="formRow--input js-input form-control black-input-box" id="user_address" placeholder="" value="{{ (old('address')!="") ? old('address') : $user->address}}" >
                                                    <span class="placeholder">Address</span>
                                                </label>
                                                <span class="help-block" id="error-address"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row align-items-center">
                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <div class="formRow">
                                            <div class="formRow--item">
                                                <p class="form-label">Profile Image</p>
                                                <label for="profile-img" class="formRow--input-wrapper js-inputWrapper">
                                                    <input type="file" name="image" class="formRow--input js-input form-control black-input-box" id="profile-img" placeholder="">
                                                <span class="help-block" id="error-image"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 mt-lg-4">
                                        <div class="user_pic_view">          
                                            <div class="fileupload_img">
                                              <img class="fileupload_img" src="{{ ($user->image != '')? URL::asset('public/uploads/user').'/'.$user->image : URL::asset('public/frontend/img/user-avatar.png')}}" alt="profile pic" title="profile pic">
                                            </div>           
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 mt-lg-4">
                                        <div class="form-group user-btn">
                                            <input type="submit" value="SUBMIT" class="btn submit-button">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>   
                </div>    
            </div>                
        </section>
        <!------// user dashboard -->

        
        <!---- border div ---->
        <div class="custom-border"></div>
        <!---// border div --->
    <!------ inner body ------>
    
@stop

@section('page_js')


@endsection

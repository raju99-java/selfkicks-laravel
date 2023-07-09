@extends('admin::layouts.main')
@section('page_css')
<style>
   .form-control {
    text-transform: uppercase;
} 


</style>
@stop
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('user')}}">Kyc Request</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Update</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Update KYC of {{$user->full_name}}</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('kyc-request',['id'=>$id])}}" class="form-horizontal" enctype="multipart/form-data">
                    @method('PUT')
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="form-body">


                        <div class="form-group {{ $errors->has('full_name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Name" name="full_name" value="{{ (old('full_name')!="") ? old('full_name') : $user->full_name}}"/>
                                @if ($errors->has('full_name'))
                                <span class="help-block"> {{ $errors->first('full_name') }} </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Email</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Email" name="email" value="{{ (old('email')!="") ? old('email') : $user->email }}"/>
                                    @if ($errors->has('email'))
                                       <span class="help-block"> {{ $errors->first('email') }} </span>
                                    @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Phone</label>
                            <div class="col-md-10">
                                <input type="tel" class="form-control" placeholder="phone" name="phone" value="{{ (old('phone')!="") ? old('phone') : $user->phone }}"/>
                                    @if ($errors->has('phone'))
                                       <span class="help-block"> {{ $errors->first('phone') }} </span>
                                    @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Address</label>
                            <div class="col-md-10">
                                <input type="tel" class="form-control" placeholder="Address" name="address" value="{{ (old('address')!="") ? old('address') : $user->address }}"/>
                                    @if ($errors->has('address'))
                                       <span class="help-block"> {{ $errors->first('address') }} </span>
                                    @endif
                            </div>
                        </div>


                        <div class="form-group {{ $errors->has('id_proof') ? ' has-error' : '' }}">
                            <label class="control-label col-md-10">Upload Govt. Id Proof (Exam: Aadhar Card/Voter Card/Pan Card/Driving License)</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control"  name="id_proof" >
                                @if ($errors->has('id_proof'))
                                <span class="help-block"> {{ $errors->first('id_proof') }} </span>
                                @endif
                            </div>
                        </div>
                        @if(isset($user->id_proof))
                        <div class="form-group">
                            <div class="col-md-10">
                                <a href="{{isset($user->id_proof)?URL::asset('public/uploads/id_proof/'.$user->id_proof):''}}" class="btn btn-xs btn-primary pull-left" target="_blank"><i class="fa fa-eye"></i>View ID Proof</a><br/>
                            </div>
                        </div>
                        <br>
                        @endif

                        

                        <div class="form-group {{ $errors->has('kyc_verified') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">KYC Verification Status <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="kyc_verified" value="2" {{ ($user->kyc_verified == '2') ? 'checked' : '' }}> Done
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="kyc_verified" value="1" {{ ($user->kyc_verified == '1') ? 'checked' : '' }}> Processing
                                    </label>
                                    @if ($errors->has('kyc_verified'))
                                    <div class="help-block">{{ $errors->first('kyc_verified') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <a href="{{Route('kyc-request-list')}}" class="btn btn-primary">Cancel</a>
                                <button type="submit" class="btn green"> Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection


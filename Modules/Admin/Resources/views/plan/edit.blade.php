@extends('admin::layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
     <li>
        <a href="{{Route('subscription')}}">Subscription Management</a>
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
                    <span class="caption-subject font-red-sunglo bold uppercase">Update Subscription of {{$data->name}}</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('subscription-edit',$data->id)}}" class="form-horizontal" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="form-body">
                        
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Name<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Name" name="name" value="{{ (old('name')!="") ? old('name') : $data->name}}"/>
                                @if ($errors->has('name'))
                                <span class="help-block"> {{ $errors->first('name') }} </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Price<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Price" name="price" value="{{ (old('price')!="") ? old('price') : $data->price}}"/>
                                @if ($errors->has('price'))
                                <span class="help-block"> {{ $errors->first('price') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('validity') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Validity (Days)<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="Validity" name="validity" value="{{ (old('validity')!="") ? old('validity') : $data->validity}}"/>
                                @if ($errors->has('validity'))
                                <span class="help-block"> {{ $errors->first('validity') }} </span>
                                @endif
                            </div>
                        </div>
                        
                        
                        
                        <div class="form-group {{ $errors->has('details') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Details about Plan<span class="required">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control ckeditor" placeholder="Details about Plan" name="details"  id="body">{!! (old('details')!="") ? old('details') : $data->details !!}</textarea>
                                @if ($errors->has('details'))
                                <span class="help-block"> {{ $errors->first('details') }} </span>
                                @endif
                            </div>
                        </div>
                        
                        

                        <div class="form-group {{ $errors->has('referral_status') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Referred Others <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="referral_status" value="1" {{ ($data->referral_status == '1') ? 'checked' : '' }}> Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="referral_status" value="0" {{ ($data->referral_status == '0') ? 'checked' : '' }}> No
                                    </label>
                                    @if ($errors->has('referral_status'))
                                    <div class="help-block">{{ $errors->first('referral_status') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('earning_point') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Earning Point to watch Videos <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="earning_point" value="1" {{ ($data->earning_point == '1') ? 'checked' : '' }}> Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="earning_point" value="0" {{ ($data->earning_point == '0') ? 'checked' : '' }}> No
                                    </label>
                                    @if ($errors->has('earning_point'))
                                    <div class="help-block">{{ $errors->first('earning_point') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('premium_plan') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Premium Plan <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="premium_plan" value="1" {{ ($data->premium_plan == '1') ? 'checked' : '' }}> Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="premium_plan" value="0" {{ ($data->premium_plan == '0') ? 'checked' : '' }}> No
                                    </label>
                                    @if ($errors->has('premium_plan'))
                                    <div class="help-block">{{ $errors->first('premium_plan') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Status <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1" {{ ($data->status == '1') ? 'checked' : '' }}> Active
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="0" {{ ($data->status == '0') ? 'checked' : '' }}> Inactive
                                    </label>
                                    @if ($errors->has('status'))
                                    <div class="help-block">{{ $errors->first('status') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <a href="{{Route('subscription')}}" class="btn btn-primary">Cancel</a>
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
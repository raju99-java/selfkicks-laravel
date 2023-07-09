@extends('admin::layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
     <li>
        <a href="{{Route('video')}}">Video Management</a>
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
                    <span class="caption-subject font-red-sunglo bold uppercase">Update Video of {{$data->video_name}}</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('video-edit',$data->id)}}" class="form-horizontal" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="form-body">
                        
                        <div class="form-group {{ $errors->has('video_name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Video Name<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Video Name" name="video_name" value="{{ (old('video_name')!="") ? old('video_name') : $data->video_name }}"/>
                                @if ($errors->has('video_name'))
                                <span class="help-block"> {{ $errors->first('video_name') }} </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">{{ __('Featured Image (270x390 px)') }}</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control"  name="image" onchange="readURL(this);">
                                @if ($errors->has('image'))
                                <span class="help-block"> {{ $errors->first('image') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <img id="blah" src="{{isset($data->image)?URL::asset('public/uploads/video/'.$data->image):''}}" style="max-width: 400;max-height: 200px">
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('embeded_video') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Embeded Video<span class="required">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control ckeditor" placeholder="Embeded Video" name="embeded_video"  id="body">{{ (old('embeded_video')!="") ? old('embeded_video') : $data->embeded_video }}</textarea>
                                @if ($errors->has('embeded_video'))
                                <span class="help-block"> {{ $errors->first('embeded_video') }} </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('video_image') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">{{ __('Video Image (800x450 px)') }}</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control"  name="video_image" >
                                @if ($errors->has('video_image'))
                                <span class="help-block"> {{ $errors->first('video_image') }} </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('features') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Features </label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Features" name="features" value="{{ (old('features')!="") ? old('features') : $data->features }}"/>
                                @if ($errors->has('features'))
                                <span class="help-block"> {{ $errors->first('features') }} </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('actors') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Actors </label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Actors" name="actors" value="{{ (old('actors')!="") ? old('actors') : $data->actors }}"/>
                                @if ($errors->has('actors'))
                                <span class="help-block"> {{ $errors->first('actors') }} </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('directors') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Directors </label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Directors" name="directors" value="{{ (old('directors')!="") ? old('directors') : $data->directors}}"/>
                                @if ($errors->has('directors'))
                                <span class="help-block"> {{ $errors->first('directors') }} </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Description</label>
                            <div class="col-md-10">
                                <textarea class="form-control ckeditor" placeholder="Description" name="description"  id="body">{{ (old('description')!="") ? old('description') : $data->description }}</textarea>
                                @if ($errors->has('description'))
                                <span class="help-block"> {{ $errors->first('description') }} </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('latest') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Latest Video <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="latest" value="1" {{ ($data->latest == '1') ? 'checked' : '' }}> Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="latest" value="0" {{ ($data->latest == '0') ? 'checked' : '' }}> No
                                    </label>
                                    @if ($errors->has('latest'))
                                    <div class="help-block">{{ $errors->first('latest') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('trending') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Trending Video <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="trending" value="1" {{ ($data->trending == '1') ? 'checked' : '' }}> Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="trending" value="0" {{ ($data->trending == '0') ? 'checked' : '' }}> No
                                    </label>
                                    @if ($errors->has('trending'))
                                    <div class="help-block">{{ $errors->first('trending') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('popular') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Popular Video <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="popular" value="1" {{ ($data->popular == '1') ? 'checked' : '' }}> Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="popular" value="0" {{ ($data->popular == '0') ? 'checked' : '' }}> No
                                    </label>
                                    @if ($errors->has('popular'))
                                    <div class="help-block">{{ $errors->first('popular') }}</div>
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
                                <a href="{{Route('video')}}" class="btn btn-primary">Cancel</a>
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
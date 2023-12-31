@extends('admin::layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('admin-slider-index')}}">Slider</a>
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
                    <span class="caption-subject font-red-sunglo bold uppercase">Update Slider of {{$data->title_text}}</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('admin-slider-update',$data->id)}}" class="form-horizontal" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="form-body">
                        

                        <div class="form-group {{ $errors->has('video_id') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Select Video <span class="required">*</span></label>
                            <div class="col-md-10">
                                <select name="video_id" class="form-control">
                                    <option class="option selected focus" selected disabled>Select</option>

                                    @forelse($videos as $video)
                                        <option value="{{ $video->id }}" class="option" {{ ($video->id == $data->video_id) ?'selected':'' }}>{{ $video->video_name }}</option>
                                        @empty
                                    @endforelse
                                    
                                </select>
                                @if ($errors->has('video_id'))
                                <span class="help-block"> {{ $errors->first('video_id') }} </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group {{ $errors->has('title_text') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Title<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Title" name="title_text" value="{{ (old('title_text')!="") ? old('title_text') : $data->title_text}}"/>
                                @if ($errors->has('title_text'))
                                <span class="help-block"> {{ $errors->first('title_text') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('details_text') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Description<span class="required">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control ckeditor" placeholder="Description" name="details_text"  id="body">{{ (old('details_text')!="") ? old('details_text') : $data->details_text }}</textarea>
                                @if ($errors->has('details_text'))
                                <span class="help-block"> {{ $errors->first('details_text') }} </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('photo') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Current Featured Image</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control"  name="photo" onchange="readURL(this);">
                                @if ($errors->has('photo'))
                                <span class="help-block"> {{ $errors->first('photo') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <img id="blah" src="{{isset($data->photo)?URL::asset('public/uploads/slider/'.$data->photo):''}}" style="max-width: 400;max-height: 200px">
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
                                <a href="{{Route('admin-slider-index')}}" class="btn btn-primary">Cancel</a>
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
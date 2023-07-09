@extends('admin::layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('prime-video')}}">Prime Video Management</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Add </span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-plus font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Add Prime Video</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('prime-video-add')}}" class="form-horizontal" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-body">
                        
                        <div class="form-group {{ $errors->has('video_id') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Select Video <span class="required">*</span></label>
                            <div class="col-md-10">
                                <select name="video_id" class="form-control">
                                    <option class="option selected focus" selected disabled>Select</option>

                                    @forelse($videos as $video)
                                        <option value="{{ $video->id }}" class="option" {{ (old('video_id')!="") ? ($video->id==old('video_id'))?'selected':'' : ''}}>{{ $video->video_name }}</option>
                                        @empty
                                    @endforelse
                                    
                                </select>
                                @if ($errors->has('video_id'))
                                <span class="help-block"> {{ $errors->first('video_id') }} </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('shows') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Select Show <span class="required">*</span></label>
                            <div class="col-md-10">
                                <select name="shows" class="form-control">
                                    <option class="option selected focus" selected disabled>Select</option>
                                    <option value="1" class="option" {{ (old('shows')!="") ? ('1'==old('shows'))?'selected':'' : ''}}>Morning</option>
                                    <option value="2" class="option" {{ (old('shows')!="") ? ('2'==old('shows'))?'selected':'' : ''}}>Evening</option>
                                </select>
                                @if ($errors->has('shows'))
                                <span class="help-block"> {{ $errors->first('shows') }} </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('start') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Start<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" id="start" class="form-control" placeholder="Start" name="start" value="{{ (old('start')!="") ? old('start') : ''}}"/>
                                @if ($errors->has('start'))
                                <span class="help-block"> {{ $errors->first('start') }} </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('expiry') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Expiry<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" id="expiry" class="form-control" placeholder="Expiry" name="expiry" value="{{ (old('expiry')!="") ? old('expiry') : ''}}"/>
                                @if ($errors->has('expiry'))
                                <span class="help-block"> {{ $errors->first('expiry') }} </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Status <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1"> Active
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="0"> Inactive
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
                            <div class="offset-md-3 col-md-9">
                                <a href="{{Route('prime-video')}}" class="btn btn-primary">Cancel</a>
                                <button type="submit" class="btn green">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('page_js')

<script>

    
    jQuery('#start').Zebra_DatePicker({
     
         format: 'd-m-Y H:i',
         readonly_element: true,

         direction: true,
         pair: $('#expiry')
         
    });

    jQuery('#expiry').Zebra_DatePicker({
        
        format: 'd-m-Y H:i',
        readonly_element: true,

        
        direction: [true, 0],
        
    });
    
    
</script>

@endsection
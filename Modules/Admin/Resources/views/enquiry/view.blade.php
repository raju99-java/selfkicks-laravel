@extends('admin::layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{Route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('enquiry')}}">Enquiry</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">View</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">View Enquiry</span>
                </div>
            </div>
            <div class="portlet-body form form-horizontal">
                <div class="form-body">

                    <div class="form-group">
                        <label class="control-label col-md-12">Subject: {{($model->subject) ? $model->subject : 'NA'}}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">
                                
                            </p>
                        </div>
                    </div>

                                        
                    <div class="form-group">
                        <label class="control-label col-md-12">Name: {{($model->name) ? strtoupper($model->name) : 'NA'}}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">
                                
                            </p>
                        </div>
                    </div>
                    
                    
                    
                    <div class="form-group">
                        <label class="control-label col-md-12">Email: {{($model->email) ? strtoupper($model->email) : 'NA'}}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">
                                
                            </p>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-12">Phone: {{($model->phone) ? $model->phone : 'NA'}}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">
                                
                            </p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-12">Message: {{($model->message) ? $model->message : 'NA'}}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">
                                
                            </p>
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label class="control-label col-md-12">Date: {{($model->created_at) ? date('jS M Y, g:i A', strtotime($model->created_at)) : 'NA' }} </label>
                        <div class="col-md-10">
                            <p class="form-control-static">
                                
                            </p>
                        </div>
                    </div>

                    

                    

                   

                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-9">
                            <a href="{{Route('enquiry')}}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
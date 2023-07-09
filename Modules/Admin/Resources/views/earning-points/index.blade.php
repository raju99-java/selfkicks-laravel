@extends('admin::layouts.main')
@section('page_css')
<link href="{{ URL::asset('public/backend/css/jquery-confirm.css') }}" rel="stylesheet" type="text/css" />
<style>
    .jconfirm-content {
        overflow: hidden !important;
    }
</style>
@stop
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{Route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Earning Points List</span>
    </li>
</ul>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">Earning Points List</span>
        </div>
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-responsive">
            <table class="ui celled table" cellspacing="0" width="100%" id="earning-manager">
                <thead>
                    <tr>
                        <th> Name </th>
                        <th> Email </th>
                        <th> Prime Video </th>
                        <th> Earning Points </th>
                        <th> Total Earning </th>
                        <th> Date </th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
                </div>
        </div>
    </div>
</div>
@endsection
@section('page_js')
<script src="{{ URL::asset('public/backend/js/jquery-confirm.js') }}" type="text/javascript"></script>
<script>
    $(function () {
        $('#earning-manager').DataTable({
//            processing: true,
            serverSide: true,
            ajax: '{!! route("earning-points-list-datatable") !!}',
            columns: [
                {data: 'full_name', name: 'full_name'},
                {data: 'email', name: 'email'},
                {data: 'video_name', name: 'video_name'},
                {data: 'points', name: 'points'},
                {data: 'total_points', name: 'total_points'},
                {data: 'date', name: 'date'}
                
            ],
//            drawCallback: function () {
//                $('[data-toggle=confirmation]').confirmation({
//                    rootSelector: '[data-toggle=confirmation]',
//                    container: 'body'
//                });
//            }
        });
    });
</script>
@endsection
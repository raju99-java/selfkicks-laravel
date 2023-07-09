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
        <span class="active">Subscription History</span>
    </li>
</ul>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">Subscription History</span>
        </div>
        
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-responsive">
                <table class="ui celled table" cellspacing="0" width="100%" id="plan-hist-management">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Subscription Type</th>
                            <th>Payment ID</th>
                            <th>Amount</th>
                            <th>Payment Status</th>
                            <th>Date & Time</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page_js')
<script src="{{ URL::asset('public/backend/js/jquery-confirm.js') }}" type="text/javascript"></script>
<script>

//    $(docuemnt).ready(function () {
//
//    });
    $(function () {
        $('#plan-hist-management').DataTable({
            serverSide: true,
            responsive: true,
            ajax: '{{ route("plan-history-datatable") }}',
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'user_id', name: 'user_id', orderable: false, searchable: false},
                {data: 'plan_id', name: 'plan_id', orderable: false, searchable: false},
                {data: 'txnid', name: 'txnid'},
                {data: 'amount', name: 'amount'},                
                {data: 'payment_status', searchable: false, orderable: false},
                {data: 'created_at', searchable: false, orderable: false}
            ]
        });
    });
</script>
@endsection
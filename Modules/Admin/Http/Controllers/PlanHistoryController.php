<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Yajra\Datatables\Datatables;
use Validator;
use URL;
use PDF;
/* * ************Models************* */
use App\Model\SubscriptionHistory;

class PlanHistoryController extends AdminController {

    protected $appid, $secret;

    public function get_history_list() {


        return view('admin::plan-history.list');
    }

    public function get_history_datatable() {

        $hist_list = SubscriptionHistory::orderBy('id','desc')->get();

        return Datatables::of($hist_list)
                        ->addIndexColumn()
                        
                        ->editColumn('user_id', function ($model) {
                            return $model->user->full_name;
                        })

                        ->editColumn('plan_id', function ($model) {
                            return $model->subscription->name;
                        })
                                               
                        
                        ->editColumn('amount', function ($model) {
                            $amount = '₹ '.$model->amount.'.00';
                            return $amount;
                        })


                        ->editColumn('payment_status', function ($model) {
                            if ($model->payment_status == '0') {
                                $status = '<span class="badge badge-danger"><i class="icofont-not-allowed"></i>Faild</span>';
                            }else if ($model->payment_status == '1') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Done</span>';
                            }
                            return $status;
                        })

                        ->editColumn('created_at', function ($model) {
                            return !empty($model->created_at) ? date('jS M Y, g:i A', strtotime($model->created_at)) : '';
                        })

                        
                        ->rawColumns(['user_id','plan_id','amount','payment_status','created_at'])
                        ->make(true);
    }

    

    
    

}

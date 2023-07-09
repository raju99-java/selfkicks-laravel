<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Redeem;
use App\Model\UserMaster;
use Yajra\Datatables\Datatables;

class RedeemController extends AdminController {

    public function get_redeem_list(Request $request) {
        return view('admin::redeem.index');
    }

    public function get_redeem_list_datatable() {
        $redeem = Redeem::orderBy('id', 'desc')->get();

        return Datatables::of($redeem)

            ->editColumn('full_name', function ($model) {
                $full_name = $model->user->full_name;
                return $full_name;
            })

            ->editColumn('email', function ($model) {
                $email = $model->user->email;
                return $email;
            })

            ->editColumn('total_points', function ($model) {
                $total_points = $model->user->total_points;
                return $total_points;
            })

            ->editColumn('status', function ($model) {
                if ($model->status == '0') {
                    $status = '<span class="badge badge-warning"><i class="icofont-spinner"></i>Processing</span>';
                } else if ($model->status == '1') {
                    $status = '<span class="badge badge-success"><i class="icofont-check"></i>Accepted</span>';
                }else if ($model->status == '2') {
                    $status = '<span class="badge badge-danger"><i class="icofont-not-allowed"></i>Rejected</span>';
                }
                return $status;
            })

            ->editColumn('created_at', function ($model) {
                return !empty($model->created_at) ? date('jS M Y, g:i A', strtotime($model->created_at)) : 'NA';
            })

            ->addColumn('action', function ($model) {

                if($model->status == '0'){
                    return  '<a href="javascript:;" onclick="rejectRedeem(this);" data-href="' . Route("redeem-reject", [$model->id]) . '" class="btn btn-xs btn-danger pull-left"><i class="icofont-not-allowed"></i> Reject</a>'.

                    '<a href="javascript:;" onclick="acceptRedeem(this);" data-href="' . Route("redeem-accept", [$model->id]) . '" class="btn btn-xs btn-success pull-left"><i class="icofont-check"></i> Accept</a>';

                }else if($model->status == '1' || $model->status == '2'){
                    return '<a href="javascript:;" onclick="deleteRedeem(this);" data-href="' . Route("redeem-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';

                }
                
            })
            ->rawColumns(['full_name','email','total_points','status','created_at','action'])
            ->make(true);
    }

    public function reject($id) {
        $data = [];
        $model = Redeem::findOrFail($id);
        
        $model->status = '2';
        $model->save();

        $email_setting = $this->get_email_data('reject_request', array('NAME' => $model->user->full_name));
        $email_data = [
            'to' => $model->user->email,
            'subject' => $email_setting['subject'],
            'template' => 'signup',
            'data' => ['message' => $email_setting['body']]
        ];
        $this->SendMail($email_data);

        //--- Redirect Section
        $data['status'] = 200;
        $data['msg'] = 'Rejected Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends
    }

    public function accept($id) {
        $data = [];
        $model = Redeem::findOrFail($id);
        
        $model->status = '1';
        $model->save();

        $user = UserMaster::findOrFail($model->user_id);
        $user->total_points = 0;
        $user->save();

        $email_setting = $this->get_email_data('accept_request', array('NAME' => $model->user->full_name));
        $email_data = [
            'to' => $model->user->email,
            'subject' => $email_setting['subject'],
            'template' => 'signup',
            'data' => ['message' => $email_setting['body']]
        ];
        $this->SendMail($email_data);

        //--- Redirect Section
        $data['status'] = 200;
        $data['msg'] = 'Accepted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends
    }
    
    public function delete($id) {
        $data = [];
        $model = Redeem::findOrFail($id);
        
        
        $model->delete();
        //--- Redirect Section
        $data['status'] = 200;
        $data['msg'] = 'Deleted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends
    }

}

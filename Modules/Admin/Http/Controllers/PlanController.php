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
/* * ************Models************* */
use App\Model\Subscriptions;


class PlanController extends AdminController {

    protected $appid, $secret;

    public function index() {


        return view('admin::plan.list');
    }

    public function datatables() {
        $plans = Subscriptions::where('id','<>','0')->orderBy('id','desc')->get();
        return Datatables::of($plans)
                        ->addIndexColumn()
                        
                        ->editColumn('price', function ($model) {
                            if($model->price != ''){
                                return $model->price;
                            }else{
                                return 'Free';
                            }
                            
                        })
                        
                        
                        ->editColumn('referral_status', function ($model) {
                            if ($model->referral_status == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i>Can not Referred</span>';
                            } else if ($model->referral_status == '1') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Referred</span>';
                            }
                            return $status;
                        })
                        
                        ->editColumn('status', function ($model) {
                            if ($model->status == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i>Inactive</span>';
                            } else if ($model->status == '1') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Active</span>';
                            }
                            return $status;
                        })
                        
                        ->editColumn('created_at', function ($model) {
                            return !empty($model->created_at) ? date('jS M Y, g:i A', strtotime($model->created_at)) : '';
                        })
                        ->addColumn('action', function ($model) {
                            return
                            '<a href="' . Route("subscription-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>';
                            // '<a href="javascript:;" onclick="deletePlan(this);" data-href="' . Route("subscription-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['price','referral_status','status', 'action'])
                        ->make(true);
    }
    
    
    public function get_add() {

        return view('admin::plan.add');
    } 
    
    
    public function post_add(Request $request) {

        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'price' => 'nullable|numeric',
                    'validity' => 'required|numeric',
                    'free_wallet' => 'nullable|numeric',
                    'joining_wallet' => 'nullable|numeric',
                    'details' => 'required',
                    'referral_status' => 'required',
                    'premium_plan' => 'required',
                    'status' => 'required',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });

        if ($validator->passes()) {
            $data = new Subscriptions();
            $input = $request->all();
            
            $data->fill($input)->save();

            return redirect()->route('subscription')->with('success_msg', 'New Subscription created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        
    }
    
    
    public function get_edit($id) {
        $data = Subscriptions::where('id',$id)->first();
        return view('admin::plan.edit',["data"=>$data]);
    }
    
    
    public function post_edit(Request $request, $id) {
         $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'price' => 'nullable|numeric',
                    'validity' => 'required|numeric',
                    'free_wallet' => 'nullable|numeric',
                    'joining_wallet' => 'nullable|numeric',
                    'details' => 'required',
                    'referral_status' => 'required',
                    'earning_point' => 'required',
                    'status' => 'required',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });
        
        if ($validator->passes()) {
            //--- Logic Section
            $data = Subscriptions::findOrFail($id);
            $input = $request->all();
            
            $data->update($input);
            
            return redirect()->route('subscription')->with('success_msg', 'Subscription updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        
    }
    
    
    public function delete($id) {
        $data = [];
        $model = Subscriptions::findOrFail($id);
        
        
        $model->delete();
        //--- Redirect Section
        $data['status'] = 200;
        $data['msg'] = 'Subscription Deleted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends
    }



}
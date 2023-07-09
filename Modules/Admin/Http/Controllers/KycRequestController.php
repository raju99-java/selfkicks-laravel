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
use App\Model\UserMaster;

class KycRequestController extends AdminController {

    protected $appid, $secret;

    public function get_kyc_equest_list() {


        return view('admin::kyc.list');
    }

    public function get_kyc_request_datatable() {

        $user_list = UserMaster::where('type_id','<>', '1')->where('kyc_verified', '<>','0')->where('status', '<>', '3')->orderBy('id','desc')->get();

        return Datatables::of($user_list)
                        ->addIndexColumn()
                        ->editColumn('image', function ($model) {
                            if (isset($model->image)) {
                                $path = URL::asset('public/uploads/user/' . $model->image);
                            } else {
                                $path = URL::asset('public/backend/no-image.png');
                            }
                            return '<img height="50" width="50" src="' . $path . '"/>';
                        })
                        ->editColumn('full_name', function ($model) {
                            return $model->full_name;
                        })

                        ->editColumn('subcription_id', function ($model) {
                            if ($model->subcription_id == '1') {
                                $type = 'Normal Subscriber';
                            } else if ($model->subcription_id == '2') {
                                $type = 'Premium Subscriber';
                            }else if ($model->subcription_id == '0') {
                                $type = 'User';
                            }
                            return $type;
                        })                        
                        
                        ->editColumn('email', function ($model) {
                            return $model->email;
                        })


                        ->editColumn('kyc_verified', function ($model) {
                            if ($model->kyc_verified == '1') {
                                $status = '<span class="badge badge-warning"><i class="fa fa-spinner"></i>Processing</span>';
                            }else if ($model->kyc_verified == '2') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Done</span>';
                            }
                            return $status;
                        })

                        ->addColumn('action', function ($model) {
                            return
                            '<a href="' . Route("kyc-request", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>';
                        })
                        ->rawColumns(['image','subcription_id','kyc_verified', 'action'])
                        ->make(true);
    }

    

    public function get_kyc_request($id) {
        $data['user'] = $user = UserMaster::where('id', '=', $id)->first();
        if (!$user) {
            return redirect()->route('kyc-request-list')->with('error_msg', 'Invalid Link!');
        }
        $data['id'] = $id;
        return view('admin::kyc.edit', $data);
    }

    public function post_kyc_request(Request $request, $id) {

        $input = [];
        $model = UserMaster::where('id', '=', $id)->first();

        
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10',
            'address' => 'required',
            'id_proof' => 'nullable|mimes:jpeg,jpg,png,pdf|max:10000',
            'kyc_verified' => 'required',
            
        ]);
        
        $validator->after(function ($validator) use ($request) {
            $checkUser = UserMaster::where('id', '<>', $request->input('id'))->where('email', $request->input('email'))->first();

            if (!empty($checkUser))
                $validator->errors()->add('email', 'Email already in use.');
            $checkUserPhone = UserMaster::where('id', '<>', $request->input('id'))->where('phone', $request->input('phone'))->count();
            if ($checkUserPhone > 0) {
                $validator->errors()->add('phone', 'Phone number already in use.');
            }
        });
        
        if ($validator->passes()) {

            $input = $request->all();
            
            if ($request->hasFile('id_proof')) {
                $sample_image = $request->file('id_proof');
                $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/id_proof');
                $sample_image->move($destinationPath, $imagename);
                $input['id_proof'] = $imagename;
            }
            
            $model->update($input);
            return redirect()->route('kyc-request-list')->with('success_msg', 'KYC request updated successfully.');
        } else {
            return redirect()->route('kyc-request-list')->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

    

    

}

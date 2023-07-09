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

class PremiumMemberController extends AdminController {

    protected $appid, $secret;

    public function get_user_list() {


        return view('admin::premium-member.list');
    }

    public function get_user_list_datatable() {
        $user_list = UserMaster::where('type_id','<>', '1')->where('subcription_id', '=', '2')->where('status', '<>', '3')->orderBy('id','desc')->get();
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


                        ->editColumn('created_at', function ($model) {
                            return !empty($model->created_at) ? date('jS M Y, g:i A', strtotime($model->created_at)) : '';
                        })

                        ->editColumn('subcription_status', function ($model) {
                            if ($model->subcription_status == '0') {
                                $subcription_status = '<span class="badge badge-warning"><i class="icofont-warning"></i>Pause</span>';
                            } else if ($model->subcription_status == '1') {
                                $subcription_status = '<span class="badge badge-success"><i class="icofont-check"></i>Resume</span>';
                            }
                            return $subcription_status;
                        })

                        ->editColumn('days_left', function ($model) {
                            return $model->days_left." Days Left";
                        })


                        ->editColumn('status', function ($model) {
                            if ($model->status == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i>Inactive</span>';
                            } else if ($model->status == '1') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Active</span>';
                            }else if ($model->status == '2') {
                                $status = '<span class="badge badge-danger"><i class="icofont-not-allowed"></i>Block</span>';
                            }
                            return $status;
                        })

                        ->addColumn('action', function ($model) {
                            return
                            '<a href="' . Route("premium-member-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                            '<a href="javascript:;" onclick="deletePremiumMember(this);" data-href="' . Route("premium-member-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['image','subcription_id','subcription_status','days_left','status','created_at', 'action'])
                        ->make(true);
    }

    

    public function get_edit_user($id) {
        $data['user'] = $user = UserMaster::where('id', '=', $id)->first();
        if (!$user) {
            return redirect()->route('user')->with('error_msg', 'Invalid Link!');
        }
        $data['id'] = $id;
        return view('admin::premium-member.edit', $data);
    }

    public function post_edit_user(Request $request, $id) {

        $input = [];
        $model = UserMaster::where('id', '=', $id)->first();

        
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10',
            'status' => 'required',
            
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
            
            // if($model->type_id == '3'){
            //     if ($request->hasFile('user_image')) {
            //         $sample_image = $request->file('user_image');
            //         $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
            //         $destinationPath = public_path('uploads/user');
            //         $sample_image->move($destinationPath, $imagename);
            //         $input['user_image'] = $imagename;
            //     }
            // }
            
            $model->update($input);
            return redirect()->route('premium-member')->with('success_msg', 'Premium updated successfully.');
        } else {
            return redirect()->route('premium-member')->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

    public function delete(Request $request, $id) {
        if ($request->ajax()) {
            $data = [];
            $model = UserMaster::findorFail($id);
            
            if (!empty($model)) {
                $model->status = '2';
                $model->updated_at = date('Y-m-d H:i:s');
                $model->save();
                $data['status'] = 200;
                $data['msg'] = 'Member deleted successfully.';
            } else {
                $data['msg'] = 'Sorry ! No User details found.';
            }
            return response()->json($data);
        }
    }

    

}

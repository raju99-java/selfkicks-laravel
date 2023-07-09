<?php

namespace Modules\Admin\Http\Controllers;

use Datatables;
use App\Model\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use URL;
class NotificationController extends AdminController {

    //*** JSON Request
    public function datatables() {
        $datas = Notification::orderBy('id', 'desc')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                        ->addIndexColumn()
                        ->editColumn('logo', function ($model) {
                            if (@getimagesize(URL::asset('public/uploads/notification/' . $model->logo)) == true) {
                                $path = URL::asset('public/uploads/notification/' . $model->logo);
                            } else {
                                $path = URL::asset('public/backend/no-image.png');
                            }
                            // $path = URL::asset('public/uploads/notification/' . $model->logo);
                            return '<img height="50" width="50" src="' . $path . '"/>';
                        })
                        ->editColumn('description', function($row) {
                            return (strlen($row->description) > 200) ? substr($row->description, 0, 200) . '...' : $row->description;
                        })
                        ->editColumn('status', function ($model) {
                            if ($model->status == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i>Inactive</span>';
                            } else if ($model->status == '1') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Active</span>';
                            } else if ($model->status == '3') {
                                $status = '<span class="badge badge-danger"><i class="icofont-close"></i>Delete</span>';
                            }
                            return $status;
                        })
                        ->addColumn('action', function ($model) {
                            return
                                    '<a href="' . Route("admin-notification-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                    '<a href="javascript:;" onclick="deleteNotification(this);" data-href="' . Route("admin-notification-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['logo','status','description', 'action'])
                        ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index() {
        return view('admin::notification.list');
    }

    //*** GET Request
    public function create() {
        return view('admin::notification.add');
    }

    //*** POST Request
    public function store(Request $request) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'description' => 'required',
                    'status' => 'required', 
                    'logo' => 'image|mimes:png,jpeg,jpg,JPEG,gif',
            ]
        );
        $validator->after(function($validator) use($request) {
            
        });

        if ($validator->passes()) {
            $data = new Notification();
            $input = $request->all();
            if ($request->hasFile('logo')) {
                $input['logo'] = $this->uploadimage($request);
            }
            
            $data->fill($input)->save();

            return redirect()->route('admin-notification-index')->with('success_msg', 'Notification created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

    //*** GET Request
    public function edit($id) {
        $data = Notification::findOrFail($id);
        return view('admin::Notification.edit', compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'description' => 'required',
                    'status' => 'required',
                    'logo' => 'image|mimes:png,jpeg,jpg,JPEG,gif',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });
        if ($validator->passes()) {
            //--- Logic Section
            $data = Notification::findOrFail($id);
            $input = $request->all();
            if ($request->hasFile('logo')) {
                $input['logo'] = $this->uploadimage($request);
            }

            $data->update($input);

            return redirect()->route('admin-notification-index')->with('success_msg', 'Notification updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        //--- Redirect Section Ends
    }

    //*** GET Request Status
    public function status($id1, $id2) {
        $data = Notification::findOrFail($id1);
        $data->status = $id2;
        $data->update();
    }

    //*** GET Request Delete
    public function destroy($id) {
        $data = [];
        $model = Notification::findOrFail($id);

        
        $model->delete();
        //--- Redirect Section
        $data['status'] = 200;
        $data['msg'] = 'Data Deleted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends
    }

    public function uploadimage($request) {
        $sample_image = $request->file('logo');
        $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
        $destinationPath = public_path('uploads/notification');
        $sample_image->move($destinationPath, $imagename);
        return $imagename;
    }

}

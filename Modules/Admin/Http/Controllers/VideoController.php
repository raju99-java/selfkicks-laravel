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
use App\Model\Video;


class VideoController extends AdminController {


    public function index() {


        return view('admin::video.list');
    }

    public function datatables() {
        $videos = Video::orderBy('id','desc')->get();

        return Datatables::of($videos)
                        ->addIndexColumn()
                        
                        ->editColumn('image', function ($model) {
                            if (isset($model->image)) {
                                $path = URL::asset('public/uploads/video/' . $model->image);
                            } else {
                                $path = URL::asset('public/backend/no-image.png');
                            }
                            return '<img height="50" width="50" src="' . $path . '"/>';
                        })

                        ->editColumn('prime', function ($model) {
                            if ($model->prime == '0') {
                                $prime = '<span class="badge badge-warning"><i class="icofont-warning"></i>Non Prime</span>';
                            } else if ($model->prime == '1') {
                                $prime = '<span class="badge badge-success"><i class="icofont-check"></i>Prime</span>';
                            }
                            return $prime;
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
                            '<a href="' . Route("video-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>'.
                            '<a href="javascript:;" onclick="deleteVideo(this);" data-href="' . Route("video-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['image','created_at','prime','status', 'action'])
                        ->make(true);
    }
    
    
    public function get_add() {

        return view('admin::video.add');
    } 
    
    
    public function post_add(Request $request) {

        $validator = Validator::make($request->all(), [
                    'video_name' => 'required',
                    'embeded_video' => 'required',
                    'image' => 'required|mimes:jpeg,webp,jpg,png,svg',
                    'video_image' => 'required|mimes:jpeg,webp,jpg,png,svg',
                    'latest' => 'required',
                    'trending' => 'required',
                    'popular' => 'required',
                    'status' => 'required',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });

        if ($validator->passes()) {
            $data = new Video();
            $input = $request->all();

            if ($file = $request->file('image')) {
                $name = time() . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/video');
                $file->move($destinationPath, $name);
                $input['image'] = $name;
            }

            if ($file2 = $request->file('video_image')) {
                $name2 = time() . $file2->getClientOriginalName();
                $destinationPath2 = public_path('uploads/video');
                $file2->move($destinationPath2, $name2);
                $input['video_image'] = $name2;
            }
            
            $data->fill($input)->save();

            return redirect()->route('video')->with('success_msg', 'New Video created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        
    }
    
    
    public function get_edit($id) {
        $data = Video::where('id',$id)->first();
        return view('admin::video.edit',["data"=>$data]);
    }
    
    
    public function post_edit(Request $request, $id) {
         $validator = Validator::make($request->all(), [
            'video_name' => 'required',
            'embeded_video' => 'required',
            'image' => 'nullable|mimes:jpeg,webp,jpg,png,svg',
            'video_image' => 'nullable|mimes:jpeg,webp,jpg,png,svg',
            'latest' => 'required',
            'trending' => 'required',
            'popular' => 'required',
            'status' => 'required',
            ]
        );
        $validator->after(function($validator) use($request) {
            
        });
        
        if ($validator->passes()) {
            //--- Logic Section
            $data = Video::findOrFail($id);
            $input = $request->all();

            if ($file = $request->file('image')) {
                $name = time() . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/video');
                $file->move($destinationPath, $name);
                if ($data->image != null) {
                    if (file_exists(public_path('uploads/video' . $data->image))) {
                        unlink(public_path('uploads/video' . $data->image));
                    }
                }
                $input['image'] = $name;
            }

            if ($file2 = $request->file('video_image')) {
                $name2 = time() . $file2->getClientOriginalName();
                $destinationPath2 = public_path('uploads/video');
                $file2->move($destinationPath2, $name2);
                if ($data->video_image != null) {
                    if (file_exists(public_path('uploads/video' . $data->video_image))) {
                        unlink(public_path('uploads/video' . $data->video_image));
                    }
                }
                $input['video_image'] = $name2;
            }
            
            $data->update($input);
            
            return redirect()->route('video')->with('success_msg', 'Video updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        
    }
    
    
    public function delete($id) {
        $data = [];
        $model = Video::findOrFail($id);
        
        //If Photo Exist
        if (isset($model->image)){
            if (file_exists(public_path('uploads/video' . $model->image))) {
                unlink(public_path('uploads/video' . $model->image));
            }
        }

        if (isset($model->video_image)) {
            if (file_exists(public_path('uploads/video' . $model->video_image))) {
                unlink(public_path('uploads/video' . $model->video_image));
            }
        }
        
        $model->delete();
        //--- Redirect Section
        $data['status'] = 200;
        $data['msg'] = 'Video Deleted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends
    }



}
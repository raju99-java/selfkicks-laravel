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
use App\Model\PrimeVideo;


class PrimeVideoController extends AdminController {


    public function index() {


        return view('admin::prime-video.list');
    }

    public function datatables() {
        $videos = PrimeVideo::orderBy('id','desc')->get();

        return Datatables::of($videos)
                        ->addIndexColumn()
                        
                        ->editColumn('image', function ($model) {

                            $data = Video::where('id',$model->video_id)->count();

                            if($data>0){
                                if (isset($model->video_id)) {
                                    $path = URL::asset('public/uploads/video/' . $model->video->image);
                                } else {
                                    $path = URL::asset('public/backend/no-image.png');
                                }
                            }else{
                                $path = URL::asset('public/backend/no-image.png');
                            }
                            return '<img height="50" width="50" src="' . $path . '"/>';
                        })

                        ->editColumn('video_name', function ($model) {

                            $data = Video::where('id',$model->video_id)->count();

                            if($data>0){
                                if (isset($model->video_id)) {
                                    $video_name = $model->video->video_name;
                                } else {
                                    $video_name = 'NA';
                                }
                                
                            }else{
                                $video_name = 'NA';
                            }
                            return $video_name;
                        })

                        ->editColumn('shows', function ($model) {
                            if ($model->shows == '1') {
                                $shows = '<span class="badge badge-primary"><i class="icofont-sun-rise"></i>Morning</span>';
                            } else if ($model->shows == '2') {
                                $shows = '<span class="badge badge-success"><i class="icofont-full-night"></i>Evening</span>';
                            }else{
                                $shows = '<span class="badge badge-danger"><i class="icofont-not-allowed"></i>NA</span>';
                            }
                            return $shows;
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
                            '<a href="' . Route("prime-video-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>'.
                            '<a href="javascript:;" onclick="deletePrimeVideo(this);" data-href="' . Route("prime-video-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['image','video_name','shows','created_at','status', 'action'])
                        ->make(true);
    }
    
    
    public function get_add() {
        $data = [];
        $data['videos'] = Video::where('status','=','1')->orderBy('id','desc')->get();

        return view('admin::prime-video.add',$data);
    } 
    
    
    public function post_add(Request $request) {

        $validator = Validator::make($request->all(), [
                    'video_id' => 'required',
                    'shows' => 'required',
                    'start' => 'required',
                    'expiry' => 'required',
                    'status' => 'required',
                ]
        );
        $validator->after(function($validator) use($request) {

            $startdatetime = $request->input('start');
            $startdate = date('d-m-Y',strtotime($startdatetime));
            // print_r($startdate);exit;

            $checkStart = PrimeVideo::where('start', 'like',  '%' . $startdate .'%')->where('status','1')->count();
            // print_r($check);exit;
            if($checkStart > 1){
                $validator->errors()->add('start', 'You exceed the limit. Try another Date !');
            }

            $shows = $request->input('shows');
            $checkShows = PrimeVideo::where('start', 'like',  '%' . $startdate .'%')->where('shows','=',$shows)->where('status','1')->count();
            if($checkShows > 0){
                $validator->errors()->add('shows', 'You exceed the limit !');
            }

            $video_id = $request->input('video_id');
            $checkVideo = PrimeVideo::where('start', 'like',  '%' . $startdate .'%')->where('video_id','=',$video_id)->where('status','1')->count();
            if($checkVideo > 0){
                $validator->errors()->add('video_id', 'Video already assign today. Try another Date !');
            }

        });

        if ($validator->passes()) {
            $data = new PrimeVideo();
            $input = $request->all();

            $model = Video::where('id','=',$input['video_id'])->first();

            if($model){
                $model->prime = '1';
                $model->save();
            }
            
            $data->fill($input)->save();

            return redirect()->route('prime-video')->with('success_msg', 'New Prime Video created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        
    }
    
    
    public function get_edit($id) {
        $data = [];
        $data['videos'] = Video::where('status','=','1')->orderBy('id','desc')->get();
        $data['prime_video'] = PrimeVideo::where('id',$id)->first();
        return view('admin::prime-video.edit',$data);
    }
    
    
    public function post_edit(Request $request, $id) {
         $validator = Validator::make($request->all(), [
            'video_id' => 'required',
            'shows' => 'required',
            'start' => 'required',
            'expiry' => 'required',
            'status' => 'required',
            ]
        );
        $validator->after(function($validator) use($request) {
            $date = date("d-m-Y");

            $startdatetime = $request->input('start');
            $startdate = date('d-m-Y',strtotime($startdatetime));

            if($date != $startdate){
                $check = PrimeVideo::where('start', 'like',  '%' . $startdate .'%')->where('status','1')->count();
                if($check > 1){
                    $validator->errors()->add('start', 'You exceed the limit. Try another Date !');
                }
            }

            $shows = $request->input('shows');

            $mdl = PrimeVideo::where('id',$request->input('id'))->first();

            if($shows != $mdl->shows){

                $checkShows = PrimeVideo::where('start', 'like',  '%' . $startdate .'%')->where('shows','=',$shows)->where('status','1')->count();
                if($checkShows > 0){
                    $validator->errors()->add('shows', 'You exceed the limit !');
                }
            }

            $video_id = $request->input('video_id');
            if($video_id != $mdl->video_id){
                $checkVideo = PrimeVideo::where('start', 'like',  '%' . $startdate .'%')->where('video_id','=',$video_id)->where('status','1')->count();
                if($checkVideo > 0){
                    $validator->errors()->add('video_id', 'Video already assign today. Try another Date !');
                }
            }
            

        });
        
        if ($validator->passes()) {
            //--- Logic Section
            $data = PrimeVideo::findOrFail($id);
            $input = $request->all();

            if($data->video_id != $input['video_id']){

                $video = Video::where('id','=',$data->video_id)->first();

                if($video){
                    $video->prime = '0';
                    $video->save();
                }

                $model = Video::where('id','=',$input['video_id'])->first();

                if($model){
                    $model->prime = '1';
                    $model->save();
                }
            }
            
            
            $data->update($input);
            
            return redirect()->route('prime-video')->with('success_msg', 'Prime Video updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        
    }
    
    
    public function delete($id) {
        $data = [];
        $model = PrimeVideo::findOrFail($id);
        
        $video = Video::where('id','=',$model->video_id)->first();

        if($video){
            $video->prime = '0';
            $video->save();
        }
        
        $model->delete();
        //--- Redirect Section
        $data['status'] = 200;
        $data['msg'] = 'Prime Video Deleted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends
    }



}
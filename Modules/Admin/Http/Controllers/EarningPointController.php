<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\EarnPoints;
use Yajra\Datatables\Datatables;

class EarningPointController extends AdminController {

    public function get_earning_points_list(Request $request) {
        return view('admin::earning-points.index');
    }

    public function get_earning_points_list_datatable() {
        $enq = EarnPoints::where('status','=','1')->orderBy('id', 'desc')->get();

        return Datatables::of($enq)

            ->editColumn('full_name', function ($model) {
                $full_name = $model->user->full_name;
                return $full_name;
            })

            ->editColumn('email', function ($model) {
                $email = $model->user->email;
                return $email;
            })

            ->editColumn('video_name', function ($model) {
                $video = $model->video->video_name;
                return $video;
            })

            ->editColumn('total_points', function ($model) {
                $total_points = $model->user->total_points;
                return $total_points;
            })

            ->editColumn('date', function ($model) {
                return date('jS M Y, h:i A', strtotime($model->date));
            })

            ->rawColumns(['full_name','email','video_name','total_points','date'])
            ->make(true);
    }

}

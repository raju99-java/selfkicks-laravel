<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Contactus;
use Yajra\Datatables\Datatables;

class EnquiryController extends AdminController {

    public function get_enquiry_list(Request $request) {
        return view('admin::enquiry.index');
    }

    public function get_enquiry_list_datatable() {
        $enq = Contactus::where('status','=','1')->orderBy('id', 'desc')->get();
        return Datatables::of($enq)
            ->editColumn('phone', function ($model) {
                $phone = !empty($model->phone) ? $model->phone : 'NA';
                return $phone;
            })
            ->editColumn('created_at', function ($model) {
                return !empty($model->created_at) ? date('jS M Y, g:i A', strtotime($model->created_at)) : 'NA';
            })
            ->addColumn('action', function ($model) {
                return '<a href="' . Route("enquiry-view", ["id" => $model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> View</a>'.
                        '<a href="javascript:;" onclick="deleteEnquiry(this);" data-href="' . Route("enquiry-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
            })
            ->rawColumns(['phone','created_at','action'])
            ->make(true);
    }

    public function get_view($id = "") {
        if ($id == "") {
            return redirect()->route('enquiry');
        }
        $model = Contactus::find($id);
        if (empty($model)) {
            return redirect()->route('enquiry')->with('error_msg', 'Data Not found.');
        }
        return view('admin::enquiry.view', ['model' => $model]);
    }
    
    public function delete($id) {
        $data = [];
        $model = Contactus::findOrFail($id);
        
        
        $model->delete();
        //--- Redirect Section
        $data['status'] = 200;
        $data['msg'] = 'Deleted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends
    }

}

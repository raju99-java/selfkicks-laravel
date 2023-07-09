<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Testimonial;
use Yajra\Datatables\Datatables;
use Validator;

class CkeditorController extends AdminController {

    public function upload_ckeditor(Request $request) {

        if ($file = $request->file('upload')) {
            $name = time() . $file->getClientOriginalName();
            $destinationPath = public_path('uploads/ckeditor');
            $file->move($destinationPath, $name);
        }
        // $request->upload->move(public_path('uploads/ckeditor'), $request->file('upload')->getClientOriginalName());
        // echo json_encode(array('file_name' => $name));
        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $url = asset('public/uploads/ckeditor/'.$name);
        $message = 'File uploaded successfully';
        $result = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$message')</script>";

        // Render HTML output
        @header('Content-type: text/html; charset=utf-8');
        echo $result;
    }

    

    

}

<?php

namespace App\Http\Controllers\Control_Panel\Maintenance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\StudentCategory;

class StudentCategoryController extends Controller
{
    public function index (Request $request)
    {
        if ($request->ajax())
        {
            $StudentCategory = StudentCategory::where('status', 1)->where('student_category', 'like', '%'.$request->search.'%')->paginate(10);
            return view('control_panel.student_category.partials.data_list', compact('StudentCategory'))->render();
        }
        $StudentCategory = StudentCategory::where('status', 1)->paginate(10);
        return view('control_panel.student_category.index', compact('StudentCategory'));
    }

    public function modal_data (Request $request) 
    {
        $StudentCategory = NULL;
        if ($request->id)
        {
            $StudentCategory = StudentCategory::where('id', $request->id)->first();
        }
        return view('control_panel.student_category.partials.modal_data', compact('StudentCategory'))->render();
    }

    public function save_data (Request $request) 
    {
        $rules = [
            'student_category' => 'required'
        ];

        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }

        if ($request->id)
        {
            $StudentCategory = StudentCategory::where('id', $request->id)->first();
            $StudentCategory->student_category = $request->student_category;
            $StudentCategory->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        }

        $StudentCategory = new StudentCategory();
        $StudentCategory->student_category = $request->student_category;
        $StudentCategory->save();
        return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
    }

    public function deactivate_data (Request $request) 
    {
        $StudentCategory = \App\StudentCategory::where('id', $request->id)->first();

        if ($StudentCategory)
        {
            $StudentCategory->status = 0;
            $StudentCategory->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully deactivated.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }
}



<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\StudentInformation;
use App\GradeLevel;
use App\DiscountFee;
use App\OtherFee;
use App\SchoolYear;
use App\StudentCategory;
use App\PaymentCategory;

class StudentController extends Controller
{
    public function index (Request $request) 
    {
        if ($request->ajax())
        {
            $StudentInformation = StudentInformation::with(['user', 'enrolled_class'])->where('status', 1)
                ->orderBY('last_name', 'ASC')
                ->where(function ($query) use ($request) {
                    $query->where('first_name', 'like', '%'.$request->search.'%');
                    $query->orWhere('middle_name', 'like', '%'.$request->search.'%');
                    $query->orWhere('last_name', 'like', '%'.$request->search.'%');
            })
            // ->orWhere('first_name', 'like', '%'.$request->search.'%')
            ->paginate(10);
            // return json_encode(['student_info' => $StudentInformation]);
            return view('control_panel_finance.student_information.partials.data_list', compact('StudentInformation'))->render();
        }
        
        $StudentInformation = StudentInformation::with(['user', 'enrolled_class'])->where('status', 1)
            ->orderBY('last_name', 'ASC')
            ->paginate(10);
        // return json_encode(['student_info' => $StudentInformation]);
        return view('control_panel_finance.student_information.index', compact('StudentInformation'));
    }

    public function modal_data (Request $request) 
    {
        $StudentInformation = NULL;
        $Gradelvl = NULL;
        $Profile = StudentInformation::where('id', $request->id)->first(); 
        if ($request->id)
        {
            $StudentInformation = StudentInformation::with(['user'])->where('id', $request->id)->first();
            $Gradelvl = GradeLevel::where('current', 1)->where('status', 1)->get();
            $Discount = DiscountFee::where('current', 1)->where('status', 1)->get();
            $OtherFee = OtherFee::where('current', 1)->where('status', 1)->get();  
            $SchoolYear = SchoolYear::where('current', 1)->where('status', 1)->first();
            $StudentCategory = StudentCategory::where('status', 1)->get();
            // $PaymentCategory = PaymentCategory::where('status', 1)->where('current', 1)->get();
            $PaymentCategory = PaymentCategory::with('stud_category','tuition','misc_fee')
                ->where('status', 1)->where('current', 1)->get();
            // return view('control_panel.student_information.partials.modal_data', compact('StudentInformation','Profile'))->render(); 
            // return view('control_panel.student_information.partials.modal_data', compact('StudentInformation'))->render()        
        }

        return view('control_panel_finance.student_information.partials.modal_data', 
            compact('StudentInformation','Profile','Gradelvl','Discount','OtherFee','SchoolYear','StudentCategory','PaymentCategory'))->render();  
    	// return view('profile', array('user' => Auth::user()) );        
    }
}

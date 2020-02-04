<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\StudentInformation;

class StudentPaymentController extends Controller
{
    
    public function index(Request $request)
    {     
        $StudentInformation = NULL;

        if ($request->ajax())
        {
            $StudentInformation = StudentInformation::with(['user'])->where('id', $request->id)->first();
                
            // return json_encode(['student_info' => $StudentInformation]);
            return view('control_panel_finance.student_payment.partials.data_list', compact('StudentInformation'))->render();
        }
        
        $StudentInformation = StudentInformation::with(['user'])->where('id', $request->id)->first();

        return view('control_panel_finance.student_payment.partials.data_list', compact('StudentInformation'));
    }

    // public function modal_data (Request $request) 
    // {
    //     $StudentInformation = NULL;
    //     $Gradelvl = NULL;
    //     $Profile = StudentInformation::where('id', $request->id)->first(); 
        
    //     if ($request->id)
    //     {
    //         $StudentInformation = StudentInformation::with(['user'])->where('id', $request->id)->first();
    //         $Gradelvl = GradeLevel::where('current', 1)->where('status', 1)->get();
    //         $Discount = DiscountFee::where('current', 1)->where('status', 1)->get();
    //         $OtherFee = OtherFee::where('current', 1)->where('status', 1)->get();  
    //         $SchoolYear = SchoolYear::where('current', 1)->where('status', 1)->first();
    //         $StudentCategory = StudentCategory::where('status', 1)->get();
            
    //         $PaymentCategory = PaymentCategory::with('stud_category','tuition','misc_fee')
    //             ->where('status', 1)->where('current', 1)->get();

    //         $Transaction = Transaction::with('payment_cat')->where('student_id', $request->id)
    //             ->where('status', 1)->first();
    //     }

    //     if(!$Transaction){
    //         return view('control_panel_finance.student_information.partials.modal_data', 
    //             compact('StudentInformation','Profile','Gradelvl','Discount','OtherFee','SchoolYear','StudentCategory','PaymentCategory','Transaction'))->render();  
    //     }else{

    //         return view('control_panel_finance.student_information.partials.modal_account',
    //             compact('StudentInformation','Profile','Gradelvl','Discount','OtherFee','SchoolYear','StudentCategory','PaymentCategory','Transaction'))->render(); 
    //     }
        
    //             // return view('profile', array('user' => Auth::user()) );        
    // }
}

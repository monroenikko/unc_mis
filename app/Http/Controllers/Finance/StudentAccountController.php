<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\StudentInformation;

class StudentAccountController extends Controller
{
    public function index(Request $request, $stud_id){

        // if ($id)
        // {
        //     $StudentInformation = StudentInformation::with(['user'])->where('id', $id)->first();
        //     // $Gradelvl = GradeLevel::where('current', 1)->where('status', 1)->get();
        //     // $Discount = DiscountFee::where('current', 1)->where('status', 1)->get();
        //     // $OtherFee = OtherFee::where('current', 1)->where('status', 1)->get();  
        //     // $SchoolYear = SchoolYear::where('current', 1)->where('status', 1)->first();
        //     // $StudentCategory = StudentCategory::where('status', 1)->get();
            
        //     // $PaymentCategory = PaymentCategory::with('stud_category','tuition','misc_fee')
        //     //     ->where('status', 1)->where('current', 1)->get();

        //     // $Transaction = Transaction::with('payment_cat')->where('student_id', $request->id)
        //     //     ->where('status', 1)->first();
        // }

        $StudentInformation = StudentInformation::with(['user'])->where('id', $stud_id)->first();

        return view('control_panel_finance.student_payment_account.index', compact('StudentInformation'));
    }
}

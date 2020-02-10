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
use App\Transaction;

class StudentAccountController extends Controller
{
    public function index(Request $request, $stud_id){

        $Profile = StudentInformation::where('id', $stud_id)->first(); 
        if($request->ajax()){
            // $StudentInformation = $StudentInformation->paginate(10);

            $StudentInformation = StudentInformation::with(['user'])
            ->where('id', $stud_id)
            ->first();

            return view('control_panel_finance.student_payment_account.partials.data_list', compact('StudentInformation'))->render();
        }

        $Gradelvl = GradeLevel::where('current', 1)->where('status', 1)->get();
        $Discount = DiscountFee::where('current', 1)->where('status', 1)->get();
        $OtherFee = OtherFee::where('current', 1)->where('status', 1)->get();  
        $SchoolYear = SchoolYear::where('current', 1)->where('status', 1)->first();
        $StudentCategory = StudentCategory::where('status', 1)->get();        
        $PaymentCategory = PaymentCategory::with('stud_category','tuition','misc_fee')
            ->where('status', 1)->where('current', 1)->get();
        $Transaction = Transaction::with('payment_cat')->where('student_id', $stud_id)
            ->where('status', 1)->first();
        $StudentInformation = StudentInformation::with(['user'])
            ->where('id', $stud_id)
            ->first();
        // return json_encode(['student_info' => $StudentInformation]);
        return view('control_panel_finance.student_payment_account.index', 
            compact('StudentInformation','Profile','Gradelvl','Discount','OtherFee','SchoolYear','StudentCategory','PaymentCategory','Transaction'));
    }
}

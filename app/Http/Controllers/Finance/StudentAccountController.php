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
        $StudentInformation = NULL;
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


    public function save_data (Request $request) 
    {
        $School_year_id = SchoolYear::where('status', 1)
                ->where('current', 1)->first();
        if($request->stud_status == 0){
        
            $rules = [
                'payment_category' => 'required',
                'or_number' => 'required',
                'downpayment' => 'required',     
            ];

            $Validator = \Validator($request->all(), $rules);

            if ($Validator->fails())
            {
                return response()->json(['res_code' => 1, 'res_msg' 
                    => 'Please fill all required fields.', 'res_error_msg' 
                    => $Validator->getMessageBag()]);
            }

            $Transaction = new Transaction();
            $Transaction->or_number = $request->or_number;
            $Transaction->payment_category_id = $request->payment_category;
            $Transaction->student_id = $request->id;
            $Transaction->school_year_id = $School_year_id->id;
            $Transaction->downpayment = $request->downpayment;
           
            $Transaction->no_month_paid = 1;

            $PaymentCategory = PaymentCategory::with('stud_category','tuition','misc_fee')
                ->where('id', $request->payment_category)
                ->where('status', 1)->first();
            
            $total_others = 0;
            if(!empty($request->others)){
                foreach($request->others as $get_data){
                    $OtherFee = OtherFee::where('id', $get_data)
                        ->where('current', 1)
                        ->where('status', 1)->first();

                    $total_others += $OtherFee->other_fee_amt;

                    $OtherFeeSave = new TransactionOtherFee();
                    $OtherFeeSave->or_no = $request->or_number;
                    $OtherFeeSave->student_id = $request->id;
                    $OtherFeeSave->others_fee_id = $get_data;
                    $OtherFeeSave->school_year_id = $School_year_id->id;
                    $OtherFeeSave->save();
                }
            }

            $total_disc = 0;
            if(!empty($request->discount)){
                foreach($request->discount as $get_data){
                    $DiscountFee = DiscountFee::where('id', $get_data)
                        ->where('current', 1)
                        ->where('status', 1)->first();

                    $total_disc += $DiscountFee->disc_amt;

                    $DiscountFeeSave = new TransactionDiscount();
                    $DiscountFeeSave->or_no = $request->or_number;
                    $DiscountFeeSave->student_id = $request->id;
                    $DiscountFeeSave->discount_fee_id = $get_data;
                    $DiscountFeeSave->school_year_id = $School_year_id->id;
                    $DiscountFeeSave->save();
                }
            }
            
            // echo $total_others;

            $TutionFee = TuitionFee::where('id', $PaymentCategory->tuition_fee_id)->where('status', 1)->first();
            $MiscFee   = MiscFee::where('id', $PaymentCategory->misc_fee_id)->where('status', 1)->first();
            $Discount  = DiscountFee::where('id', $request->discount)->where('status', 1)->where('current', 1)->first();
            
            // tuition and misc
            $total_1 = $TutionFee->tuition_amt + $MiscFee->misc_amt;

            
            $total_2 = ($total_1 - $total_disc);
            $total_3 = ($total_2 - $request->downpayment);
            

            $totalmonths =  $PaymentCategory->months - 1;
            $monthlyfee = $total_2 / $PaymentCategory->months;
            // total months left
            $Transaction->total_no_month = $totalmonths;
            // monthly fee
            $Transaction->monthly_fee = $monthlyfee;
            $totalmonths = $PaymentCategory->months - 2;
            $last_fee = $totalmonths  * $monthlyfee;
            $total_lastfee = $total_3 - $last_fee  ;

            // lastfee 
            $Transaction->last_fee = $total_lastfee;
            $Transaction->balance = $total_3;
            $Transaction->save();
            
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        }
        else
        {
            $rules = [
                'months' => 'required',
                'or_number' => 'required',
                'payment' => 'required',     
            ];

            $Validator = \Validator($request->all(), $rules);

            if ($Validator->fails())
            {
                return response()->json(['res_code' => 1, 'res_msg' 
                    => 'Please fill all required fields.', 'res_error_msg' 
                    => $Validator->getMessageBag()]);
            }   

            $request->no_months_paid;
        }
    }
}

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
use App\TransactionOtherFee;
use App\TransactionMonthPaid;
use App\TuitionFee;
use App\MiscFee;
use App\TransactionDiscount;

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

            $Transaction = Transaction::with('payment_cat')->where('student_id', $request->id)
            ->where('status', 1)->first();
            
            // return json_encode(['student_info' => $StudentInformation]);
            return view('control_panel_finance.student_information.partials.data_list', compact('StudentInformation','Transaction'))->render();
        }
        
        $StudentInformation = StudentInformation::with(['user', 'enrolled_class'])->where('status', 1)
            ->orderBY('last_name', 'ASC')
            ->paginate(10);

        $Transaction = Transaction::with('payment_cat')->where('student_id', $request->id)
            ->where('status', 1)->first();
        // return json_encode(['student_info' => $StudentInformation]);
        return view('control_panel_finance.student_information.index', compact('StudentInformation','Transaction'));
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
            
            $PaymentCategory = PaymentCategory::with('stud_category','tuition','misc_fee')
                ->where('status', 1)->where('current', 1)->get();

            $Transaction = Transaction::with('payment_cat')->where('student_id', $request->id)
                ->where('status', 1)->first();
        }

        if(!$Transaction){
            return view('control_panel_finance.student_information.partials.modal_data', 
                compact('StudentInformation','Profile','Gradelvl','Discount','OtherFee','SchoolYear','StudentCategory','PaymentCategory','Transaction'))->render();  
        }else{

            return view('control_panel_finance.student_information.partials.modal_account',
                compact('StudentInformation','Profile','Gradelvl','Discount','OtherFee','SchoolYear','StudentCategory','PaymentCategory','Transaction'))->render(); 
        }
        
                // return view('profile', array('user' => Auth::user()) );        
    }

    public function data_student (Request $request)
    {
        return view('control_panel_finance.student_information.index');
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

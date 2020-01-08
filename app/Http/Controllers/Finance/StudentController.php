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
            $Transaction = Transaction::with('transaction_others_fee')->where('student_id', $request->id)
                ->where('status', 1)->orderBy('id', 'desc')->first();


            // return view('control_panel.student_information.partials.modal_data', compact('StudentInformation','Profile'))->render(); 
            // return view('control_panel.student_information.partials.modal_data', compact('StudentInformation'))->render()        
        }

        return view('control_panel_finance.student_information.partials.modal_data', 
            compact('StudentInformation','Profile','Gradelvl','Discount','OtherFee','SchoolYear','StudentCategory','PaymentCategory','Transaction'))->render();  
    	// return view('profile', array('user' => Auth::user()) );        
    }

    public function save_data (Request $request) 
    {
        $rules = [
            'payment_category' => 'required',
            'or_number' => 'required',
            'downpayment' => 'required',     
            'from_months' => 'required',
        ];

        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' 
                => 'Please fill all required fields.', 'res_error_msg' 
                => $Validator->getMessageBag()]);
        }   

        $School_year_id = SchoolYear::where('status', 1)
            ->where('current', 1)->first();

        $Transaction = new Transaction();
        $Transaction->or_number = $request->or_number;
        $Transaction->payment_category_id = $request->payment_category;
        $Transaction->student_id = $request->id;
        $Transaction->school_year_id = $School_year_id->id;
        $Transaction->downpayment = $request->downpayment;
        $Transaction->date_from = $request->from_months;

        if($request->to_months == '')
        {
            $Transaction->date_to = '0';
        }else{
            $Transaction->date_to = $request->to_months;
        }

        if($request->to_months){
            $total1= $request->to_months - $request->from_months;
            $total2= $total1 + 1;
        }
        else{
            $total1= $request->from_months - $request->to_months;
            $total2= $total1 - 1;
        }
        
        
        $Transaction->no_month_paid = $total2;

        // if($request->total_months == '')
        // {
        //     $Transaction->total_months = '0';
        // }else{
        //     $Transaction->total_months = $request->total_months;
        // }

        $PaymentCategory = PaymentCategory::with('stud_category','tuition','misc_fee')
            ->where('id', $request->payment_category)
            ->where('status', 1)->first();
        
        $total_others = 0;
        if(!empty($request->others)){
            foreach($request->others as $get_data){
                $total_others += $get_data;
            }
        }
        echo $total_others;

        $TutionFee = TuitionFee::where('id', $PaymentCategory->tuition_fee_id)->where('status', 1)->first();
        $MiscFee = MiscFee::where('id', $PaymentCategory->misc_fee_id)->where('status', 1)->first();
        $Discount = DiscountFee::where('id', $request->discount)->where('status', 1)->where('current', 1)->first();
        
        $total_1 = $TutionFee->tuition_amt + $MiscFee->misc_amt;
        $total_2 = ($total_1 - $Discount->disc_amt);
        $total_3 = ($total_2 - $request->downpayment);
        $totalmonths =  $PaymentCategory->months - 1;
        $monthlyfee = $total_3 / $totalmonths;
        // total months left
        $Transaction->total_no_month = $totalmonths;
        // monthly fee
        $Transaction->monthly_fee = $monthlyfee;
        $last_fee = $PaymentCategory->months * $monthlyfee;
        $total_lastfee = $last_fee - $total_3 ;
        // lastfee 
        $Transaction->last_fee = $total_lastfee;
        $Transaction->balance = $total_3;
        $Transaction->save();
        
        return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
    }
}

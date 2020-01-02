<?php

namespace App\Http\Controllers\Finance\Maintenance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TuitionFee;
use App\MiscFee;
use App\GradeLevel;

class PaymentCategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            // $DiscountFee = \App\DiscountFee::where('status', 1)->where('disc_type', 'like', '%'.$request->search.'%')->paginate(10);
            // return view('control_panel_finance.maintenance.monthly_fee.partials.data_list', compact('DiscountFee'))->render();
            return view('control_panel_finance.maintenance.monthly_fee.partials.data_list');
        }
        
        $PaymentCategory = \App\PaymentCategory::where('status', 1)->paginate(10);
        // return view('control_panel_finance.maintenance.discount_fee.index', compact('DiscountFee'));
        return view('control_panel_finance.maintenance.monthly_fee.index', compact('PaymentCategory'));
    }

    public function modal_data (Request $request) 
    {
        $PaymentCategory = NULL;
        // $MiscFee = NULL;
        // $TuitionFee = NULL;
        // $Gradelvl = NULL;
        
        if ($request->id)
        {
            $PaymentCategory = \App\PaymentCategory::where('id', $request->id)->where('status', 1)->paginate(10);
            
        }
            $TuitionFee = TuitionFee::where('current', 1)->where('status', 1)->get();
            $MiscFee = MiscFee::where('current', 1)->where('status', 1)->get();
            $Gradelvl = GradeLevel::where('current', 1)->where('status', 1)->get();
        // return view('control_panel_finance.maintenance.discount_fee.partials.modal_data', compact('DiscountFee'))->render();
        return view('control_panel_finance.maintenance.monthly_fee.partials.modal_data', compact('TuitionFee','MiscFee','Gradelvl','PaymentCategory'))->render();
    }

    public function save_data (Request $request) 
    {
        $rules = [
            'disc_type' => 'required',
            'disc_fee' => 'required'           
        ];

        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }   
        // update
        if ($request->id)
        {
            $DiscountFee = \App\DiscountFee::where('id', $request->id)->first();
            $DiscountFee->disc_type = $request->disc_type;
            $DiscountFee->disc_amt = $request->disc_fee;
            $DiscountFee->current = $request->current_sy;
            $DiscountFee->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        }
        // save
        $DiscountFee = new \App\DiscountFee();
        $DiscountFee->disc_type = $request->disc_type;
        $DiscountFee->disc_amt = $request->disc_fee;
        $DiscountFee->current = $request->current_sy;
        $DiscountFee->save();
        return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
    }

    public function toggle_current_sy (Request $request)
    {
        $DiscountFee = \App\DiscountFee::where('id', $request->id)->first();
        if ($DiscountFee) 
        {
            if ($DiscountFee->current == 0) 
            {
                $DiscountFee->current = 1; 
                $DiscountFee->save(); 
                return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully added to current active Discount Fee.']);
            }
            else 
            {
                $DiscountFee->current = 0; 
                $DiscountFee->save(); 
                return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully removed from current active Discount Fee.']);
            }
        }
    }

    public function deactivate_data (Request $request) 
    {
        $DiscountFee = \App\DiscountFee::where('id', $request->id)->first();

        if ($DiscountFee)
        {
            $DiscountFee->status = 0;
            $DiscountFee->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully deactivated.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }
}

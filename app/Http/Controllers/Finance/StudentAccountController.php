<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\StudentInformation;

class StudentAccountController extends Controller
{
    public function index(Request $request, $stud_id){
        
        if($request->ajax()){
            // $StudentInformation = $StudentInformation->paginate(10);

            $StudentInformation = StudentInformation::with(['user'])
            ->where('id', $stud_id)
            ->first();

            return view('control_panel_finance.student_payment_account.partials.data_list', compact('StudentInformation'))->render();
        }

        $StudentInformation = StudentInformation::with(['user'])
            ->where('id', $stud_id)
            ->first();

        return view('control_panel_finance.student_payment_account.index', compact('StudentInformation'));
    }
}

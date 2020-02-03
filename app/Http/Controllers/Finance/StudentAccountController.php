<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentAccountController extends Controller
{
    public function index(){

        return view('control_panel_finance.student_payment_account.index');
    }
}

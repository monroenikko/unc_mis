@extends('control_panel.layouts.print_layout')

@section('content')

    <p class="p0 m0 student-info"><b>Name</b> : {{ ucfirst($Transaction->student_name)}}</p>
    <p class="p0 m0 student-info"><b>school year</b> : {{ ucfirst($Transaction->school_year)}}</p>
    <p class="p0 m0 student-info"><b>or number</b> : {{ ucfirst($Transaction->or_number)}}</p>
    <p class="p0 m0 student-info"><b>downpayment</b> : {{ ucfirst($Transaction->downpayment)}}</p>
    <p class="p0 m0 student-info"><b>monthly_fee</b> : {{ ucfirst($Transaction->monthly_fee)}}</p>
    <p class="p0 m0 student-info"><b>total balance</b> : {{ ucfirst($Transaction->balance)}}</p>
    <p class="p0 m0 student-info"><b>Discount</b> : 
        @foreach($Transaction_disc as $data)
            {{$data->discountFee->disc_type}} {{$data->discountFee->disc_amt}}
        @endforeach
    </p>
    <p class="p0 m0 student-info">
        <b>PaymentCategory</b> :<br> Grade level: 
        {{$PaymentCategory->stud_category->student_category}} <br>
         Tuition fee: {{$PaymentCategory->tuition->tuition_amt}}<br>
         Miscellenous fee: {{$PaymentCategory->misc_fee->misc_amt}}
    </p>

@endsection
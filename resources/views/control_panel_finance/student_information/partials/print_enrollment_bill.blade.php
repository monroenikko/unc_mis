@extends('control_panel.layouts.print_layout')

@section('content')
    <p class="heading1">Republic of the Philippines</p>
    <p class="heading1">Department of Education</p>
    <p class="heading1">Region III</p>
    <p class="heading1">Division of Bataan</p>
    <br/>
    <h2 class="heading2 ">UNIVERSITY OF NUEVA CACERES</h2>
    <p class="heading2 heading2-subtitle"><b>K to 12 BASIC EDUCATION CURRICULUM</b></p>
    <p class="heading2 heading2-subtitle">Dinalupihan, Bataan</p>
    <br/>
    <br/>

    <table class="table-student-info">
        <tr>
            <td><p class="p0 m0 student-info"><b>Name</b> : {{ $Transaction->student_name}}</p></td>
            <td><p class="p0 m0 student-info"><b>Date</b> : {{ date_format(date_create($Transaction->created_at), 'F d, Y')}}</p></td>
        </tr>
        <tr>
            <td>
                <p class="p0 m0 student-info">
                    <b>Grade level:</b> {{$PaymentCategory->stud_category->student_category}}
                </p>
            </td>
            <td>
                <p class="p0 m0 student-info">                    
                    <b>School Year</b> : {{ ucfirst($Transaction->school_year)}}</p>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="p0 m0 student-info">
                    <b>OR number:</b> {{$Transaction->or_number}}
                </p>
            </td>
            <td>
                <p class="p0 m0 student-info">
                    <b>Tuition fee:</b> {{ number_format($PaymentCategory->tuition->tuition_amt, 2)}} 
                    <b>Miscellenous fee:</b> {{number_format($PaymentCategory->misc_fee->misc_amt, 2)}}
                </p>
            </td>
        </tr>
    </table>
               
    <h3 style="text-align: center">Summary Bill for Invoice</h3>
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">Tuition Fee</th>
            <th scope="col">Misc Fee</th>
            <th scope="col">Discount</th>
            <th scope="col">Downpayment</th>
            <th scope="col">Paid</th>
            <th scope="col">Total Balance</th>
            <th scope="col">Remarks</th>
        </tr>
        </thead>
        <tbody>    
            <tr>
                <td class="td-center">{{number_format($PaymentCategory->tuition->tuition_amt,2)}}</td>
                <td class="td-center">{{number_format($PaymentCategory->misc_fee->misc_amt,2)}}</td>
                <td class="td-center">
                    @if($Transaction_disc)
                        @foreach($Transaction_disc as $data)
                            {{$data->discountFee->disc_type}} {{number_format($data->discountFee->disc_amt,2)}}<br/>
                        @endforeach
                    @endif
                </td>
                <td class="td-center">{{number_format($Transaction->downpayment,2)}}</td>
                <td class="td-center">{{number_format($Transaction->downpayment,2)}}</td>
                <td class="td-center"> {{ number_format($Transaction->balance,2)}}</td>
                <td class="td-center">Paid</td>
            </tr>                
        </tbody>
    </table>



@endsection
@extends('control_panel.layouts.print_layout')

@section ('content_title')
    Invoice
@endsection

@section('content')
    

    <table class="table-student-info" style="margin-top: 50px">
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
                    <b>School Year</b> : {{ ucfirst($Transaction->school_year)}}
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
               
    <h3 style="text-align: center; margin-top: 50px">Summary Bill for Invoice</h3>
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
<div class="col-12">
    
    <h3>Payment History</h3>
        
    <table class="table table-bordered table-hover" style="margin-top: 20px">
        <thead>
            <tr>
                <th>OR Number</th>
                <th>For the Month</th>
                <th>Payment Fee</th>
                <th>Remarks</th>
                <th>Date</th>
            </tr>
        </thead>
        @if(!$TransactionMonthPaid)
            @foreach ($TransactionMonthPaid as $key => $item)
                <tr>
                    <td>{{ $item->or_no }}</td>
                    <td>{{ $item->month_paid }}</td>
                    <td>{{ number_format($item->payment, 2)}}</td>
                    <td><span class="label label-success">Paid</span></td>
                    <td>{{ date_format(date_create($item->created_at), 'F d, Y H:i:s') }}</td>
                </tr>
            @endforeach
        @else
        <th colspan="5" style="text-align: center">No payment history yet.</th>
        @endif
    </table>

    <h3>First Payment</h3>
    <table class="table table-bordered table-hover" style="margin-top: 20px">
        <thead>
            <tr>
                <th>OR Number</th>
                <th>Discount</th>
                <th>Downpayment</th>
                <th>Total Balance</th>
                <th>Remarks</th>
                <th>Date</th>
            </tr>
        </thead>        
        <tr>
            <td>{{ $Transaction->or_number }}</td>
            <td>
                @if($Transaction_disc)
                    @foreach($Transaction_disc as $data)
                        {{$data->discountFee->disc_type}} {{number_format($data->discountFee->disc_amt,2)}}<br/>
                    @endforeach
                @endif
            </td>
            <td>{{ number_format($Transaction->downpayment, 2)}}</td>
            <td>{{ number_format($Transaction->balance, 2) }}</td>
            <td><span class="label label-success">Paid</span></td>
            <td>{{ date_format(date_create($Transaction->created_at), 'F d, Y H:i:s') }}</td>
        </tr>       
    </table>

    <h3>Other Payment</h3>
    <table class="table table-bordered table-hover" style="margin-top: 20px">
        <thead>
            <tr>
                <th>OR Number</th>
                <th>Description</th>
                <th>Price</th>
                <th>total number</th>
                <th>Remarks</th>
                <th>Date</th>
            </tr>
        </thead>        
        <tr>
            <td></td>
            <td>
               
            </td>
            <td></td>
            <td></td>
            <td><span class="label label-success">Paid</span></td>
            <td></td>
        </tr>       
    </table>
    
    

</div>   
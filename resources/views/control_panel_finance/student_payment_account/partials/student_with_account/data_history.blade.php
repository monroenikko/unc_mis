<div class="col-12">
    
    <h3>Paid History</h3>
        
    @foreach ($TransactionMonthPaid as $key => $item)
         
        <div class="box box-danger">
            <div class="box-header">
                <div class="row">    
                    <div class="col-lg-6">
                        <h3 class="box-title">
                            OR Number: {{ $item->or_no }}
                        </h3>
                    </div>
                    <div class="col-lg-6" align="right">{{ date_format(date_create($item->created_at), 'F d, Y H:i:s') }}</div>
                </div>
            </div>
            <!-- /.box-header -->
                                      
                <div class="box-body no-padding">
                    <table class="table table-striped table-bordered">
                        <tbody>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th style="width: 50%">Description</th>
                                <th>Fee</th>
                            </tr>
                            
                            <tr>
                                <td>1.</td>
                                <td>Payment</td>
                                <td>
                                    {{ $item->payment }}
                                </td>                                              
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>Total Balance</td>
                                <td>
                                    {{ $Transaction->balance }}
                                </td>                                             
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>Remarks</td>
                                <td>                                                
                                    <span class="label label-success">Paid</span>
                                </td>                                              
                            </tr>
                        </tbody>
                    </table>
                </div>
           
            <!-- /.box-body -->
        </div>                    
    @endforeach
        <div class="box box-danger">
            <div class="box-header">  
                <div class="row">                                        
                    <div class="col-lg-6">
                        <h3 class="box-title">
                            OR Number: {{ $Transaction->or_number }}
                        </h3>
                    </div>
                    <div class="col-lg-6" align="right">{{ date_format(date_create($Transaction->created_at), 'F d, Y H:i:s') }}</div>
                </div>  
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-striped table-bordered">
                    <tbody>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th style="width: 50%">Description</th>
                            <th>Fee</th>
                        </tr>
                        <tr>
                            <td>1.</td>
                            <td>Discount</td>
                            <td>
                                @if($Transaction_disc)
                                    @foreach($Transaction_disc as $data)
                                        {{$data->discountFee->disc_type}} {{number_format($data->discountFee->disc_amt,2)}}<br/>
                                    @endforeach
                                @endif
                            </td>                                                
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Downpayment</td>
                            <td>
                                {{ number_format($Transaction->downpayment, 2) }}
                            </td>                                              
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Total Balance</td>
                            <td>
                                {{ number_format($Transaction->balance, 2) }}
                            </td>                                             
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Remarks</td>
                            <td>                                                
                                <span class="label label-success">Paid</span>
                            </td>                                              
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>

</div>   
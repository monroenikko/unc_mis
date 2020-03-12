<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog box box-danger" style="width: 80%" role="document">
        <div class="modal-content">
            <div class="box-body">
                {{-- <div class="modal-header"> --}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                            
                    <h4 style="margin-right: 5em;" class="modal-title">
                       Student Account
                    </h4>
                {{-- </div> --}}
            </div>     
            <div class="">
                <div class="col-lg-12" style="margin-top: 20px">
                    @include('control_panel_finance.student_information.partials.modal_data_list')
                </div>
                <div class="col-lg-12">        
                                
                    <div class="nav-tabs-custom"  style="box-shadow: 0 1px 1px 1px rgba(0,0,1,0.2);">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#bills" data-toggle="tab">Bills</a></li>
                            {{-- <li><a href="#balance" data-toggle="tab">Balance</a></li> --}}
                            <li><a href="#history" data-toggle="tab">History</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="bills">
                                <form id="js-form_payment_transaction">
                                    {{ csrf_field() }}
                                                    
                                    @if ($StudentInformation)
                                        <input type="hidden" name="id" value="{{ $StudentInformation->id }}">
                                        <input type="hidden" id='stud_status' name="stud_status" value="1">
                                        <input type="hidden" name="no_months_paid" value="{{$Transaction->no_month_paid}}" />                    
                                    @endif
                                    
                                    <div class="modal-body">                                        
                                        <div class="row">   
                                            <div class="col-lg-12">
                                                
                                                <h3 style="margin-bottom: 1em">Payment Category:</h3>
                                                <div class="row">

                                                    <div class="col-lg-6">
                                                        <h4>
                                                            <b>Student Category:</b> 
                                                            <i style="color: red">
                                                                <?php echo $Stud_cat_payment->student_category; echo -  $Payment->grade_level_id;?>
                                                            </i>
                                                        </h4>
                                                    
                                                        <h4>
                                                            <b>Tuition Fee:</b> 
                                                            <i style="color: red"> 
                                                                <?php echo number_format($Tuitionfee_payment->tuition_amt, 2); ?> 
                                                            </i>
                                                            <b>| Miscelleneous Fee:</b> 
                                                            <i style="color: red"> 
                                                                <?php echo number_format($MiscFee_payment->misc_amt,2); ?>
                                                            </i>
                                                        </h4>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <h4>
                                                            <b>Monthly Fee:</b>
                                                            <i style="color: red">
                                                                {{number_format($Transaction->monthly_fee,2)}}
                                                            </i>
                                                        </h4>
                                                        <h4>
                                                            <b>Total Balance:</b>
                                                            <i style="color: red">
                                                                {{number_format($Transaction->balance,2)}}
                                                            </i>
                                                            <input type="hidden" name="js_current_balance" id="js-current_balance" value="{{$Transaction->balance}}">
                                                        </h4>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            @include('control_panel_finance.student_information.partials.modal_account.modal_data')                        
                                        </div>
                    
                                        
                                        {{-- @include('csontrol_panel_finance.student_information.partials.modal_others') --}}
                                    </div>
                                
                                    </div>
                                </form>
                            
                            </div>
                            
                            {{-- <div class="tab-pane" id="balance">                        
                            
                            </div> --}}
                        
            
                            <div class="tab-pane" id="history">
                                <div class="">
                                    <h3>Paid History</h3>

                                        <div class="box box-danger">
                                            <div class="box-header">
                                            <h3 class="box-title">{{ date_format(date_create($Transaction->created_at), 'F d, Y H:i:s') }}</h3>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body no-padding">
                                                <table class="table table-striped table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <th style="width: 10px">#</th>
                                                            <th>Description</th>
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
                                                            <th>Description</th>
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
                            </div>                    
                        </div>                  
                    </div>    
                </div>           
            </div>
                   
            
            
             
           
            

                
             
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
            </div>
                
                
        </div><!-- /.modal-content -->
        
    </div><!-- /.modal-dialog -->
    
</div><!-- /.modal -->


<div class="nav-tabs-custom"  style="box-shadow: 0 1px 1px 1px rgba(0,0,1,0.2);">
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#bills" data-toggle="tab">Bills</a>
        </li>
        {{-- <li><a href="#balance" data-toggle="tab">Balance</a></li> --}}
        <li>
            <a class="js-history" href="#history" data-toggle="tab">History</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="active tab-pane" id="bills">            
                                
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
                        <div class="col-lg-8">                            
                            <div class="box box-danger box-solid">
                                <div class="box-header">
                                    <h3 class="box-title">Tuition Fee</h3>
                                </div>
                                <div class="box-body">
                                    <div class=""></div>
                                    <div class="form-group">
                                        <label>Month(s):</label>
                                        <select class="form-control  monthly_select" name="months" data-placeholder="Select month(s)" style="width: 100%;">
                                            <option value="">Select months</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                        </select>
                                        <div class="help-block text-red text-left" id="js-months"></div>
                                    </div>
                        
                                    <div class="form-group">
                                        <label for="">O.R. # </label>
                                        <input type="text" placeholder="00000000000" class="form-control" name="or_number_others" id="or_number_others" value="">
                                        <div class="help-block text-red text-left" id="js-or_number_others"></div>
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="">Payment </label>
                                        <input type="hidden" name="mo_fee" value="{{ number_format($Transaction->monthly_fee,2)}}" />
                                        <input placeholder="0.00" type="number" class="form-control" name="payment" id="payment" value="{{ $Transaction->monthly_fee }}">
                                        <div class="help-block text-red text-left" id="js-payment"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="box box-danger box-solid" style="height: 20.2em">
                                <div class="box-header">
                                <h3 class="box-title">Summary Bill for Invoice</h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-bordered table-invoice table-striped">
                                        <tbody>
                                            <tr>                       
                                                <tr>
                                                    <td style="width:140px">OR Number</td>
                                                    <td align="right" id="js-or_num_others"></td>
                                                </tr>                       
                                                <tr>
                                                    <td style="width:140px">Month</td>
                                                    <td align="right" id="js-month_others"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:140px">Monthly Fee</td>
                                                    <td align="right" id="js-monthly_fee_others">
                                                        {{ number_format($Transaction->monthly_fee, 2) }}
                                                    </td>
                                                </tr>
                                               
                                                
                                                <tr>
                                                    <td style="width:140px">Current Balance </td>
                                                    <td align="right">
                                                        ₱ <span id="js-current_bal">0</span>
                                                    </td>
                                                </tr>
                                            </tr>
                                        </tbody>
                        
                                    </table>
                                    
                                    <div class="form-group" align="right" style="margin-top: 20px">                
                                        <button type="submit" id="js-btn-save-monthly" data-id='1' class="btn btn-primary btn-flat">
                                            <i class="fas fa-save"></i> Save
                                        </button>
                                        <button type="button" 
                                                class="btn btn-danger btn-flat js-btn_print" 
                                                data-syid="{{$School_year_id->id}}"
                                                data-studid="{{ $StudentInformation->id }}"
                                        >
                                            <i class="fa fa-file-pdf"></i> Print
                                        </button>
                                    </div>                              
                            </div>                        
                        </div>
                    </div>

                    
                    {{-- @include('csontrol_panel_finance.student_information.partials.modal_others') --}}
                </div>
            
                </div>
            
        
        </div>
          

        <div class="tab-pane" id="history">
            <div class="">
            <h3>Payment History {{$hello}}</h3>
                
                @foreach ($TransactionMonthPaid as $key => $item)
                     
                    <div class="box box-danger">
                        <div class="box-header">
                        <div class="col-lg-6">
                            <h3 class="box-title">
                                OR Number: {{ $item->or_no }}
                            </h3>
                        </div>
                        <div class="col-lg-6" align="right">{{ date_format(date_create($item->created_at), 'F d, Y H:i:s') }}</div>
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
                                            <td>Payment</td>
                                            <td>
                                                {{ $item->payment }}
                                            </td>                                              
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>Total Balance</td>
                                            <td>
                                                {{ $Transaction->balan }}
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
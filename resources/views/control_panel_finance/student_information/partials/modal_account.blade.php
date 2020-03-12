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
                                
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#activity" data-toggle="tab">Bills</a></li>
                            <li><a href="#timeline" data-toggle="tab">Balance</a></li>
                            <li><a href="#settings" data-toggle="tab">History</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
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
                                        <hr>
                                        <div class="row">
                                            @include('control_panel_finance.student_information.partials.modal_account.modal_data')                        
                                        </div>
                    
                                        
                                        {{-- @include('csontrol_panel_finance.student_information.partials.modal_others') --}}
                                    </div>
                                
                                    </div>
                                </form>
                            
                            </div>
                            
                            <div class="tab-pane" id="timeline">                        
                            
                            </div>
                        
            
                            <div class="tab-pane" id="settings">
                            
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


<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog box box-danger" style="width: 80%" role="document">
        <div class="modal-content">
            <div class="box-body">
                <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                            
                        <h4 style="margin-right: 5em;" class="modal-title">
                            {{-- {{ $StudentInformation ? 'Edit Registrar Information' : 'Add Registrar Information' }} --}}
                            <img src="{{ asset('/img/unc-logo.png') }}" style="height: 70px;"> Student Account modal
                        </h4>
                </div>
            </div>            
            
           
            <form id="js-form_payment_transaction">
                {{ csrf_field() }}
                                
                @if ($StudentInformation)
                    <input type="hidden" name="id" value="{{ $StudentInformation->id }}">
                    <input type="hidden" name="stud_status" value="1">
                    <input type="hidden" name="no_months_paid" value="{{$Transaction->no_month_paid}}" />
                @endif
                
                <div class="modal-body">
                    
                    @include('control_panel_finance.student_information.partials.modal_data_list')        
                    <hr>
                    <div class="row ">   
                        <div class="col-lg-12">
                            <?php 
                                $payment =  \App\PaymentCategory::where('id', $Transaction->payment_category_id)->first();
                                $MiscFee_payment =  \App\MiscFee::where('id', $payment->misc_fee_id)->first();
                                $tuitionfee_payment =  \App\TuitionFee::where('id', $payment->tuition_fee_id)->first();
                                $stud_cat_payment =  \App\StudentCategory::where('id', $payment->student_category_id)->first();
                            ?>

                            <h3 style="margin-bottom: 1em">Payment Category:</h3>
                            
                            <h4>
                                <b>Student Category:</b> 
                                <i style="color: red">
                                    <?php echo $stud_cat_payment->student_category; echo -  $payment->grade_level_id;?>
                                </i>
                            </h4>
                            <h4>
                                <b>Tuition Fee:</b> 
                                <i style="color: red"> 
                                    <?php echo number_format($tuitionfee_payment->tuition_amt, 2); ?> 
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
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        @include('control_panel_finance.student_information.partials.modal_account.modal_data')                        
                    </div>

                    
                    {{-- @include('control_panel_finance.student_information.partials.modal_others') --}}
                     
            
                </div>
        
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    </div>
                </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
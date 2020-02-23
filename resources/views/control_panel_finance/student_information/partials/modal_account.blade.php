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
                    <div class="row invoice-info">
                        <div class="col-sm-3 invoice-col">
                            <label for="">Username:</label> 
                            <p style="margin-top: -5px">{{ $StudentInformation ? $StudentInformation->user->username : '' }}</p> 

                            <label for="">Name: </label>    
                            <p style="margin-top: -5px">{{ $StudentInformation ? $StudentInformation->last_name : '' }}, {{ $StudentInformation ? $StudentInformation->first_name : '' }} {{ $StudentInformation ? $StudentInformation->middle_name : '' }}</p>                    
                            
                            <label for="">Gender: </label>
                            <p style="margin-top: -5px">{{ $StudentInformation ? $StudentInformation->gender == 1 ? 'Male' : 'Female' : ''}}</p>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 invoice-col">
                            <label for="">Parent/Guardian: </label>
                            <p style="margin-top: -5px">{{ $StudentInformation ? $StudentInformation->guardian : '' }}</p>

                            <label for="">Date of Birth: </label>
                            <p style="margin-top: -5px">{{ $StudentInformation ? date_format(date_create($StudentInformation->birthdate), 'm/d/Y') : '' }}</p>

                            <label for="">Address: </label>
                            <p style="margin-top: -5px">{{ $StudentInformation ? $StudentInformation->c_address : '' }}</p>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 invoice-col">
                            <label for="">School Year: </label>
                            <p style="margin-top: -5px">{{ $SchoolYear->school_year }}</p>
                            {{-- <input type="hidden" name="school_year_id" value="{{ $SchoolYear->school_year_id }}"> --}}

                            <label for="">Payment Status: </label>
                            <p style="margin-top: -5px; color: red">Paid/not yet paid</p>
                            
                            {{-- <label for="">Address: </label>
                            <p style="margin-top: -5px">{{ $StudentInformation ? $StudentInformation->c_address : '' }}</p> --}}
                        </div>
                        <!-- /.col -->
                        <div align="center" class="col-sm-3 invoice-col ">
                            <div class="form-group">
                                @if ($Profile)
                                    <img class="profile-user-img img-responsive img-circle" id="img--user_photo" src="{{ $Profile->photo ? \File::exists(public_path('/img/account/photo/'.$Profile->photo)) ? asset('/img/account/photo/'.$Profile->photo) : asset('/img/account/photo/blank-user.gif') : asset('/img/account/photo/blank-user.gif') }}" style="width:150px; height:150px;  border-radius:50%;">
                                @else
                                    <img class="profile-user-img img-responsive img-circle" id="img--user_photo" src="{{  asset('/img/account/photo/blank-user.png') }}" style="width:150px; height:150px;  border-radius:50%;">
                                @endif
                            </div>
                        </div>
                    </div>        
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
                            
                            <h4><b>Student Category:</b> <i style="color: red"><?php echo $stud_cat_payment->student_category; echo -  $payment->grade_level_id;?></i></h4>
                            <h4><b>Tuition Fee:</b> <i style="color: red"> <?php echo number_format($tuitionfee_payment->tuition_amt, 2); ?> </i><b>| Miscelleneous Fee:</b> <i style="color: red"> <?php echo number_format($MiscFee_payment->misc_amt,2); ?></i></h4>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        @include('control_panel_finance.student_information.partials.modal_account.modal_data')
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <label>Other(s)</label>
                            <select class="form-control select2" name="others[]" multiple="multiple" data-placeholder="Select month(s)" style="width: 100%;">
                                @foreach ($OtherFee as $otherfee)                                        
                                    <option value="{{ $otherfee->id }}">{{ $otherfee->other_fee_name }} {{ number_format($otherfee->other_fee_amt) }}</option>
                                @endforeach
                            </select>
                            <div class="help-block text-red text-center" id="js-others">                            
                        </div>  
                        <div class="col-lg-6">
                            this is half right
                        </div>    
                    </div>
            
                </div>
        
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                        {{-- <button type="submit" class="btn btn-primary btn-flat">Save</button> --}}
                    </div>
                </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
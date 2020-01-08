<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog box box-danger" style="width: 1140px;" role="document">
        <div class="modal-content">
            <div class="box-body">
                <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                            
                        <h4 style="margin-right: 5em;" class="modal-title">
                            {{-- {{ $StudentInformation ? 'Edit Registrar Information' : 'Add Registrar Information' }} --}}
                            <img src="{{ asset('/img/unc-logo.png') }}" style="height: 70px;"> Student Account
                        </h4>
                </div>
            </div>

           
                
           
            <form id="js-form_payment_transaction">
                {{ csrf_field() }}
                                
                @if ($StudentInformation)
                    <input type="hidden" name="id" value="{{ $StudentInformation->id }}">
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
               
                
                    <div class="row">
                        <div class="col-md-8 col-sm-8">
                            <div class="form-group">
                                <label for="">Student Category</label>
                                <select name="payment_category" id="payment_category" class="form-control">
                                    <option value="">Select Student Category</option>                                    
                                    @foreach($PaymentCategory as $p_cat)
                                        <option value="{{$p_cat->id}}">{{$p_cat->stud_category->student_category}} {{$p_cat->grade_level_id}} - Tuition Fee: {{ number_format($p_cat->tuition->tuition_amt, 2) }} | Miscelleneous Fee {{ number_format($p_cat->misc_fee->misc_amt, 2) }}</option>                    
                                    @endforeach
                                </select>
                                <div class="help-block text-red text-center" id="js-payment_category">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label for="">Discount: </label>
                                <select name="discount" id="discount" class="form-control">
                                    <option value="">Select Discount Fee</option>
                                    @foreach($Discount as $disc_fee)
                                        <option value="{{$disc_fee->id}}">{{$disc_fee->disc_type}} {{number_format($disc_fee->disc_amt)}}</option>                    
                                    @endforeach
                                </select>
                                <div class="help-block text-red text-center" id="js-discount">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        @foreach ($OtherFee as $otherfee)
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label for="">{{ $otherfee->other_fee_name }} </label>
<<<<<<< HEAD
                                    <select name="others[]" id="others" class="form-control">
=======
                                    <select name="others[]" class="form-control">
>>>>>>> a65d06c7c07a384451462079721ebba41f371188
                                        <option value="">Select {{ $otherfee->other_fee_name }}</option>
                                        {{-- @foreach($OtherFee as $others) --}}
                                            <option value="{{ $otherfee->id }}">{{ $otherfee->other_fee_name }} {{ number_format($otherfee->other_fee_amt) }}</option>                    
                                        {{-- @endforeach --}}
                                    </select>
                                    <div class="help-block text-red text-center" id="js-{{ $otherfee->other_fee_name }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label>Multiple</label>
                                <select class="form-control select2" multiple="multiple" data-placeholder="Select a State"
                                        style="width: 100%;">
                                  <option>Alabama</option>
                                  <option>Alaska</option>
                                  <option>California</option>
                                  <option>Delaware</option>
                                  <option>Tennessee</option>
                                  <option>Texas</option>
                                  <option>Washington</option>
                                </select>
                              </div>
                        </div> --}}
                    </div>
                    <hr>
                    <div class="row">                        
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="">O.R. # </label>
                                <input type="text" placeholder="00000000000" class="form-control" name="or_number" id="or_number" value="">
                                <div class="help-block text-red text-center" id="js-or_number"></div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="">Downpayment </label>
                                <input placeholder="0.00" type="number" class="form-control" name="downpayment" id="downpayment" value="">
                                <div class="help-block text-red text-center" id="js-downpayment"></div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="">From</label>
                                <select name="from_months" id="from_months" class="form-control">
                                    <option value="">Select months</option>
                                    <option value="1" >June</option>
                                    <option value="2" >July</option>
                                    <option value="3" >August</option>
                                    <option value="4" >September</option>
                                    <option value="5" >October</option>
                                    <option value="6" >November</option>
                                    <option value="7" >December</option>
                                    <option value="8" >January</option>
                                    <option value="9" >February</option>
                                    <option value="10" >March</option>
                                </select>
                                <div class="help-block text-red text-center" id="js-from_months">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="">To</label>
                                <select name="to_months" id="to_months" class="form-control">
                                    <option value="0">Select months</option>
                                    <option value="1" >June</option>
                                    <option value="2" >July</option>
                                    <option value="3" >August</option>
                                    <option value="4" >September</option>
                                    <option value="5" >October</option>
                                    <option value="6" >November</option>
                                    <option value="7" >December</option>
                                    <option value="8" >January</option>
                                    <option value="9" >February</option>
                                    <option value="10" >March</option>
                                </select>
                                <div class="help-block text-red text-center" id="js-to_months">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="">&nbsp; </label><br>
                                <button type="submit" class="btn btn-primary btn-flat pull-right">Save</button>
                            </div>
                        </div>
                        
                    </div>
                
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Summary Bill for Invoice</h2>
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col">Month</th>
                                    <th scope="col">Monthly</th>
                                    <th scope="col">Collection</th>
                                    <th scope="col">Other</th>
                                    <th scope="col">Balance</th>
                                    <th scope="col">Remarks</th>
                                  </tr>
                                </thead>
                                <tbody>
                               
                                  <tr>
                                    <td>&nbps;</td>
                                    <td>&nbps;</td>
                                    <td>&nbps;</td>
                                    <td>&nbps;</td>
                                    <td>&nbps;</td>
                                    <td>&nbps;</td>
                                  </tr>
                                
                                  <tr>
                                    <td>&nbps;</td>
                                    <td>&nbps;</td>
                                    <td>&nbps;</td>
                                    <td>&nbps;</td>
                                    <td>&nbps;</td>
                                    <td>&nbps;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbps;</td>
                                    <td>&nbps;</td>
                                    <td>&nbps;</td>
                                    <td>&nbps;</td>
                                    <td>&nbps;</td>
                                    <td>&nbps;</td>
                                  </tr>
                                </tbody>
                            </table>
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
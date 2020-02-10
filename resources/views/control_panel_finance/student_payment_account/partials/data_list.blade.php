                    
       
        <form id="js-form_payment_transaction">
            {{ csrf_field() }}
                            
            @if ($StudentInformation)
                <input type="hidden" name="id" value="{{ $StudentInformation->id }}">
                <input type="hidden" name="stud_status" value="1">
                {{-- <input type="hidden" name="no_months_paid" value="{{$Transaction->no_month_paid}}" /> --}}
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
                    
                    <div class="col-sm-3 invoice-col">
                        <label for="">Parent/Guardian: </label>
                        <p style="margin-top: -5px">{{ $StudentInformation ? $StudentInformation->guardian : '' }}</p>

                        <label for="">Date of Birth: </label>
                        <p style="margin-top: -5px">{{ $StudentInformation ? date_format(date_create($StudentInformation->birthdate), 'm/d/Y') : '' }}</p>

                        <label for="">Address: </label>
                        <p style="margin-top: -5px">{{ $StudentInformation ? $StudentInformation->c_address : '' }}</p>
                    </div>
                    
                    <div class="col-sm-3 invoice-col">
                        <label for="">School Year: </label>
                        {{-- <p style="margin-top: -5px">{{ $SchoolYear->school_year }}</p> --}}
                        

                        <label for="">Payment Status: </label>
                        <p style="margin-top: -5px; color: red">Paid/not yet paid</p>
                        
                        
                    </div>
                    
                    {{-- <div align="center" class="col-sm-3 invoice-col ">
                        <div class="form-group">
                            @if ($Profile)
                                <img class="profile-user-img img-responsive img-circle" id="img--user_photo" src="{{ $Profile->photo ? \File::exists(public_path('/img/account/photo/'.$Profile->photo)) ? asset('/img/account/photo/'.$Profile->photo) : asset('/img/account/photo/blank-user.gif') : asset('/img/account/photo/blank-user.gif') }}" style="width:150px; height:150px;  border-radius:50%;">
                            @else
                                <img class="profile-user-img img-responsive img-circle" id="img--user_photo" src="{{  asset('/img/account/photo/blank-user.png') }}" style="width:150px; height:150px;  border-radius:50%;">
                            @endif
                        </div>
                    </div> --}}
                </div>        
            <hr>
                <div class="row">   
                    <div class="container">
                        
                        <h3 style="margin-bottom: 1em">Payment Category:</h3>
                       
                    </div>
                </div>
        <hr>
                <div class="row">   
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Month(s):</label>
                            <select class="form-control select2" name="months[]" multiple="multiple" data-placeholder="Select month(s)" style="width: 100%;">
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
                        </div> 
                    </div>                             
                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="">O.R. # </label>
                            <input type="text" placeholder="00000000000" class="form-control" name="or_number" id="or_number" value="">
                            <div class="help-block text-red text-center" id="js-or_number"></div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="">Payment </label>
                            <input placeholder="0.00" type="number" class="form-control" name="payment" id="payment" value="">
                            <div class="help-block text-red text-center" id="js-payment"></div>
                        </div>
                    </div>   
                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label>Other(s)</label>
                            <select class="form-control select2" name="others[]" multiple="multiple" data-placeholder="Select Other" style="width: 100%;">
                                    <option>Select Others</option>
                                    {{-- @foreach ($OtherFee as $otherfee)                                        
                                        <option value="{{ $otherfee->id }}">{{ $otherfee->other_fee_name }} {{ number_format($otherfee->other_fee_amt) }}</option>
                                    @endforeach --}}
                            </select>
                            <div class="help-block text-red text-center" id="js-others">
                        </div>
                    </div>                     
                </div>
                
                <div class="row">
                    <div class="container">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="">&nbsp; </label><br>
                                <button type="submit" class="btn btn-primary btn-flat pull-right">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            
                <hr>
                <div class="row">
                    <div class="container">
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                
            </div>
        </form>
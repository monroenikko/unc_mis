<div class="col-lg-8">                            
    <div class="box box-danger box-solid">
        <div class="box-header">
            <h3 class="box-title">Tuition Fee</h3>
        </div>
        <div class="box-body">
            <div class=""></div>
            <div class="form-group">
                <label>Month(s):</label>
                <select class="form-control select2 monthly_select" name="months[]" multiple="multiple" data-placeholder="Select month(s)" style="width: 100%;">
                    <option value="">Select months</option>
                    <option value="2">July</option>
                    <option value="3">August</option>
                    <option value="4">September</option>
                    <option value="5">October</option>
                    <option value="6">November</option>
                    <option value="7">December</option>
                    <option value="8">January</option>
                    <option value="9">February</option>
                    <option value="10">March</option>
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
                <input placeholder="0.00" type="number" class="form-control" name="payment" id="payment" value="{{ $Transaction->monthly_fee }}">
                <div class="help-block text-red text-left" id="js-payment"></div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="box box-danger box-solid">
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
                                {{ $Transaction->monthly_fee }}
                            </td>
                        </tr>
                        
                        {{-- <tr>
                            <td style="width:140px">Downpayment </td>
                            <td>
                                ₱ <span id="downpayment_reserved">0</span>
                            </td>
                        </tr> --}}
                        
                        {{-- <tr>
                            <td style="width:140px">Total Bill </td>
                            <td>
                                ₱ <span id="total_costt2">0</span>
                            </td>
                        </tr> --}}
                        
                        <tr>
                            <td style="width:140px">Total Balance </td>
                            <td align="right">
                                ₱ <span id="total_balance">0</span>
                            </td>
                        </tr>
                    </tr>
                </tbody>

            </table>
            
            <div class="form-group" align="right">                
                <button type="submit" id="js-btn-save-monthly" data-id='1' class="btn btn-primary btn-flat">
                    <i class="fas fa-save"></i> Save
                </button>
                <button type="button" 
                        class="btn btn-danger btn-flat" 
                        id="js-btn_print" 
                        data-syid="{{$School_year_id->id}}"
                        data-studid="{{ $StudentInformation->id }}"
                >
                    <i class="fa fa-file-pdf"></i> Print
                </button>
            </div>                              
    </div>                        
</div>
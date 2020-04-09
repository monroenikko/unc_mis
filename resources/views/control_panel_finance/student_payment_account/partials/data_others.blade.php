<div class="row">
    <div class="col-lg-8">
        <div class="box box-danger box-solid" style="height: 16em;">
            <div class="box-header">
                <h3 class="box-title">Other(s)</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label for="">O.R. # </label>
                    <input type="text" placeholder="00000000000" class="form-control" name="or_number_others" id="or_number_others" value="">
                    <div class="help-block text-red text-left" id="js-or_number_others"></div>
                </div>
    
                <label>Other(s)</label>
                <select class="form-control select2" name="others[]" multiple="multiple" data-placeholder="Select other(s)" style="width: 100%;">
                    @foreach ($OtherFee as $otherfee)                                        
                        <option value="{{ $otherfee->id }}">{{ $otherfee->other_fee_name }} {{ number_format($otherfee->other_fee_amt) }}</option>
                    @endforeach
                </select>
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
                                <td style="width:140px">Description</td>
                                <td align="right" id="js-month"></td>
                            </tr>                                        
                            <tr>
                                <td style="width:140px">Total</td>
                                <td align="right">
                                    ₱ <span id="total_balance">0</span>
                                </td>
                            </tr>
                        </tr>
                    </tbody>
    
                </table>
                
                <div class="form-group" align="right">                
                    <button type="submit" id="js-btn-others-save" data-id='1' class="btn btn-primary btn-flat">
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
    </div>
</div>
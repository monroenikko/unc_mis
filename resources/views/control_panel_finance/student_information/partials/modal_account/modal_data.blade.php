<div class="col-lg-8">                            
    <div class="box box-danger box-solid">
        <div class="box-header">
            <h3 class="box-title">Input field(s)</h3>
        </div>
        <div class="box-body">
            <div class=""></div>
            <div class="form-group">
                <label>Month(s):</label>
                <select class="form-control select2" name="months[]" multiple="multiple" data-placeholder="Select month(s)" style="width: 100%;">
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
            </div>

            <div class="form-group">
                <label for="">O.R. # </label>
                <input type="text" placeholder="00000000000" class="form-control" name="or_number" id="or_number" value="">
                <div class="help-block text-red text-left" id="js-or_number"></div>
            </div>
        
            <div class="form-group">
                <label for="">Payment </label>
                <input placeholder="0.00" type="number" class="form-control" name="payment" id="payment" value="">
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
                            <td id="result_rsvn_no1"></td>
                        </tr>                       
                        <tr>
                            <td style="width:140px">Month</td>
                            <td id="arrivaldate"></td>
                        </tr>
                        <tr>
                            <td style="width:140px">Monthly Fee</td>
                            <td id="departuredate"></td>
                        </tr>
                        <tr>
                            <td style="width:140px">Collection</td>
                            <td id="result2">0</td>
                        </tr>
                        <tr>
                            <td style="width:140px">Downpayment </td>
                            <td>
                                ₱ <span id="downpayment_reserved">0</span>
                            </td>
                        </tr>
                        
                        {{-- <tr>
                            <td style="width:140px">Total Bill </td>
                            <td>
                                ₱ <span id="total_costt2">0</span>
                            </td>
                        </tr> --}}
                        
                        <tr>
                            <td style="width:140px">Total Balance </td>
                            <td>
                                ₱ <span id="total_balance">0</span>
                            </td>
                        </tr>
                    </tr>
                </tbody>

            </table>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-flat pull-right">Add</button>
            </div>  
       
                               
    </div>                        
</div>
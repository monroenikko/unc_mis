<div class="col-lg-8">                            
    <div class="box box-danger box-solid">
        <div class="box-header">
            <h3 class="box-title">Input field(s)</h3>
        </div>
        
        <div class="box-body">
            <div class="form-group">
                <label for="">O.R. # </label>
                <input type="text" placeholder="00000000000" class="form-control" name="or_number" id="or_number" value="">
                <div class="help-block text-red text-left" id="js-or_number"></div>
            </div>
            <div class="form-group">
                <label for="">Downpayment </label>
                <input placeholder="0.00" type="number" class="form-control" name="downpayment" id="downpayment" value="">
                <div class="help-block text-red text-left" id="js-downpayment"></div>
            </div>
            <div class="form-group">
                <label for="">Student Category</label>
               
                <select name="payment_category" id="payment_category" class="form-control">
                    <option value="">Select Student Category</option>                                    
                    @foreach($PaymentCategory as $p_cat)
                        <option value="{{$p_cat->id}}" 
                                data-gradelvl="{{$p_cat->grade_level_id}}" 
                                data-tuition="{{ $p_cat->tuition->tuition_amt }}"
                                data-misc="{{ $p_cat->misc_fee->misc_amt }}"
                        >
                            {{$p_cat->stud_category->student_category}} {{$p_cat->grade_level_id}} - Tuition Fee: {{ number_format($p_cat->tuition->tuition_amt, 2) }} 
                            | Miscelleneous Fee {{ number_format($p_cat->misc_fee->misc_amt, 2) }}
                        </option>                    
                    @endforeach
                </select>
                <div class="help-block text-red text-left" id="js-payment_category">
                </div>
            </div>
            <div class="form-group">
                <label for="">Discount: </label>
                <select name="discount[]" id="discount" class="form-control select2 discountSelected" multiple="multiple" data-placeholder="Select Discount" style="width: 100%;">
                    <option value="">Select Discount Fee</option>
                    @foreach($Discount as $disc_fee)
                        <option value="{{$disc_fee->id}}"
                                data-type="{{$disc_fee->disc_type}}" 
                                data-fee="{{$disc_fee->disc_amt}}"
                        >
                            {{$disc_fee->disc_type}} {{number_format($disc_fee->disc_amt)}}
                        </option>                    
                    @endforeach
                </select>
                <div class="help-block text-red text-left" id="js-discount">
                </div>
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
            <table class="table table-bordered table-invoice ">
                <tbody>
                    <tr>                       
                        <tr>
                            <td style="width:140px">OR Number</td>
                            <td align="right" id="or_num">00000000</td>
                        </tr>
                        <tr>
                            <td style="width:140px">Downpayment </td>
                            <td align="right">
                                ₱ <span id="dp_enrollment">0</span>
                            </td>
                        </tr>
                        
                        <tr>
                            <td style="width:140px">Tuition Fee</td>
                            <td align="right" id="tuition_fee"></td>
                        </tr>
                        <tr>
                            <td style="width:140px">Misc Fee</td>
                            <td align="right" id="misc_fee"></td>
                        </tr>
                        <tr >
                            <td style="width:140px">Discount</td>
                            <td id="disc_amt" align="right">0</td>
                        </tr>                       
                                               
                        <tr>
                            <td style="width:140px">Total Balance</td>
                            <td align="right">
                                ₱ <span id="total_balance">0</span>
                            </td>
                        </tr>
                        {{-- <tr>
                            <td style="width:140px">Total Bill </td>
                            <td align="right">
                                ₱ <span id="total_costt2">0</span>
                            </td>
                        </tr>  --}}
                    </tr>
                </tbody>

            </table>
            
            
            <hr>
            <div class="form-group" align="right">                
                <button type="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i> Save</button>
                <button type="button" class="btn btn-danger btn-flat" id="js-btn_print" data-or="" data-id="{{ $StudentInformation->id }}">
                    <i class="fa fa-file-pdf"></i> Print
                </button>
            </div>  
          
                               
    </div>                        
</div>
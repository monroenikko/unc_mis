<div class="row">   
    <div class="col-lg-12">                
        <h3 style="margin-bottom: .5em">Payment Category:</h3>
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
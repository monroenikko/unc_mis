
    @include('control_panel_finance.student_payment_account.partials.student_with_account.data_status')
    
    <div style="margin-botton: 100px">
        <button type="button" class="pull-right btn btn-flat btn-primary btn-md" data-id="{{ $StudentInformation->id }}" id="js-button-payment">
            <i class="fas fa-money-bill-alt"></i> Payment
        </button>
            
        @include('control_panel_finance.student_payment_account.partials.student_with_account.data_history')                     
    </div>


    @include('control_panel_finance.student_payment_account.partials.student_with_account.data_status')
    
    <div style="margin-botton: 100px">
        <button type="button" class="pull-right btn btn-flat btn-primary btn-md" data-id="{{ $StudentInformation->id }}" id="js-button-payment">
            <i class="fas fa-money-bill-alt"></i> Payment
        </button>
            
        <div class="nav-tabs-custom"  style="box-shadow: 0 1px 1px 1px rgba(0,0,1,0.2); margin-top: 20px">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#history" data-toggle="tab">History</a>
                </li>
                <li>
                    <a href="#others-history" data-toggle="tab">Others</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="active tab-pane" id="history">
                    @include('control_panel_finance.student_payment_account.partials.student_with_account.data_history')   
                </div>
                
                <div class="tab-pane" id="others-history">
                    <h3>Other Payment</h3>
                    <table class="table table-bordered table-hover table-striped" style="margin-top: 20px">
                        <thead>
                            <tr>
                                <th>OR Number</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Remarks</th>
                                <th>Date</th>
                            </tr>
                        </thead>        
                        <tr>
                            <td></td>
                            <td>
                            
                            </td>
                            <td></td>
                            <td></td>
                            <td>
                                {{-- <span class="label label-success">Paid</span> --}}
                            </td>
                            <td></td>
                        </tr>       
                    </table>
                </div>
            </div>
        </div>
                       
    </div>

<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog box box-danger" style="width: 1140px;" role="document">
        <div class="modal-content">
            <div class="box-body">
                {{-- <div class="modal-header"> --}}
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                            
                        <h4 style="margin-right: 5em;" class="modal-title">
                            {{-- {{ $StudentInformation ? 'Edit Registrar Information' : 'Add Registrar Information' }} --}}
                            <img src="{{ asset('/img/unc-logo.png') }}" style="height: 70px;"> Student Account
                        </h4>
                {{-- </div> --}}
            </div>
            
           
            <form id="js-form_payment_transaction">
                {{ csrf_field() }}
                                
                @if ($StudentInformation)
                    <input type="hidden" name="id" value="{{ $StudentInformation->id }}">
                    <input type="hidden" id='stud_status' name="stud_status" value="0">
                @endif
                
                <div class="modal-body">
                        @include('control_panel_finance.student_information.partials.modal_data_list')  
                    <hr>               
                    <div class="row">
                        @include('control_panel_finance.student_information.partials.modal_enroll.modal_data')
                    </div>   

                    <hr>

                    {{-- @include('control_panel_finance.student_information.partials.modal_others')          --}}
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    {{-- <button type="submit" class="btn btn-primary btn-flat">Save</button> --}}
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
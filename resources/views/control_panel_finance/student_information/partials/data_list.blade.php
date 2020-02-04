                        <div class="pull-right">
                            {{ $StudentInformation ? $StudentInformation->links() : '' }}
                        </div>
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Gender</th>
                                    <th>Payment Status</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($StudentInformation)
                                    @foreach ($StudentInformation as $data)
                                        <tr>
                                            <td>{{ $data->last_name . ' ' .$data->first_name . ' ' . $data->middle_name }}</td>
                                            <td>{{ $data->user->username }}</td>
                                            <td>{{ ($data->gender == 1 ? 'Male' : 'Female') }}</td>
                                            <td style="color: red">{{ $data->status == 1 ? 'Paid' : 'Not Paid' }}<span class="label label-success">Paid</span></td>
                                            <td>{{ $data->status == 1 ? 'Active' : 'Inactive' }}</td>
                                            <td>
                                                <div class="input-group-btn pull-left text-left">
                                                    @if(!$Transaction)        
                                                         
                                                        <a href="{{route('finance.student_payment_account', $data->id)}}" class="btn btn-flat btn-primary btn-sm" data-id="{{ $data->id }}">Account</a>                                            
                                                        <a href="#" class="js-btn_account btn btn-flat btn-primary btn-sm" data-id="{{ $data->id }}">Account</a>                                                                                                            
                                                    @else
                                                        <a href="#"  class="js-btn_account_modal btn btn-flat btn-primary btn-sm" data-id="{{ $data->id }}">Account</a>
                                                    @endif
                                                    <a href="#" style="margin-left: 1em" class="js-btn_account_modal btn btn-flat btn-success btn-sm" data-id="{{ $data->id }}">Balance</a>  
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
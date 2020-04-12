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
                                            <td style="color: red">
                                                @if($data->transactions)
                                                    @if($data->transactions->school_year_id == $School_year_id)
                                                        <span class="label {{ $data->transactions->status == 0 ? 'label-success' : 'label-danger' }}">
                                                            {{ $data->transactions->status == 0 ? 'Paid' : 'Not-Paid' }}
                                                        </span>
                                                    @else
                                                        <span class="label label-danger">
                                                            Not-Paid
                                                        </span> 
                                                    @endif
                                                @else
                                                    <span class="label label-danger">
                                                       Not-Paid
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge {{ $data->status == 1 ? 'bg-green' : 'bg-red' }}">
                                                    {{ $data->status == 1 ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="input-group-btn pull-left text-left">
                                                    @if(!$Transaction)                                                                 
                                                        <a href="{{ route('finance.student_payment_account') }}?c={{ encrypt($data->id) }}" data-id="{{ encrypt($data->id) }}" class="btn btn-flat btn-primary btn-sm">
                                                            Account
                                                        </a>   
                                                    @endif                                                    
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
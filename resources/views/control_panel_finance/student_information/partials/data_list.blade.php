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
                                                <span class="label {{ $data->status == 1 ? 'label-success' : 'label-danger' }}">{{ $data->status == 1 ? 'Paid' : 'Not-Paid' }}</span>
                                            </td>
                                            <td>
                                                <span class="badge {{ $data->status == 1 ? 'bg-green' : 'bg-red' }}">{{ $data->status == 1 ? 'Active' : 'Inactive' }}</span>
                                            </td>
                                            <td>
                                                <div class="input-group-btn pull-left text-left">

                                                    {{-- @if(!$Transaction)                                                                  --}}
                                                        <a href="{{route('finance.student_payment_account', $data->id)}}"  data-id="{{ $data->id }}" class="btn btn-flat btn-primary btn-sm">Account</a>                                            
                                                        {{-- <a href="#" class="js-btn_account btn btn-flat btn-primary btn-sm" data-id="{{ $data->id }}">Account</a>                                                                                                             --}}
                                                    {{-- @else
                                                        <a href="{{route('finance.student_payment_account', $data->id)}}"  data-id="{{ $data->id }} "class="btn btn-flat btn-primary btn-sm">Account</a> --}}
                                                        {{-- <a href="{{ route('finance.student_payment', $data->id) }}" data-id="{{ $data->id }}" class="btn btn-flat btn-primary btn-sm">Account</a> --}}
                                                        {{-- <a href="#"  class="js-btn_account_modal btn btn-flat btn-primary btn-sm" data-id="{{ $data->id }}">Account</a> --}}
                                                    {{-- @endif --}}
                                                    <a href="#" style="margin-left: 1em" class="js-btn_account_modal btn btn-flat btn-success btn-sm" data-id="{{ $data->id }}">Balance</a>  
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
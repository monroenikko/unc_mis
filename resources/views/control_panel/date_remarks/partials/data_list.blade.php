                        <div class="pull-right">
                            {{-- {{ $SchoolYear ? $SchoolYear->links() : '' }} --}}
                        </div>
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>School Year</th>
                                    <th>Date for Junior</th>
                                    <th>Date for Senior 1st sem</th>
                                    <th>Date for Senior 2nd sem</th>
                                    {{-- <th>Current</th> --}}
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($SchoolYear)
                                    @foreach ($SchoolYear as $data)
                                        <tr>
                                            {{-- <td>{{ $data->school_year }}</td> --}}
                                            <td>
                                                {{ $data->school_year }}
                                            </td>
                                            <td>{{ $data->j_date }}</td>
                                            <td>{{ $data->s_date1 }}</td>
                                            <td>{{ $data->s_date2 }}</td>
                                            <td>{{ $data->status == 1 ? 'Active' : 'Inactive' }}</td>
                                            {{-- <td></td> --}}
                                            {{-- <td>{{ $data->current == 1 ? 'Yes' : 'No' }}</td>
                                            <td></td> --}}
                                            <td>
                                                <div class="input-group-btn pull-left text-left">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                                                        <span class="fa fa-caret-down"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#" class="js-btn_update_sy" data-id="{{ $data->id }}">Edit</a></li>
                                                        <li><a href="#" class="js-btn_deactivate" data-id="{{ $data->id }}">Deactivate</a></li>
                                                        {{-- <li><a href="#" class="js-btn_toggle_current" data-id="{{ $data->id }}" data-toggle_title="{{ ( $data->current ? 'Remove from current active' : 'Add to current active' ) }}">{{ ( $data->current ? 'Remove from current Active' : 'Add to current Active' ) }}</a></li> --}}
                                                    </ul>>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
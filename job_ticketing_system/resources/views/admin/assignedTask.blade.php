@extends('layouts.admin-layout')

@section('content')
    <title>IT Personnel: Assigned Task</title>

    <div class="py-12 d-flex justify-content-center">
        <div class="container">
            <div class="card">
                <div class="card-body table-responsive">
                    <div class="circle-icons" style="justify-content: space-between;">
                        <b>Void:</b> <i class="fa-solid fa-circle" style="color: #303030;"></i>
                        <b>| Processing:</b> <i class="fa-solid fa-circle" style="color: #ffb005;"></i>
                        <b>| Released:</b> <i class="fa-solid fa-circle" style="color: #b50000;"></i>
                    </div>
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <div class="filter-status">
                                <label for="status-filter">Filter Status:</label>
                                <select id="status-filter">
                                    <option value="" selected disabled>Select Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Released">Released</option>
                                    <option value="Voided">Voided</option>
                                </select>
                            </div>
                            <tr>
                                <th>Department</th>
                                <th>Problem</th>
                                <th>Noted</th>
                                <th>Timestamp</th>
                                <th>Date Received</th>
                                <th>Date Started</th>
                                <th>Date Released</th>
                                <th>Transaction No.</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @if ($Jobinfos->isEmpty())
                                <tr>
                                    <td colspan="9" class="text-center">
                                        <p>Nice! looks like you've done everything.</p>
                                    </td>
                                </tr>
                            @else
                                @foreach ($Jobinfos as $Jobinfo)
                                    <tr class="status-{{ ($Jobinfo->status) }}">
                                        <td class="truncate">{{ $Jobinfo->department }}</td>
                                        <td class="truncate">{{ $Jobinfo->problem_statement }}</td>
                                        <td class="truncate">{{ $Jobinfo->remarks }}</td>
                                        <td class="truncate" id="timestamp-{{ $Jobinfo->id }}">{{ $Jobinfo->created_at }}
                                        </td>
                                        <td class="truncate">{{ $Jobinfo->created_at }}</td>
                                        <td class="truncate">{{ $Jobinfo->datetime_started }}</td>
                                        <td class="truncate">{{ $Jobinfo->datetime_accomplished }}</td>
                                        <td class="truncate">{{ $Jobinfo->transaction_code }}</td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            @if ($Jobinfo->status == 'Voided')
                                                <i class="fa-solid fa-circle" style="color: #303030;"></i>
                                            @elseif ($Jobinfo->status == 'Released')
                                                <i class="fa-solid fa-circle" style="color: #b50000;"></i>
                                            @elseif ($Jobinfo->status == 'Pending')
                                                <i class="fa-solid fa-circle" style="color: #ffb005;"></i>
                                            @else
                                                {{ $Jobinfo->status }}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#viewTaskModal{{ $Jobinfo->id }}"><i
                                                        class="fa-solid fa-eye fa-xl" style="color: #306ed9;"></i></a>
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#editTaskModal{{ $Jobinfo->id }}"><i
                                                        class="fa-solid fa-pen-to-square fa-xl"
                                                        style="color: #31b003;"></i></a>
                                                <a href="{{ route('admin.preview', $Jobinfo->id) }}"><i
                                                        class="fa-solid fa-file-pdf fa-xl" style="color: #f39120;"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach ($Jobinfos as $Jobinfo)
        {{-- Modal for Viewing Task --}}
        <div class="modal fade" id="viewTaskModal{{ $Jobinfo->id }}" tabindex="-1"
            aria-labelledby="viewTaskModalLabel{{ $Jobinfo->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewTaskModalLabel{{ $Jobinfo->id }}">Preview</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="transaction_code{{ $Jobinfo->id }}" class="form-label">Transaction
                                    No.:</label>
                                <input type="text" name="transaction_code" class=""
                                    id="transaction_code{{ $Jobinfo->id }}" value="{{ $Jobinfo->transaction_code }}"
                                    readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="status{{ $Jobinfo->id }}" class="form-label">Status:</label>
                                <input type="text" name="status" class="" id="status{{ $Jobinfo->id }}"
                                    value="{{ $Jobinfo->status }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name{{ $Jobinfo->id }}" class="form-label">Name:</label>
                                <input type="text" name="name" class="" id="name{{ $Jobinfo->id }}"
                                    value="{{ $Jobinfo->name }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="contact_number{{ $Jobinfo->id }}" class="form-label">Contact No.:</label>
                                <input type="text" name="contact_number" class=""
                                    id="contact_number{{ $Jobinfo->id }}" value="{{ $Jobinfo->number }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email{{ $Jobinfo->id }}" class="form-label">Email:</label>
                                <input type="text" name="email" class="" id="email{{ $Jobinfo->id }}"
                                    value="{{ $Jobinfo->email }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="department{{ $Jobinfo->id }}" class="form-label">Department:</label>
                                <input type="text" name="department" class=""
                                    id="department{{ $Jobinfo->id }}" value="{{ $Jobinfo->department }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="datetime_accomplished{{ $Jobinfo->id }}" class="form-label">Date
                                    Accomplished:</label>
                                <input type="text" name="datetime_accomplished" class=""
                                    id="datetime_accomplished{{ $Jobinfo->id }}"
                                    value="{{ $Jobinfo->datetime_accomplished }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="datetime_started{{ $Jobinfo->id }}" class="form-label">Date Started:</label>
                                <input type="text" name="datetime_started" class=""
                                    id="datetime_started{{ $Jobinfo->id }}" value="{{ $Jobinfo->datetime_started }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="problem_statement{{ $Jobinfo->id }}"
                                    class="form-label">Issue/Request:</label>
                                <input type="text" name="problem_statement" class=""
                                    id="problem_statement{{ $Jobinfo->id }}" value="{{ $Jobinfo->problem_statement }}"
                                    readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="no_units{{ $Jobinfo->id }}" class="form-label">No. of Units:</label>
                                <input name="no_units" id="no_units{{ $Jobinfo->id }}" class=""
                                    value="{{ $Jobinfo->no_units }}" readonly></input>
                            </div>
                            <div class="col-md-6">
                                <label for="remarks{{ $Jobinfo->id }}" class="form-label">Note:</label>
                                <input name="remarks" id="remarks{{ $Jobinfo->id }}" class=""
                                    value="{{ $Jobinfo->remarks }}" readonly></input>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal for Editing Task --}}
        <div class="modal fade" id="editTaskModal{{ $Jobinfo->id }}" tabindex="-1"
            aria-labelledby="editTaskModalLabel{{ $Jobinfo->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTaskModalLabel{{ $Jobinfo->id }}">Edit Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('job_info.update', $Jobinfo->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="transaction_code{{ $Jobinfo->id }}" class="form-label">Transaction
                                        No.:</label>
                                    <input type="text" name="transaction_code" class=""
                                        id="transaction_code{{ $Jobinfo->id }}"
                                        value="{{ $Jobinfo->transaction_code }}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="name{{ $Jobinfo->id }}" class="form-label">Name:</label>
                                    <input type="text" name="name" class="" id="name{{ $Jobinfo->id }}"
                                        value="{{ $Jobinfo->name }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="email{{ $Jobinfo->id }}" class="form-label">Email:</label>
                                    <input type="text" name="email" class="" id="email{{ $Jobinfo->id }}"
                                        value="{{ $Jobinfo->email }}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="contact_number{{ $Jobinfo->id }}" class="form-label">Contact
                                        No.:</label>
                                    <input type="text" name="contact_number" class=""
                                        id="contact_number{{ $Jobinfo->id }}" value="{{ $Jobinfo->number }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="department{{ $Jobinfo->id }}" class="form-label">Department:</label>
                                    <input type="text" name="department" class=""
                                        id="department{{ $Jobinfo->id }}" value="{{ $Jobinfo->department }}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="problem_statement{{ $Jobinfo->id }}"
                                        class="form-label">Issue/Request:</label>
                                    <input type="text" name="problem_statement" class=""
                                        id="problem_statement{{ $Jobinfo->id }}"
                                        value="{{ $Jobinfo->problem_statement }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="datetime_started{{ $Jobinfo->id }}" class="form-label">Date
                                        Started:</label>
                                    <input type="datetime-local" name="datetime_started" class=""
                                        id="datetime_started{{ $Jobinfo->id }}"
                                        value="{{ $Jobinfo->datetime_started }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="datetime_accomplished{{ $Jobinfo->id }}" class="form-label">Date
                                        Accomplished:</label>
                                    <input type="datetime-local" name="datetime_accomplished" class=""
                                        id="datetime_accomplished{{ $Jobinfo->id }}"
                                        value="{{ $Jobinfo->datetime_accomplished }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="no_units">No. of Units:</label>
                                    <input type="number" name="no_units" id="no_units"
                                        value="{{ $Jobinfo->no_units }}">
                                    <label for="requests{{ $Jobinfo->id }}" class="form-label">Service
                                        Description:</label>
                                    @php
                                        $options = [];
                                        $office = auth()->user()->office;
                                        if ($office == 1) {
                                            $options = [
                                                ['id' => 1, 'label' => 'Layout Design'],
                                                ['id' => 2, 'label' => 'Video Editing'],
                                                ['id' => 3, 'label' => 'Audio Visual Presentation'],
                                                ['id' => 4, 'label' => 'Audio Editing'],
                                                ['id' => 5, 'label' => 'Returned'],
                                            ];
                                        } elseif ($office == 2) {
                                            $options = [
                                                ['id' => 1, 'label' => 'Upgrade'],
                                                ['id' => 2, 'label' => 'Repair (Hardware/Software)'],
                                                ['id' => 3, 'label' => 'Network Connection (LAN)'],
                                                ['id' => 4, 'label' => 'Format'],
                                                ['id' => 5, 'label' => 'Backup/Data Recovery'],
                                                ['id' => 6, 'label' => 'Virus (Detection/Cleaning)'],
                                                ['id' => 7, 'label' => 'Installation (Hardware/Software)'],
                                                ['id' => 8, 'label' => 'Biometrics Registration'],
                                                ['id' => 9, 'label' => 'IT Equipment Inspection'],
                                                ['id' => 10, 'label' => 'Returned'],
                                            ];
                                        } elseif ($office == 3) {
                                            $options = [
                                                ['id' => 1, 'label' => 'Data Collection'],
                                                ['id' => 2, 'label' => 'Edit Process Program'],
                                                ['id' => 3, 'label' => 'Request for System Update/Modification'],
                                                ['id' => 4, 'label' => 'Edit/Modification of info in Database'],
                                                ['id' => 5, 'label' => 'Returned'],
                                            ];
                                        }
                                    @endphp
                                    @foreach ($options as $option)
                                        <div class="flex items-center">
                                            <input type="checkbox" id="request_{{ $option['id'] }}" name="request[]"
                                                value="{{ $option['id'] }}" class="mr-2"
                                                @if (in_array($option['id'], old('request', [])) ||
                                                        (isset($Jobinfo) && in_array($option['id'], explode(', ', $Jobinfo->requests)))) checked @endif>
                                            <label for="request_{{ $option['id'] }}">{{ $option['label'] }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-md-6">
                                    <label for="remarks{{ $Jobinfo->id }}" class="form-label">Note:</label>
                                    <input type="text" name="remarks" class="" id="remarks{{ $Jobinfo->id }}"
                                        value="{{ $Jobinfo->remarks }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

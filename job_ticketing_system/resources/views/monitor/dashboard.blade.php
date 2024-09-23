@extends('layouts.monitor-layout')

@section('content')
    <div class="py-12 d-flex justify-content-center">
        <div class="container">
            <div class="card">
                <div class="card-body table-responsive">
                    <table id="myTable" class="table table-bordered hover">
                        <div class="circle-icons" style="justify-content: space-between;">
                            <b>Void:</b> <i class="fa-solid fa-circle" style="color: #303030;"></i>
                            <b>| Processing:</b> <i class="fa-solid fa-circle" style="color: #ffb005;"></i>
                            <b>| Released:</b> <i class="fa-solid fa-circle" style="color: #b50000;"></i>
                        </div>
                        <thead>
                            <tr>
                                <th>Department</th>
                                <th>Problem</th>
                                <th>Personnel</th>
                                <th>Date Started</th>
                                <th>Date Released</th>
                                <th>Transaction No.</th>
                                <th>Status</th>
                                <th class="action">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @if ($jobInfos->isEmpty())
                                <tr>
                                    <td class="text-center">No available request</td>
                                </tr>
                            @else
                                @foreach ($jobInfos as $jobInfo)
                                    <tr class="{{ in_array($jobInfo->status, ['Released', 'Voided']) ? 'hidden' : '' }}">
                                        <td class="truncate">{{ $jobInfo->department }}</td>
                                        <td class="truncate">{{ $jobInfo->problem_statement }}</td>
                                        <td class="truncate">{{ $jobInfo->attending_personnel }}</td>
                                        <td class="truncate">{{ $jobInfo->datetime_started }}</td>
                                        <td class="truncate">{{ $jobInfo->datetime_accomplished }}</td>
                                        <td class="truncate">{{ $jobInfo->transaction_code }}</td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            @if ($jobInfo->status == 'Voided')
                                                <i class="fa-solid fa-circle" style="color: #303030;"></i>
                                            @elseif ($jobInfo->status == 'Released')
                                                <i class="fa-solid fa-circle" style="color: #b50000;"></i>
                                            @elseif ($jobInfo->status == 'Pending')
                                                <i class="fa-solid fa-circle" style="color: #ffb005;"></i>
                                            @else
                                                {{ $jobInfo->status }}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <a href="#" class="view btn" data-bs-toggle="modal"
                                                    data-bs-target="#viewModal" data-name="{{ $jobInfo->name }}"
                                                    data-number="{{ $jobInfo->number }}" data-email="{{ $jobInfo->email }}"
                                                    data-problem="{{ $jobInfo->problem_statement }}"
                                                    data-requests="{{ $jobInfo->requests }}"
                                                    data-units="{{ $jobInfo->no_units }}"
                                                    data-datetime-started="{{ $jobInfo->datetime_started }}"
                                                    data-datetime-accomplished="{{ $jobInfo->datetime_accomplished }}"
                                                    data-transaction-code="{{ $jobInfo->transaction_code }}"
                                                    data-remarks="{{ $jobInfo->remarks }}"
                                                    data-status="{{ $jobInfo->status }}">
                                                    <i class="fa-solid fa-eye fa-xl" style="color: #306ed9;"></i></a>
                                                <a href="{{ route('job_request.edit', $jobInfo->id) }}" class="btn">
                                                    <i class="fa-solid fa-user-pen fa-xl" style="color: #808080;"></i></a>
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
    <!-- VIEW MODAL -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Job Request Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="viewModalBody">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Transaction No:</strong> <span id="modalTransactionCode"></span></p>
                            <p><strong>Name:</strong> <span id="modalName"></span></p>
                            <p><strong>Date Started:</strong> <span id="modalDatetimeStarted"></span></p>
                            <p><strong>No. of Units:</strong> <span id="modalUnits"></span></p>
                            <p><strong>Note:</strong> <span id="modalRemarks"></span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Status:</strong> <span id="modalStatus"></span></p>
                            <p><strong>Number:</strong> <span id="modalNumber"></span></p>
                            <p><strong>Date Accomplished:</strong> <span id="modalDatetimeAccomplished"></span></p>
                            <p><strong>Issue/Request:</strong> <span id="modalProblem"></span></p>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

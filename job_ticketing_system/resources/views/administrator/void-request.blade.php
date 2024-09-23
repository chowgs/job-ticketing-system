@extends('layouts.administrator-layout')

@section('content')
    <title>Administrator: Void Management</title>

    <div class="py-12 d-flex justify-content-center">
        <div class="container">
            <div class="card">
                <div class="card-body table-responsive">
                    <table id="myTable" class="table table-bordered hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Problem</th>
                                <th>Personnel</th>
                                <th>Date Started</th>
                                <th>Date Released</th>
                                <th>Transaction No.</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @if ($jobInfos->isEmpty())
                                <tr>
                                    <td colspan="9" class="text-center">No available request</td>
                                </tr>
                            @else
                                @foreach ($jobInfos as $jobInfo)
                                    @if ($jobInfo->status != 'Voided')
                                        <tr>
                                            <td class="truncate">{{ $jobInfo->name }}</td>
                                            <td class="truncate">{{ $jobInfo->department }}</td>
                                            <td class="truncate">{{ $jobInfo->problem_statement }}</td>
                                            <td class="truncate">{{ $jobInfo->attending_personnel }}</td>
                                            <td class="truncate">{{ $jobInfo->datetime_started }}</td>
                                            <td class="truncate">{{ $jobInfo->datetime_accomplished }}</td>
                                            <td class="truncate">{{ $jobInfo->transaction_code }}</td>
                                            <td style="text-align: center">
                                                <button type="button" class="btn" data-bs-toggle="modal"
                                                    data-bs-target="#voidModal{{ $jobInfo->id }}"><i
                                                        class="fa-solid fa-ban fa-2xl" style="color: #f5c000;"></i></button>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Void Confirmation -->
    @foreach ($jobInfos as $jobInfo)
        <div class="modal fade" id="voidModal{{ $jobInfo->id }}" tabindex="-1" aria-labelledby="voidModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="voidModalLabel">Void Request - Transaction No:
                            <br><strong>{{ $jobInfo->transaction_code }}</strong></h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('void-request', ['id' => $jobInfo->id]) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <p>Are you sure you want to void this request?</p>
                            <textarea class="form-control" name="reason" placeholder="Enter reason/description"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@extends('layouts.client-layout')

@section('content')
    <title>Client: Status of Request</title>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('creative-works-form') }}" class="text-decoration-none text-dark">
                    <div class="tablecard mb-4">
                        <div class="tablecard-body">
                            <h5 class="tablecard-title">Creative Works</h5>
                            <p class="tablecard-text">Click here for Creative Works services.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('it-repair-form') }}" class="text-decoration-none text-dark">
                    <div class="tablecard mb-4">
                        <div class="tablecard-body">
                            <h5 class="tablecard-title">IT Repair & Maintenance</h5>
                            <p class="tablecard-text">Click here for IT Repair & Maintenance services.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('system-dev-form') }}" class="text-decoration-none text-dark">
                    <div class="tablecard mb-4">
                        <div class="tablecard-body">
                            <h5 class="tablecard-title">System Development</h5>
                            <p class="tablecard-text">Click here for System Development services.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="py-12 d-flex justify-content-center">
        <div class="container">
            <div class="tablecard">
                <div class="tablecard-body table-responsive">
                    @if ($Jobinfos->isEmpty())
                        <p colspan="9" class="text-center">No available request.</p>
                    @else
                        <div class="circle-icons" style="justify-content: space-between;">
                            <b>Void:</b> <i class="fa-solid fa-circle" style="color: #303030;"></i>
                            <b>| Processing:</b> <i class="fa-solid fa-circle" style="color: #ffb005;"></i>
                            <b>| Released:</b> <i class="fa-solid fa-circle" style="color: #b50000;"></i>
                        </div>
                        <table id="myTable" class="table table-bordered table-striped table-hover">
                            <thead>
                                <div class="filter-status mb-3">
                                    <label for="status-filter">Filter Status:</label>
                                    <select id="status-filter">
                                        <option value="" selected disabled>Select Status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Released">Released</option>
                                        <option value="Voided">Voided</option>
                                    </select>
                                </div>
                                <tr>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Problem</th>
                                    <th>Attending Personnel</th>
                                    <th>Note</th>
                                    <th>Date Returned</th>
                                    <th>Transaction No.</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Jobinfos as $Jobinfo)
                                    <tr class="status-{{ ($Jobinfo->status) }}">
                                        <td class="truncate">{{ $Jobinfo->name }}</td>
                                        <td class="truncate">{{ $Jobinfo->department }}</td>
                                        <td class="truncate">{{ $Jobinfo->problem_statement }}</td>
                                        <td class="truncate">{{ $Jobinfo->attending_personnel }}</td>
                                        <td class="truncate">{{ $Jobinfo->remarks }}</td>
                                        <td class="truncate">{{ $Jobinfo->date_returned }}</td>
                                        <td class="truncate">{{ $Jobinfo->transaction_code }}</td>
                                        <td class="truncate">{{ $Jobinfo->reason }}</td>
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

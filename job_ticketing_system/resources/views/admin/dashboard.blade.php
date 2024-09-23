@extends('layouts.admin-layout')

@section('content')
    <title>IT Personnel: Status of Request</title>

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
                            <tr>
                                <th>Department</th>
                                <th>Problem</th>
                                <th>Service Description</th>
                                <th>Attending Personnel</th>
                                <th>Note</th>
                                <th>Date Returned</th>
                                <th>Transaction No.</th>
                                <th>Status</th>
                                <th>Reason</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse($Jobinfos->chunk(8) as $chunk)
                                @foreach ($chunk as $Jobinfo)
                                    <tr>
                                        <td class="truncate">{{ $Jobinfo->department }}</td>
                                        <td class="truncate">{{ $Jobinfo->problem_statement }}</td>
                                        <td class="truncate">{{ $Jobinfo->requests }}</td>
                                        <td class="truncate">{{ $Jobinfo->attending_personnel }}</td>
                                        <td class="truncate">{{ $Jobinfo->remarks }}</td>
                                        <td class="truncate">{{ $Jobinfo->date_returned }}</td>
                                        <td class="truncate">{{ $Jobinfo->transaction_code }}</td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            @if ($Jobinfo->status == 'Voided')
                                                <i class="fa-solid fa-circle" style="color: #303030;"></i>
                                            @elseif ($Jobinfo->status == 'Released')
                                                <i class="fa-solid fa-circle" style="color: #b50000;"></i>
                                            @elseif ($Jobinfo->status == '')
                                                <i class="fa-solid fa-circle" style="color: #ffb005;"></i>
                                            @else
                                                {{ $Jobinfo->status }}
                                            @endif
                                        </td>
                                        <td>{{ $Jobinfo->reason }}</td>
                                    </tr>
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">
                                        No job request available
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

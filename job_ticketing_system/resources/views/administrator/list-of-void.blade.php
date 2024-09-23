@extends('layouts.administrator-layout')

@section('content')
<title>Administrator: List of Void Requests</title>

<div class="py-12 d-flex justify-content-center">
    <div class="container">
        <div class="card">
            <div class="card-body table-responsive">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Problem</th>
                            <th>Requests</th>
                            <th>Personnel</th>
                            <th>Transaction No.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($voidedJobInfos->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">No available request</td>
                            </tr>
                        @else
                            @foreach($voidedJobInfos as $voidedJobInfo)
                                <tr>
                                    <td class="truncate">{{ $voidedJobInfo->name }}</td>
                                    <td class="truncate">{{ $voidedJobInfo->department }}</td>
                                    <td class="truncate">{{ $voidedJobInfo->problem_statement }}</td>
                                    <td class="truncate">{{ $voidedJobInfo->requests }}</td>
                                    <td class="truncate">{{ $voidedJobInfo->attending_personnel }}</td>
                                    <td class="truncate">{{ $voidedJobInfo->transaction_code }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

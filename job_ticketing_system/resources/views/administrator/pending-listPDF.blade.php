<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Requests List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h1 {
            color: #23408E;
            margin-bottom: 20px;
            text-align: center
        }
        .date {
            text-align: center;
        }
        .total {
            text-align: left;
        }
        .dataTable {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #23408E;
            color: white;
        }
        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Pending Request/s List: {{ $officeLabel }}</h1>
    <p class="date">Date range from: <b>{{ $from }}</b> to: <b>{{ $to }}</b></p>
    <table class="dataTable">
        <thead>
            <tr>
                <th>Transaction Code</th>
                <th>Name</th>
                <th>Department</th>
                <th>Issue/Request</th>
                <th>No. of Units</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobInfos as $jobInfo)
                <tr>
                    <td>{{ $jobInfo->transaction_code }}</td>
                    <td>{{ $jobInfo->name }}</td>
                    <td>{{ $jobInfo->department }}</td>
                    <td>{{ $jobInfo->problem_statement }}</td>
                    <td>{{ $jobInfo->no_units }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            color: #23408E;
            text-align: center
        }
        .date {
            text-align: center;
        }
        .dataTable {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 50px;
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
    <h1>List of Transaction</h1>
    <p class="date">Date range from: <b>{{ $from }}</b> to: <b>{{ $to }}</b></p>
    <p class="name"><b>Name of Personnel: {{ $user->name }}</b></p>

    <table>
        <thead>
            <tr>
                <th><strong>Transaction No.</strong></th>
                <th><strong>Service Description</strong></th>
                <th><strong>Note</strong></th>
                <th><strong>Name</strong></th>
                <th><strong>Department</strong></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Jobinfos as $jobinfo)
                <tr>
                    <td>{{ $jobinfo->transaction_code }}</td>
                    <td>
                        @foreach ($options as $opt)
                            @if (in_array($opt['id'], explode(', ', $jobinfo->requests)))
                                {{ $opt['label'] }}
                            @endif
                        @endforeach
                    </td>
                    <td>{{ $jobinfo->remarks }}</td>
                    <td>{{ $jobinfo->name }}</td>
                    <td>{{ $jobinfo->department }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

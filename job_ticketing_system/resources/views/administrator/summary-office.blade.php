<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summary of Request per Office</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            color: #23408E;
            text-align: center
        }
        .date{
            text-align: center
        }
        p {
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <h1>Summary of Request: {{ $officeLabel }}</h1>
    <p class="date">Date range from: <b>{{ $from }}</b> to: <b>{{ $to }}</b></p>
    <p>Total Transactions: {{ $totalTransactions }}</p>
    <table>
        <thead>
            <tr>
                <th><strong>Transaction No.</strong></th>
                <th><strong>Client's Name</strong></th>
                <th><strong>Service/s</strong></th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobInfos as $jobInfo)
                <tr>
                    <td>{{ $jobInfo->transaction_code }}</td>
                    <td>{{ $jobInfo->name }}</td>
                    <td>
                        @foreach($options as $option)
                            @if(in_array($option['id'], explode(', ', $jobInfo->requests)))
                                {{ $option['label'] }},
                            @endif
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Report</title>
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
    <h1>Service Report: {{ $officeLabel }}</h1>
    <p class="date">Date range from: <b>{{ $from }}</b> to: <b>{{ $to }}</b></p>
    <table class="dataTable">
        <thead>
            <tr>
                <th><strong>No. of Transactions</strong></th>
                <th><strong>Service Description</strong></th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalTransactions = 0;
            @endphp
            @foreach ($options as $opt)
                <tr>
                    <td>{{ $opt['count'] }}</td>
                    <td>{{ $opt['label'] }}</td>
                </tr>
                @php
                    $totalTransactions += $opt['count'];
                @endphp
            @endforeach
                <p class="total">Total Transaction: <b>{{ $totalTransactions }}</b></p>
        </tbody>
    </table>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            color: #23408E;
            text-align: center;
            margin-top: 20px;
        }
        p {
            margin-bottom: 20px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            background-color: #fff;
            border: 1px solid #ddd;
            margin: 0 auto;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            border-right: 1px solid #ddd;
        }
        th {
            background-color: #23408E;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
        }
        .personnel{
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>List of Transactions: {{ $officeLabel }}</h1>
    <p>Date range from: <b>{{ $from }}</b> to: <b>{{ $to }}</b></p>
    <table>
        <thead>
            <tr>
                <th><strong>Transaction Code</strong></th>
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
                    @php $labels = []; @endphp
                    @foreach ($options as $opt)
                        @if (in_array($opt['id'], explode(', ', $jobinfo->requests)))
                            @php $labels[] = $opt['label']; @endphp
                        @endif
                    @endforeach
                    {{ implode(', ', $labels) }}
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

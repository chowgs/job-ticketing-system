<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<style>
    .dates {
        text-decoration: underline;
    }
</style>
<body>
<div class="">

    <!-- Barcode -->
    <?php

    // Define barcode value
    $barcodeValue = $jobinfo->transaction_code;

    // Define barcode style
    $style = array(
        'position' => 'R',
        'align' => '',
        'stretch' => false,
        'fitwidth' => true,
        'cellfitalign' => '',
        'border' => false,
        'hpadding' => 'auto',
        'vpadding' => 'auto',
        'fgcolor' => array(0, 0, 0),
        'bgcolor' => false,
        'text' => true,
        'font' => 'helvetica',
        'fontsize' => 8,
        'stretchtext' => 4
    );

    // Output the barcode
    $pdf->write1DBarcode($barcodeValue, 'C128A', '20', '20', '', 15, 0.4, $style, 'N');

    ?>
</div>

<br><br><br><br>
<table>
    <tr>
        <th align="left"><strong style="color: #23408E;">CLIENT'S INFO</strong><br></th>
        <th align="left"><strong style="color: #23408E;">DATE RELEASED:________________________</strong><br></th>
    </tr>
</table>

<table style="border-bottom: 4px solid #23408E; border-top: 4px solid #F46A34;" cellpadding="4">
    <tr>
        <th align="left" style="border-left: 4px solid #F46A34;border-bottom: 4px solid #F46A34;"><b>Name:</b></th>
        <th align="left" style="border-left: solid #F46A34;border-bottom: 4px solid #F46A34;">{{ $jobinfo->name }}</th>
        <th align="left" style="border-left: solid #F46A34;border-bottom: 4px solid #F46A34;"><b>Signature:</b></th>
        <th align="left" style="border-right: 4px solid #F46A34;border-bottom: 4px solid #F46A34;"></th>
    </tr>
    <tr>
        <th align="left" style="border-left: 4px solid #F46A34;border-bottom: 4px solid #F46A34;"><b>Department:</b></th>
        <th align="left" style="border-left: solid #F46A34;border-bottom: 4px solid #F46A34;">{{ $jobinfo->department }}</th>
        <th align="left" style="border-left: solid #F46A34;border-bottom: 4px solid #F46A34;"><b>Contact Number:</b> </th>
        <th align="left" style="border-right: 4px solid #F46A34;border-bottom: 4px solid #F46A34;">{{ $jobinfo->number }}</th>
    </tr>

</table>
<br>

<table>
    <tr><br>
        <th align="left"><strong style="color: #23408E;">ISSUE/REQUEST:</strong> <p>{{ $jobinfo->problem_statement }}</p></th>
        <th align="left"><strong style="color: #23408E;">SERVICE DESCRIPTION (no.of units: {{$jobinfo->no_units}}):</strong>

            @php
            $options = [];
            $office = auth()->user()->office;

            if ($office == 1) {
                $options = [
                    ['id' => 1, 'label' => 'Layout Design'],
                    ['id' => 2, 'label' => 'Video Editing'],
                    ['id' => 3, 'label' => 'Audio Visual Presentation'],
                    ['id' => 4, 'label' => 'Audio Editing'],
                    ['id' => 5, 'label' => 'Returned'],
            ];
            } elseif ($office == 2) {
                $options = [
                    ['id' => 1, 'label' => 'Upgrade'],
                    ['id' => 2, 'label' => 'Repair (Hardware/Software)'],
                    ['id' => 3, 'label' => 'Network Connection (LAN)'],
                    ['id' => 4, 'label' => 'Format'],
                    ['id' => 5, 'label' => 'Backup/Data Recovery'],
                    ['id' => 6, 'label' => 'Virus (Detection/Cleaning)'],
                    ['id' => 7, 'label' => 'Installation (Hardware/Software)'],
                    ['id' => 8, 'label' => 'Biometrics Registration'],
                    ['id' => 9, 'label' => 'IT Equipment Inspection'],
                    ['id' => 10, 'label' => 'Returned'],
            ];
            } elseif ($office == 3) {
                $options = [
                    ['id' => 1, 'label' => 'Data Collection'],
                    ['id' => 2, 'label' => 'Edit Process Program'],
                    ['id' => 3, 'label' => 'Request for System Update/Modification'],
                    ['id' => 4, 'label' => 'Edit/Modification of info in Database'],
                    ['id' => 5, 'label' => 'Returned'],
                ];
            }
            $requestedOptions = explode(', ', $jobinfo->requests);
        @endphp

        @foreach ($requestedOptions as $option)
        @foreach ($options as $opt)
            @if ($opt['id'] == $option)
                <p>{{ $opt['label'] }}</p>
            @endif
        @endforeach
        @endforeach
        </th>
    </tr><br>
    <tr>
        <th align="left"><strong style="color: #23408E;">NOTE:</strong> <p>{{ $jobinfo->remarks }}</p></th>
        <th align="left"><strong style="color: #23408E;">ATTENDING PERSONNEL:</strong> <p>{{ $jobinfo->attending_personnel }}</p></th>
    </tr>
    <tr><br>
        <th align="left"><strong style="color: #23408E;">DATE RECEIVED:</strong> <p>{{ $jobinfo->datetime_started }}</p></th>
        <th align="left"><strong style="color: #23408E;">DATE RETURNED:</strong> <p>{{ $jobinfo->date_returned }}</p></th>
    </tr>
    <tr><br>
    <th align="left"><strong style="color: #23408E;">NOTED BY:</strong> <p> </p></th>
    <th align="left"><u style="text-align:center">LENEY C. LAYGO</u><p style="color: #23408E;text-align:center"> <strong >DEPARTMENT HEAD/SUPERVISOR:</strong></p></th>

    </tr>
</table>
</body>

</html>

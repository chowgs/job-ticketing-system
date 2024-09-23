<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <div class="">

        <!-- Barcode -->
        <?php

        // Define barcode value
        $barcodeValue = $Jobinfo->transaction_code;

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
        $pdf->write1DBarcode($barcodeValue, 'C128A', '', '', '', 15, 0.4, $style, 'N');

        ?>
    </div>
    <br><br><br><br>


<table>
    <tr>
        <th align="left"><strong style="color: #23408E;">CLIENT'S INFO</strong><br></th>
        <th align="left"><strong style="color: #23408E;">DATE RELEASED:</strong>________________________<br></th>
    </tr>
</table>

<table style="border-bottom: 4px solid #23408E; border-top: 4px solid #F46A34;" cellpadding="4">
    <tr>
        <th align="left" style="border-left: 4px solid #F46A34;border-bottom: 4px solid #F46A34;"><b>Name:</b></th>
        <th align="left" style="border-left: solid #F46A34;border-bottom: 4px solid #F46A34;">{{ auth()->user()->name }}</th>
        <th align="left" style="border-left: solid #F46A34;border-bottom: 4px solid #F46A34;"><b>Signature:</b></th>
        <th align="left" style="border-right: 4px solid #F46A34;border-bottom: 4px solid #F46A34;"></th>
    </tr>
    <tr>
        <th align="left" style="border-left: 4px solid #F46A34;border-bottom: 4px solid #F46A34;"><b>Department:</b></th>
        <th align="left" style="border-left: solid #F46A34;border-bottom: 4px solid #F46A34;">{{ auth()->user()->department }}</th>
        <th align="left" style="border-left: solid #F46A34;border-bottom: 4px solid #F46A34;"><b>Contact Number:</b> </th>
        <th align="left" style="border-right: 4px solid #F46A34;border-bottom: 4px solid #F46A34;">{{ auth()->user()->contact_number }}</th>
    </tr>

</table>
<br>

<table>
    <tr><br>
        <th align="left"><strong style="color: #23408E;">ISSUE ENCOUNTERED:</strong> <p>{{ $problem_statement }}</p></th>
        <th align="left"><strong style="color: #23408E;">NO. OF UNITS:</strong> <p>{{ $Jobinfo->no_units }}</p></th>
        <th align="left"><strong style="color: #23408E;">NOTE:</strong> <p></p></th>
    </tr><br>
    <tr>
        <th align="left"><strong style="color: #23408E;">ATTENDING PERSONNEL:</strong><p>_______________________</p></th>
        <th align="left"><strong style="color: #23408E;">DEPARTMENT HEAD/SUPERVISOR:</strong><p>_______________________</p></th>
    </tr>
    <tr><br>
        <th align="left"><strong style="color: #23408E;">DATE RECEIVED:</strong> <p>_______________________</p></th>
        <th align="left"><strong style="color: #23408E;">DATE RETURNED:</strong> <p>_______________________</p></th>
    </tr>
</table>
</body>
</html>

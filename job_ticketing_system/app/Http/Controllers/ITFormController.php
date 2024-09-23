<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jobinfo;
use Milon\Barcode\DNS1D;
use TCPDF;

class ITFormController extends Controller
{
    // STORE DATA BUTTON
    public function saveData(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'contact_number' => 'required|string',
            'department' => 'required|string',
            'problem_statement' => 'required|string',
            'no_units' => 'required|string',
        ]);

        // Create a new Jobinfo instance
        $Jobinfo = new Jobinfo();
        $Jobinfo->name = $validatedData['name'];
        $Jobinfo->email = $validatedData['email'];
        $Jobinfo->number = $validatedData['contact_number'];
        $Jobinfo->department = $validatedData['department'];
        $Jobinfo->no_units = $validatedData['no_units'];

        // Generate barcode value: year-month-number
        $barcodeValue = date('Ym') . '-' . Jobinfo::count();

        // Save other fields
        $Jobinfo->problem_statement = $validatedData['problem_statement'] ?? null;
        $Jobinfo->transaction_code = $barcodeValue;

        // Save the data
        $Jobinfo->save();

        // Retrieve the saved Jobinfo instance
        $jobInfo = Jobinfo::where('transaction_code', $barcodeValue)->first();

        $imagePath = 'images/it-head.png';

        // Initialize TCPDF
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('it-repair-&-maintenance-Form');
        $pdf->SetSubject('IT Repair & Maintenance Form');
        $pdf->SetKeywords('Form, IT Repair & Maintenance , TCPDF');
        $pdf->SetAutoPageBreak(TRUE, 0);

        // Remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // Add a page
        $pdf->AddPage();

        $pdf->Image($imagePath,0,10,150,35,'PNG');

        // Content
        $html = view('job-order-form.it-pdf-form', [
            'imagePath' => $imagePath,
            'problem_statement' => $request->input('problem_statement', []),
            'transaction_code' => $barcodeValue,
            'Jobinfo' => $jobInfo,
            'pdf' => $pdf,
        ])->render();

        $pdf->writeHTML($html, true, false, true, false, '');

        // Output the PDF to a variable
        $pdfData = $pdf->Output('', 'S');

        // Send the PDF data as response
        return response($pdfData)->header('Content-Type', 'application/pdf');
    }


}

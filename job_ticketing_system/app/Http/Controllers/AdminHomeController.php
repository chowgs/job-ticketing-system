<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

use App\Models\Jobinfo;
use App\Models\User;
use Milon\Barcode\DNS1D;
use TCPDF;

class AdminHomeController extends Controller
{
    // DISPLAY ASSIGNED TASK PAGE
    public function index()
    {
        // Get the authenticated user's name
        $userName = auth()->user()->name;

        // Fetch the records from job_info where attending_personnel matches the user's name
        $Jobinfos = Jobinfo::where('attending_personnel', $userName)->get();

        return view('admin.assignedTask', compact('Jobinfos'));
    }

    public function reportsIndex()
    {
        return view('admin.reports');
    }

    // ADMIN'S REQUEST LIST TABLE
    public function adminRequest()
    {
        $userName = auth()->user()->name; // Get the authenticated user's name

        $Jobinfos = Jobinfo::where('name', $userName)->get();

        return view('admin.dashboard', compact('Jobinfos'));
    }

    // UPDATE THE DATA (REQUEST)
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'remarks' => 'nullable|string',
            'created_at' => 'nullable|date_format:Y-m-d\TH:i',
            'datetime_started' => 'nullable|date_format:Y-m-d\TH:i',
            'datetime_accomplished' => 'nullable|date_format:Y-m-d\TH:i',
            'attending_personnel' => 'string',
            'no_units' => 'nullable|string',
            'request' => 'array',
        ]);

        $Jobinfo = Jobinfo::findOrFail($id);

        // Convert array of requests to comma-separated string
        $requests = $validatedData['request'] ?? [];
        $requestsString = implode(', ', $requests);

        $Jobinfo->requests = $requestsString;

        // Update the JobInfo record with the void status and reason
        DB::table('job_info')
            ->where('id', $id)
            ->update([
                'status' => 'Released',
            ]);

        $Jobinfo->update($validatedData);

        return redirect()->route('admin.assignedTask', $id)->with('success', 'Data updated successfully');
    }

    public function preview($id)
    {
        // Fetch the Jobinfo record
        $jobinfo = Jobinfo::findOrFail($id);

        // Determine the image header based on the authenticated user's office
        $imageHeader = '';
        switch (auth()->user()->office) {
            case 1:
                $imageHeader = 'creative-head.jpg';
                $imagePath = 'images/work-creative-head.png';
                break;
            case 2:
                $imageHeader = 'it-head.jpg';
                $imagePath = 'images/work-it-head.png';
                break;
            case 3:
                $imageHeader = 'sys-head.jpg';
                $imagePath = 'images/work-sys-head.png';
                break;
            default:
                // default image header
                break;
        }

        // Create a new TCPDF instance
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor(PDF_CREATOR);
        $pdf->SetTitle('work-order-form');
        $pdf->SetAutoPageBreak(true, 0);

        // Remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Add a page
        $pdf->AddPage();

        $pdf->Image($imagePath, 10, 20, 130, 40, 'PNG');

        // Content
        $html = view('admin.preview', compact('jobinfo', 'imageHeader', 'pdf'))->render();

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdfData = $pdf->Output('', 'I');

        return response($pdfData)->header('Content-Type', 'application/pdf');
    }

    public function servicePDF(Request $request)
    {
        // Get authenticated user data
        $user = auth()->user();

        $from = $request->from;
        $to = $request->to;

        // Define options based on user's office
        $options = [];
        $office = $user->office;
        if ($office == 1) {
            $options = [['id' => 1, 'label' => 'Layout Design'], ['id' => 2, 'label' => 'Video Editing'], ['id' => 3, 'label' => 'Audio Visual Presentation'], ['id' => 4, 'label' => 'Audio Editing'], ['id' => 5, 'label' => 'Returned']];
        } elseif ($office == 2) {
            $options = [['id' => 1, 'label' => 'Upgrade'], ['id' => 2, 'label' => 'Repair (Hardware/Software)'], ['id' => 3, 'label' => 'Network Connection (LAN)'], ['id' => 4, 'label' => 'Format'], ['id' => 5, 'label' => 'Backup/Data Recovery'], ['id' => 6, 'label' => 'Virus (Detection/Cleaning)'], ['id' => 7, 'label' => 'Installation (Hardware/Software)'], ['id' => 8, 'label' => 'Biometrics Registration'], ['id' => 9, 'label' => 'IT Equipment Inspection'], ['id' => 10, 'label' => 'Returned']];
        } elseif ($office == 3) {
            $options = [['id' => 1, 'label' => 'Data Collection'], ['id' => 2, 'label' => 'Edit Process Program'], ['id' => 3, 'label' => 'Request for System Update/Modification'], ['id' => 4, 'label' => 'Edit/Modification of info in Database'], ['id' => 5, 'label' => 'Returned']];
        }

        // Filter job_info records by date range
        $jobInfos = Jobinfo::where('attending_personnel', $user->name)
            ->whereDate('datetime_accomplished', '>=', $from)
            ->whereDate('datetime_accomplished', '<=', $to)
            ->get();

        // Count occurrences of each option ID within the date range
        $counts = $jobInfos
            ->flatMap(function ($jobInfo) {
                return explode(', ', $jobInfo->requests);
            })
            ->countBy();

        // Merge counts with options
        $optionsWithCounts = collect($options)->map(function ($option) use ($counts) {
            $count = $counts->get($option['id'], 0);
            return array_merge($option, ['count' => $count]);
        });

        // Pass data to the Blade view
        $data = [
            'user' => $user,
            'options' => $optionsWithCounts,
            'to' => $to,
            'from' => $from,
        ];

        // Render the Blade view to HTML
        $html = View::make('admin.servicesPDF', $data)->render();

        // Initialize TCPDF
        $pdf = new TCPDF();
        $pdf->SetMargins(20, 20, 20);
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', '', 12);

        // Add content to the PDF
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('generated_pdf.pdf', 'I');
    }


    public function transactPDF(Request $request)
    {
        // Get the authenticated user's name
        $user = auth()->user();

        $from = $request->from;
        $to = $request->to;

        // Fetch job information for the authenticated user within the date range
        $Jobinfos = Jobinfo::where('attending_personnel', $user->name)
            ->whereDate('datetime_accomplished', '>=', $from)
            ->whereDate('datetime_accomplished', '<=', $to)
            ->get();

        // Define options based on user's office
        $options = [];
        $office = $user->office;
        if ($office == 1) {
            $options = [['id' => 1, 'label' => 'Layout Design'], ['id' => 2, 'label' => 'Video Editing'], ['id' => 3, 'label' => 'Audio Visual Presentation'], ['id' => 4, 'label' => 'Audio Editing'], ['id' => 5, 'label' => 'Returned']];
        } elseif ($office == 2) {
            $options = [['id' => 1, 'label' => 'Upgrade'], ['id' => 2, 'label' => 'Repair (Hardware/Software)'], ['id' => 3, 'label' => 'Network Connection (LAN)'], ['id' => 4, 'label' => 'Format'], ['id' => 5, 'label' => 'Backup/Data Recovery'], ['id' => 6, 'label' => 'Virus (Detection/Cleaning)'], ['id' => 7, 'label' => 'Installation (Hardware/Software)'], ['id' => 8, 'label' => 'Biometrics Registration'], ['id' => 9, 'label' => 'IT Equipment Inspection'], ['id' => 10, 'label' => 'Returned']];
        } elseif ($office == 3) {
            $options = [['id' => 1, 'label' => 'Data Collection'], ['id' => 2, 'label' => 'Edit Process Program'], ['id' => 3, 'label' => 'Request for System Update/Modification'], ['id' => 4, 'label' => 'Edit/Modification of info in Database'], ['id' => 5, 'label' => 'Returned']];
        }

        // Pass data to the Blade view
        $data = [
            'user' => $user,
            'from' => $from,
            'to' => $to,
            'Jobinfos' => $Jobinfos,
            'options' => $options,
        ];

        // Render the Blade view to HTML
        $html = View::make('admin.transactPDF', $data)->render();

        // Initialize TCPDF
        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetMargins(20, 20, 20);
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', '', 12);

        // Add content to the PDF
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('generated_pdf.pdf', 'I');
    }

    //SHOW SYSTEM DEV FORM
    public function showForm()
    {
        return view('admin.system-dev-form');
    }

    //SHOW CREATIVE WORKS FORM
    public function showFormCreative()
    {
        return view('admin.creative-works-form');
    }

    //SHOW IT REPAIR FORM
    public function showFormRepair()
    {
        return view('admin.it-repair-form');
    }
}

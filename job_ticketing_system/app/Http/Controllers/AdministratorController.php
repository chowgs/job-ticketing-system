<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

use App\Models\JobInfo;
use App\Models\User;
use App\Models\Department;
use TCPDF;

class AdministratorController extends Controller
{
    // DASHBOARD
    public function index()
    {
        $users = User::all();

        // Pass the users data to the view
        return view('administrator.dashboard', compact('users'));
    }

    // REQUEST LIST
    public function voidIndex()
    {
        $jobInfos = JobInfo::get();

        // Pass the users data to the view
        return view('administrator.void-request', compact('jobInfos'));
    }

    // VOID LIST
    public function voidListIndex()
    {
        $voidedJobInfos = JobInfo::where('status', 'Voided')->get();

        // Pass the voided job infos data to the view
        return view('administrator.list-of-void', compact('voidedJobInfos'));
    }

    // DEPARTMENT LIST
    public function departmentIndex()
    {
        $departments = Department::all();

        // Pass the users data to the view
        return view('administrator.department', compact('departments'));
    }

    // STORE NEW DEPARTMENT
    public function storeDepartment(Request $request)
    {
        $validatedData = $request->validate([
            'dept_acronym' => 'required|string|max:255',
            'dept_name' => 'required|string|max:255',
        ]);

        // Convert the department acronym to uppercase
        $deptAcronym = strtoupper($validatedData['dept_acronym']);
        $deptName = $validatedData['dept_name'];

        // Create a new Department instance
        $department = new Department();
        $department->dept_acronym = $deptAcronym;
        $department->dept_name = $deptName;
        $department->save();

        return redirect()->back()->with('success', 'Department added successfully');
    }

    // UPDATE DEPARTMENT DETAILS
    public function updateDepartment(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'dept_acronym' => 'required|string',
            'dept_name' => 'required|string',
        ]);

        // Find the department by its ID
        $department = Department::findOrFail($id);

        // Update the department details
        $department->update([
            'dept_acronym' => $validatedData['dept_acronym'],
            'dept_name' => $validatedData['dept_name'],
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Department updated successfully');
    }

    // STORE USERTYPE
    public function saveUserType(Request $request, $id)
    {
        $userType = $request->input('usertype');
        $office = $request->input('office');

        User::where('id', $id)->update([
            'usertype' => $userType,
            'office' => $office,
        ]);

        return redirect()->back()->with('success', 'User type saved successfully');
    }

    // VOID REQUEST
    public function voidRequest(Request $request, $id)
    {
        $validatedData = $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        // Find the JobInfo record
        $jobInfo = JobInfo::findOrFail($id);

        // Update the JobInfo record with the void status and reason
        DB::table('job_info')
            ->where('id', $id)
            ->update([
                'status' => 'Voided',
                'reason' => $validatedData['reason'],
            ]);

        return redirect()->back()->with('success', 'Request voided successfully');
    }

    // REPORTS INDEX
    public function reportsIndex()
    {
        return view('administrator.reports');
    }

    // BUTTON SERVICE TRANSACTION
    public function servicetransactionPDF(Request $request)
    {

        // Define division labels
        $divisionLabels = [
            1 => 'Creative Works',
            2 => 'IT Repair & Maintenance',
            3 => 'System Development',
        ];

        // Get the selected attending personnel from the dropdown
        $attendingPersonnelId = $request->attending_personnel;

        // Fetch the attending personnel based on the selected ID
        $attendingPersonnel = User::findOrFail($attendingPersonnelId);

        $from = $request->from;
        $to = $request->to;

        if ($request->has('generate_service')) {
            // Fetch the records from job_info where attending_personnel matches the selected personnel's name
            $Jobinfos = Jobinfo::where('attending_personnel', $attendingPersonnel->name)
                ->whereDate('datetime_accomplished', '>=', $from)
                ->whereDate('datetime_accomplished', '<=', $to)
                ->get();

            // Define options based on attending_personnel's office
            $options = [];
            $office = $attendingPersonnel->office;
            if ($office == 1) {
                $options = [['id' => 1, 'label' => 'Layout Design'], ['id' => 2, 'label' => 'Video Editing'], ['id' => 3, 'label' => 'Audio Visual Presentation'], ['id' => 4, 'label' => 'Audio Editing'], ['id' => 5, 'label' => 'Returned']];
            } elseif ($office == 2) {
                $options = [['id' => 1, 'label' => 'Upgrade'], ['id' => 2, 'label' => 'Repair (Hardware/Software)'], ['id' => 3, 'label' => 'Network Connection (LAN)'], ['id' => 4, 'label' => 'Format'], ['id' => 5, 'label' => 'Backup/Data Recovery'], ['id' => 6, 'label' => 'Virus (Detection/Cleaning)'], ['id' => 7, 'label' => 'Installation (Hardware/Software)'], ['id' => 8, 'label' => 'Biometrics Registration'], ['id' => 9, 'label' => 'IT Equipment Inspection'], ['id' => 10, 'label' => 'Returned']];
            } elseif ($office == 3) {
                $options = [['id' => 1, 'label' => 'Data Collection'], ['id' => 2, 'label' => 'Edit Process Program'], ['id' => 3, 'label' => 'Request for System Update/Modification'], ['id' => 4, 'label' => 'Edit/Modification of info in Database'], ['id' => 5, 'label' => 'Returned']];
            }

            // Get the label for the selected division
            $officeLabel = $divisionLabels[$office];

            // Count occurrences of each option ID within the date range
            $counts = $Jobinfos
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
                'from' => $from,
                'to' => $to,
                'Jobinfos' => $Jobinfos,
                'options' => $optionsWithCounts,
                'attendingPersonnel' => $attendingPersonnel,
                'officeLabel' => $officeLabel,
            ];

            // Render the Blade view to HTML
            $html = View::make('administrator.servicePDF', $data)->render();

            // Initialize TCPDF with portrait orientation
            $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        } elseif ($request->has('generate_transaction')) {

            // Define division labels
            $divisionLabels = [
                1 => 'Creative Works',
                2 => 'IT Repair & Maintenance',
                3 => 'System Development',
            ];

            // Fetch the records from job_info where attending_personnel matches the user's name
            $Jobinfos = Jobinfo::where('attending_personnel', $attendingPersonnel->name)
                ->whereDate('datetime_accomplished', '>=', $from)
                ->whereDate('datetime_accomplished', '<=', $to)
                ->get();
            $options = [];
            $office = $attendingPersonnel->office;
            if ($office == 1) {
                $options = [['id' => 1, 'label' => 'Layout Design'], ['id' => 2, 'label' => 'Video Editing'], ['id' => 3, 'label' => 'Audio Visual Presentation'], ['id' => 4, 'label' => 'Audio Editing'], ['id' => 5, 'label' => 'Returned']];
            } elseif ($office == 2) {
                $options = [['id' => 1, 'label' => 'Upgrade'], ['id' => 2, 'label' => 'Repair (Hardware/Software)'], ['id' => 3, 'label' => 'Network Connection (LAN)'], ['id' => 4, 'label' => 'Format'], ['id' => 5, 'label' => 'Backup/Data Recovery'], ['id' => 6, 'label' => 'Virus (Detection/Cleaning)'], ['id' => 7, 'label' => 'Installation (Hardware/Software)'], ['id' => 8, 'label' => 'Biometrics Registration'], ['id' => 9, 'label' => 'IT Equipment Inspection'], ['id' => 10, 'label' => 'Returned']];
            } elseif ($office == 3) {
                $options = [['id' => 1, 'label' => 'Data Collection'], ['id' => 2, 'label' => 'Edit Process Program'], ['id' => 3, 'label' => 'Request for System Update/Modification'], ['id' => 4, 'label' => 'Edit/Modification of info in Database'], ['id' => 5, 'label' => 'Returned']];
            }

            // Get the label for the selected division
            $officeLabel = $divisionLabels[$office];

            $data = [
                'from' => $from,
                'to' => $to,
                'options' => $options,
                'Jobinfos' => $Jobinfos,
                'attendingPersonnel' => $attendingPersonnel,
                'officeLabel' => $officeLabel,
            ];

            // Render the Blade view to HTML
            $html = View::make('administrator.transactPDF', $data)->render();

            // Initialize TCPDF with landscape orientation
            $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        } elseif ($request->has('generate_all_transaction')) {
            $office = $request->input('office');

            // Define division labels
            $divisionLabels = [
                1 => 'Creative Works',
                2 => 'IT Repair & Maintenance',
                3 => 'System Development',
            ];

            // Determine the options based on the office
            switch ($office) {
                case 1:
                    $options = [['id' => 1, 'label' => 'Layout Design'], ['id' => 2, 'label' => 'Video Editing'], ['id' => 3, 'label' => 'Audio Visual Presentation'], ['id' => 4, 'label' => 'Audio Editing'], ['id' => 5, 'label' => 'Returned']];
                    break;
                case 2:
                    $options = [['id' => 1, 'label' => 'Upgrade'], ['id' => 2, 'label' => 'Repair (Hardware/Software)'], ['id' => 3, 'label' => 'Network Connection (LAN)'], ['id' => 4, 'label' => 'Format'], ['id' => 5, 'label' => 'Backup/Data Recovery'], ['id' => 6, 'label' => 'Virus (Detection/Cleaning)'], ['id' => 7, 'label' => 'Installation (Hardware/Software)'], ['id' => 8, 'label' => 'Biometrics Registration'], ['id' => 9, 'label' => 'IT Equipment Inspection'], ['id' => 10, 'label' => 'Returned']];
                    break;
                case 3:
                    $options = [['id' => 1, 'label' => 'Data Collection'], ['id' => 2, 'label' => 'Edit Process Program'], ['id' => 3, 'label' => 'Request for System Update/Modification'], ['id' => 4, 'label' => 'Edit/Modification of info in Database'], ['id' => 5, 'label' => 'Returned']];
                    break;
                default:
                    $options = [];
            }

            // Get the label for the selected division
            $officeLabel = $divisionLabels[$office];

            // Join the 'users' table to 'job_info' table based on the 'attending_personnel' field
            $Jobinfos = JobInfo::join('users', 'job_info.attending_personnel', '=', 'users.name')
                ->select('job_info.transaction_code', 'job_info.name', 'job_info.requests', 'job_info.department', 'job_info.remarks')
                ->where('users.office', $office)
                ->whereDate('datetime_accomplished', '>=', $from)
                ->whereDate('datetime_accomplished', '<=', $to)
                ->get();

            // Pass data to the Blade view
            $data = [
                'from' => $from,
                'to' => $to,
                'Jobinfos' => $Jobinfos,
                'options' => $options,
                'officeLabel' => $officeLabel,

            ];

            // Render the Blade view to HTML
            $html = View::make('administrator.all-transactPDF', $data)->render();

            // Initialize TCPDF with landscape orientation
            $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        } elseif ($request->has('generate_all_service')) {
            $office = $request->input('office');

            // Define division labels
            $divisionLabels = [
                1 => 'Creative Works',
                2 => 'IT Repair & Maintenance',
                3 => 'System Development',
            ];

            // Determine the options based on the office
            switch ($office) {
                case 1:
                    $options = [['id' => 1, 'label' => 'Layout Design'], ['id' => 2, 'label' => 'Video Editing'], ['id' => 3, 'label' => 'Audio Visual Presentation'], ['id' => 4, 'label' => 'Audio Editing'], ['id' => 5, 'label' => 'Returned']];
                    break;
                case 2:
                    $options = [['id' => 1, 'label' => 'Upgrade'], ['id' => 2, 'label' => 'Repair (Hardware/Software)'], ['id' => 3, 'label' => 'Network Connection (LAN)'], ['id' => 4, 'label' => 'Format'], ['id' => 5, 'label' => 'Backup/Data Recovery'], ['id' => 6, 'label' => 'Virus (Detection/Cleaning)'], ['id' => 7, 'label' => 'Installation (Hardware/Software)'], ['id' => 8, 'label' => 'Biometrics Registration'], ['id' => 9, 'label' => 'IT Equipment Inspection'], ['id' => 10, 'label' => 'Returned']];
                    break;
                case 3:
                    $options = [['id' => 1, 'label' => 'Data Collection'], ['id' => 2, 'label' => 'Edit Process Program'], ['id' => 3, 'label' => 'Request for System Update/Modification'], ['id' => 4, 'label' => 'Edit/Modification of info in Database'], ['id' => 5, 'label' => 'Returned']];
                    break;
                default:
                    $options = [];
            }

            // Get the label for the selected division
            $officeLabel = $divisionLabels[$office];

            // Join the 'users' table to 'job_info' table based on the 'attending_personnel' field
            $Jobinfos = JobInfo::join('users', 'job_info.attending_personnel', '=', 'users.name')
                ->select('job_info.transaction_code', 'job_info.name', 'job_info.requests', 'job_info.department', 'job_info.remarks')
                ->where('users.office', $office)
                ->whereDate('datetime_accomplished', '>=', $from)
                ->whereDate('datetime_accomplished', '<=', $to)
                ->get();

            // Count occurrences of each option ID within the date range
            $counts = $Jobinfos
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
                'from' => $from,
                'to' => $to,
                'Jobinfos' => $Jobinfos,
                'options' => $optionsWithCounts,
                'officeLabel' => $officeLabel,

            ];
            // Render the Blade view to HTML
            $html = View::make('administrator.all-servicePDF', $data)->render();

            // Initialize TCPDF with landscape orientation
            $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        }

        // Set margins
        $pdf->SetMargins(20, 20, 20);

        // Add a page
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', '', 12);

        // Add content to the PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Output the PDF
        $pdf->Output('generated_pdf.pdf', 'I');
    }

    //FETCH ATTENDING PERSONNEL BASED ON THE OFFICE SELECTED
    public function fetchAttendingPersonnel($office)
    {
        // Fetch attending personnel based on the selected office
        $attendingPersonnel = User::where('office', $office)->get(['id', 'name']);

        // Return attending personnel data as JSON
        return response()->json($attendingPersonnel);
    }

    // BUTTON SUMMARY REQUEST
    public function summaryRequestPDF(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        // Get the selected office from the form
        $office = $request->input('office');

        // Define division labels
        $divisionLabels = [
            1 => 'Creative Works',
            2 => 'IT Repair & Maintenance',
            3 => 'System Development',
        ];

        // Get the label for the selected division
        $officeLabel = $divisionLabels[$office];


        if ($request->has('generate_summary_office')) {

        // Determine the options based on the office
        switch ($office) {
            case 1:
                $options = [['id' => 1, 'label' => 'Layout Design'], ['id' => 2, 'label' => 'Video Editing'], ['id' => 3, 'label' => 'Audio Visual Presentation'], ['id' => 4, 'label' => 'Audio Editing'], ['id' => 5, 'label' => 'Returned']];
                break;
            case 2:
                $options = [['id' => 1, 'label' => 'Upgrade'], ['id' => 2, 'label' => 'Repair (Hardware/Software)'], ['id' => 3, 'label' => 'Network Connection (LAN)'], ['id' => 4, 'label' => 'Format'], ['id' => 5, 'label' => 'Backup/Data Recovery'], ['id' => 6, 'label' => 'Virus (Detection/Cleaning)'], ['id' => 7, 'label' => 'Installation (Hardware/Software)'], ['id' => 8, 'label' => 'Biometrics Registration'], ['id' => 9, 'label' => 'IT Equipment Inspection'], ['id' => 10, 'label' => 'Returned']];
                break;
            case 3:
                $options = [['id' => 1, 'label' => 'Data Collection'], ['id' => 2, 'label' => 'Edit Process Program'], ['id' => 3, 'label' => 'Request for System Update/Modification'], ['id' => 4, 'label' => 'Edit/Modification of info in Database'], ['id' => 5, 'label' => 'Returned']];
                break;
            default:
                $options = [];
        }

        // Join the 'users' table to 'job_info' table based on the 'attending_personnel' field
        $jobInfos = JobInfo::join('users', 'job_info.attending_personnel', '=', 'users.name')
            ->select('job_info.transaction_code', 'job_info.name', 'job_info.requests')
            ->where('users.office', $office)
            ->whereDate('datetime_accomplished', '>=', $from)
            ->whereDate('datetime_accomplished', '<=', $to)
            ->get();

        // Count the total number of transaction codes
        $totalTransactions = $jobInfos->count();

        // Render the Blade view to HTML
        $html = view('administrator.summary-office', compact('jobInfos', 'totalTransactions', 'options', 'from', 'to', 'officeLabel'))->render();

        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        } elseif ($request->has('generate_pending_list')) {

        // Get all jobs with null status for the selected office
            $jobInfos = JobInfo::join('users', 'job_info.attending_personnel', '=', 'users.name')
                ->select('job_info.transaction_code', 'job_info.name', 'job_info.department', 'job_info.problem_statement', 'job_info.no_units')
                ->where('job_info.status', null)
                ->where('users.office', $office)
                ->whereDate('job_info.created_at', '>=', $from)
                ->whereDate('job_info.created_at', '<=', $to)
                ->get();

        $html = view('administrator.pending-listPDF', compact('jobInfos', 'from', 'to', 'officeLabel'))->render();

        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        }elseif ($request->has('generate_all_pending_list')) {

            // Get all jobs with null status
            $jobInfos = JobInfo::whereNull('status')
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->get();

        $html = view('administrator.pending-listPDF', compact('jobInfos', 'from', 'to', 'officeLabel'))->render();

        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        }
        $pdf->SetMargins(20, 20, 20);

        $pdf->AddPage();

        $pdf->SetFont('helvetica', '', 12);

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('summary_of_request_per_office.pdf', 'I');
    }

}

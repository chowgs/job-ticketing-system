<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\JobInfo;
use App\Models\User;


class MonitorController extends Controller
{
    public function index()
    {
        $jobInfos = JobInfo::get();

        return view('monitor.dashboard', compact('jobInfos'));

    }
    // ADMINISTRATOR EDIT A REQUEST BY FINDING THE ID OF THE SELECTED DATA
    public function edit($id)
    {
        $Jobinfo = Jobinfo::findOrFail($id);
        $offices = User::distinct()->pluck('office')->toArray();
        $offices = [
            1 => 'Creative Works',
            2 => 'IT Repair & Maintenance',
            3 => 'System Development',
        ];

        return view('monitor.edit', compact('Jobinfo', 'offices'));
    }

    // UPDATE THE DATA (REQUEST)
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'attending_personnel' => 'string',
        ]);

        $Jobinfo = Jobinfo::findOrFail($id);
        // Update the JobInfo record with the void status and reason
        DB::table('job_info')
            ->where('id', $id)
            ->update([
                'status' => 'Pending',
            ]);
        $Jobinfo->update($validatedData);

        return redirect()->route('monitor.dashboard', $id)->with('success', 'Data updated successfully');
    }

    public function fetchAttendingPersonnel($officeId)
    {
        // Fetch attending personnel based on the selected office ID
        $attendingPersonnel = User::where('office', $officeId)->get(['id', 'name']);
        return response()->json($attendingPersonnel);
    }
}

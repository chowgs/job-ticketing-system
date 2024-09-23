<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jobinfo;

class ClientController extends Controller
{
    //SHOW SYSTEM DEV FORM
    public function showForm()
    {
        return view('system-dev-form');
    }

    //SHOW CREATIVE WORKS FORM
    public function showFormCreative()
    {
        return view('creative-works-form');
    }

    //SHOW IT REPAIR FORM
    public function showFormRepair()
    {
        return view('it-repair-form');
    }

    // GET CURRENT AUTHENTICATED CLIENT'S REQUEST LIST
    public function index(Request $request)
    {
        $userName = auth()->user()->name; // Get the authenticated user's name

        $Jobinfos = Jobinfo::where('name', $userName)
            ->orderBy('date_received', 'desc')
            ->get();

        return view('transaction-list.request', compact('Jobinfos'));
    }

}

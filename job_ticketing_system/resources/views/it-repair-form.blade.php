@extends('layouts.client-layout')

@section('content')
    <title>Client: IT Repair & Maintenance Form</title>

    <div class="form-container">
        <!-- Back Button -->
        <form action="{{ route('save-data-it') }}" method="POST" target="pdf_frame" class="form-item">
            @csrf
            <!-- Display Client's Info -->
            <h3 class="back"><a href="{{ route('dashboard') }}" class="back"><i class="fa-solid fa-arrow-left"></i></a></h3>
            <h3 class="title">CLIENT'S INFORMATION</h3>
            <input type="hidden" id="name" name="name" value="{{ auth()->user()->name }}">
            <input type="hidden" id="email" name="email" value="{{ auth()->user()->email }}">
            <input type="hidden" id="contact_number" name="contact_number" value="{{ auth()->user()->contact_number }}">
            <input type="hidden" id="department" name="department" value="{{ auth()->user()->department }}">
            <p><strong>NAME:</strong> {{ auth()->user()->name }}</p>
            <p><strong>EMAIL:</strong> {{ auth()->user()->email }}</p>
            <p><strong>CONTACT NUMBER:</strong> {{ auth()->user()->contact_number }}</p>
            <p><strong>DEPARTMENT:</strong> {{ auth()->user()->department }}</p>

            <!-- PROBLEM DESCRIPTION -->
            <h3 class="title">ISSUES ENCOUNTERED
                <input type="number" name="no_units" id="no_units" placeholder="No. of Units">
            </h3>
            <textarea name="problem_statement" id="problem_statement" cols="30" rows="10"></textarea>

            <!-- Save Button -->
            <div class="button-container">
                <button type="submit" class="submit-button">Submit & Generate PDF</button>
            </div>
        </form>
        <iframe name="pdf_frame" class="pdf-frame"></iframe>
    </div>
@endsection

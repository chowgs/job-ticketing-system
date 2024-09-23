@extends('layouts.monitor-layout')

@section('content')
    <div class="container-card mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8" id="assignform">
                <form action="{{ route('job_request.update', $Jobinfo->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Client's Info -->
                    <div class="mb-4 border-bottom pb-4">
                        <h3 class="text-lg text-white text-center font-semibold mb-3" id="title-client">CLIENT'S INFO</h3>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label text-white">Name:</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ $Jobinfo->name }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="contact_number" class="form-label text-white">Contact Number:</label>
                                <input type="text" id="contact_number" name="contact_number" class="form-control"
                                    value="{{ $Jobinfo->number }}" readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="department" class="form-label text-white">Department:</label>
                            <input type="text" id="department" name="department" class="form-control"
                                value="{{ $Jobinfo->department }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="problem_statement" class="form-label text-white">Issue/Request:</label>
                            <input type="text" id="problem_statement" name="problem_statement" class="form-control"
                                value="{{ $Jobinfo->problem_statement }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="transaction_code" class="form-label text-white">Transaction No:</label>
                            <input type="text" id="transaction_code" name="transaction_code" class="form-control"
                                value="{{ $Jobinfo->transaction_code }}" readonly>
                        </div>

                    <!-- Office -->
                    <div class="mb-3">
                            <label for="office" class="form-label text-white">Office:</label>
                            <select id="office" name="office" class="form-select">
                                <option value="" selected disabled>Select Office</option>
                                @foreach ($offices as $key => $office)
                                    <option value="{{ $key }}" {{ $Jobinfo->office == $key ? 'selected' : '' }}>
                                        {{ $office }}</option>
                                @endforeach
                            </select>
                            <label for="attending_personnel" class="form-label text-white">Attending Personnel:</label>
                            <select id="attending_personnel" name="attending_personnel" class="form-select">
                            </select>
                    </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn-update">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

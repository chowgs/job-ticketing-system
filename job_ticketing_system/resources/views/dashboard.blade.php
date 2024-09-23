@extends('layouts.client-layout')

@section('content')
    <title>Client: Services</title>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('creative-works-form') }}" class="text-decoration-none text-dark">
                <div class="card mb-4" style="background-image: url('images/creative-bg.jpg')">
                    <div class="card-overlay">
                        <h5 class="card-title">Creative Works</h5>
                        <p class="card-text">Click here for Creative Works services.</p>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('it-repair-form') }}" class="text-decoration-none text-dark">
                <div class="card mb-4" style="background-image: url('images/it-bg.jpg')">
                    <div class="card-overlay">
                        <h5 class="card-title">IT Repair & Maintenance</h5>
                        <p class="card-text">Click here for IT Repair & Maintenance services.</p>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('system-dev-form') }}" class="text-decoration-none text-dark">
                <div class="card mb-4" style="background-image: url('images/sys-bg.jpg')">
                    <div class="card-overlay">
                        <h5 class="card-title">System Development</h5>
                        <p class="card-text">Click here for System Development services.</p>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>
@endsection

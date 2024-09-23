<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Data Tables CSS CDN-->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.bootstrap5.css">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Sans:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
<style>
        body {
            background-color: #2C4E80;
            font-family: "Ubuntu Sans", sans-serif;
            font-weight: 500;
        }
        .navbar {
            background-color: #23408E;
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: #FFC55A;
        }
        .nav-link:hover {
            color: #fff;
        }
        .truncate {
            max-width: 100px; /* Set the maximum width of the cell */
            white-space: nowrap; /* Prevent the text from wrapping */
            overflow: hidden; /* Hide any overflow */
            text-overflow: ellipsis; /* Add ellipsis (...) for overflowed text */
        }
        .card {
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.3s ease;
            box-shadow: #F46A34 10px 10px;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-title {
            color: #F46A34;
        }
        .dropdown-menu {
            background-color: #23408E;
        }
        .dropdown-menu a {
            color: #FFC55A;
        }
        .dropdown-menu a:hover {
            background-color: #FFC55A;
            color: #23408E;
        }
        div.dt-container .dt-paging .dt-paging-button {
                padding: 0px !important;
                margin: 0px !important;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            color: #000;
            font-weight: bold;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .title-head {
            background-color: #F46A34;
            color: #fff;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
            padding: 10px;
            letter-spacing: 3px;
            text-align: center;
        }
        .form-label {
            color: #000000;
        }
        .form-control {
            background-color: #6a6a6a;
            color: #fff;
            border: 2px solid #ccc;
            border-radius: 4px;
        }
        .btn-update, .btn-pdf {
            background-color: #FFC55A;
            color: #23408E;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-update:hover, .btn-pdf:hover {
            background-color: #23408E;
            color: #FFC55A;
        }
        .service-card {
            background-color: #6a6a6a;
            padding: 20px;
            color: #fff;
        }
        .back {
            float: left;
            text-decoration: none;
            color: #fff;
        }
        .back:hover{
            color: #23408E;
        }
        .editcard {
            background-color: #bbbbbb
        }
        .editcard-body {
            padding: 20px;
        }
            /* Form Container */
            .form-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        .form-item {
            margin-bottom: 20px;
        }
        .form-item p {
            margin-bottom: 5px;
            font-size: 14px;
            color: #666;
        }
        .form-item textarea {
            height: 150px;
            width: 100%;
            padding: 1px;
            border-radius: 4px;
            border: 1px solid #ccc;
            resize: vertical;
            background-color: #ffe7bb;
        }
        .form-item .back {
            color: #333;
            text-decoration: none;
        }
        .form-item .submit-button {
            padding: 10px 20px;
            background-color: #4a4a4a;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            float: right;
            margin-bottom: 10px;
        }
        .form-item .submit-button:hover {
            background-color: #F46A34;
        }
        .form-item .title-head {
            margin-top: 20px;
            font-size: 20px;
            color: #333;
        }
        /* Iframe */
        .pdf-frame {
            width: 100%;
            height: 650px;
            border: none;
        }
        .title {
            color: white;
            background-color: #F46A34;
            padding: 10px;
            font-size: 18px;
            margin-bottom: 10px;
        }
        .back {
            margin-left: 5px;
            margin-right: 5px;
            margin-top: 2px;
        }
        .fa-eye:hover, .fa-user-pen:hover, .fa-pen-to-square:hover, .fa-file-pdf:hover {
            color: #FFC55A !important;

        }
        .hidden {
            display: none;
        }
</style>

</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <p class="navbar-brand">IT Personnel</p>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Status of Request |</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.assignedTask') }}">Assigned Task |</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.reports') }}">Reports |</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<br><br>
{{-- Service/s --}}
@if(auth()->user()->office == 1)
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('admin.it-repair-form') }}" class="text-decoration-none text-dark">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">IT Repair & Maintenance</h5>
                        <p class="card-text">Click here for IT Repair & Maintenance services.</p>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('admin.system-dev-form') }}" class="text-decoration-none text-dark">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">System Development</h5>
                        <p class="card-text">Click here for System Development services.</p>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>
@elseif(auth()->user()->office == 2)
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('admin.creative-works-form') }}" class="text-decoration-none text-dark">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Creative Works</h5>
                        <p class="card-text">Click here for Creative Works services.</p>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('admin.system-dev-form') }}" class="text-decoration-none text-dark">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">System Development</h5>
                        <p class="card-text">Click here for System Development services.</p>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>
@elseif(auth()->user()->office == 3)
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('admin.creative-works-form') }}" class="text-decoration-none text-dark">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Creative Works</h5>
                        <p class="card-text">Click here for Creative Works services.</p>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('admin.it-repair-form') }}" class="text-decoration-none text-dark">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">IT Repair & Maintenance</h5>
                        <p class="card-text">Click here for IT Repair & Maintenance services.</p>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>
@endif

    {{-- Main Content --}}
    @yield('content')

<!-- Jquery JS CDN  -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<!-- Data Tables JS CDN -->
<script src="https://cdn.datatables.net/2.0.6/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.6/js/dataTables.bootstrap5.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
<!-- Font Awesome JS CDN-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
{{--Timestamp JS--}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const timestamps = document.querySelectorAll('[id^="timestamp-"]');

        timestamps.forEach(timestamp => {
            const receivedAt = new Date(timestamp.innerText + ' UTC');
            const now = new Date();
            const diff = Math.abs(now - receivedAt);
            const seconds = Math.floor(diff / 1000);
            const minutes = Math.floor(seconds / 60);
            const hours = Math.floor(minutes / 60);
            const days = Math.floor(hours / 24);
            let displayTime;
            if (days > 0) {
                displayTime = days + " days ago";
            } else if (hours > 0) {
                displayTime = hours + " hours ago";
            } else if (minutes > 0) {
                displayTime = minutes + " minutes ago";
            } else {
                displayTime = seconds + " seconds ago";
            }
            timestamp.innerText = displayTime;
        });
    });
</script>
{{--HIDE Released and Voided from Assigned Task Table--}}
<script>
    $(document).ready(function() {
        // Show only 'Pending' rows initial
        function filterRows() {
            $('.status-Released, .status-Voided').addClass('hidden');
            $('.status-Pending').removeClass('hidden');
        }

        // Trigger the filter function on page load
        filterRows();

        // Handle status filter change event
        $('#status-filter').change(function() {
            var selectedStatus = $(this).val();
            if (selectedStatus === 'Pending') {
                $('.status-Released, .status-Voided').addClass('hidden');
                $('.status-Pending').removeClass('hidden');
            } else if (selectedStatus === 'Released') {
                $('.status-Pending, .status-Voided').addClass('hidden');
                $('.status-Released').removeClass('hidden');
            } else if (selectedStatus === 'Voided') {
                $('.status-Pending, .status-Released').addClass('hidden');
                $('.status-Voided').removeClass('hidden');
            } else {
                $('.status-Pending, .status-Released, .status-Voided').removeClass('hidden');
            }
        });
    });
</script>
</body>
</html>

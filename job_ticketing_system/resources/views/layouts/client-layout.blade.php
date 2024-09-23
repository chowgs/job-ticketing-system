<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS CDN-->
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
        .card {
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.3s ease;
            height: 700px;
            background-size: cover;
            background-position: center;
            position: relative;
            overflow: hidden;
        }
        .card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            transition: opacity 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            text-align: center;
        }
        .card:hover .card-overlay {
            opacity: 0;
        }
        .card-title {
            color: #fff;
        }
        .card-text {
            color: #fff;
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
        .truncate {
                max-width: 100px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
        }
        .tablecard{
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.3s ease;
            box-shadow: #F46A34 10px 10px;
            background-color: #fff;
            padding: 5px;
        }
        .tablecard:hover {
            transform: translateY(-5px);
        }
        .tablecard-title {
            color: #F46A34;
            margin-left: 10px;
        }
        .tablecard-text {
            margin-left: 10px;
        }
        div.dt-container .dt-paging .dt-paging-button {
                padding: 0px !important;
                margin: 0px !important;
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
            background-color: #F46A34;
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
            background-color: #8f472b;
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
        .button-container {
            display: flex;
            justify-content: center;
        }
        #no_units {
            border: none;
            border-radius: 4px;
            max-width: 18%;
            padding: 5px;
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
            <p class="navbar-brand">Client</p>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Services |</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('job_info.request') }}">Status of Request |</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </li>
                </div>
            </ul>
        </div>
        </nav>

    {{--Main Content--}}
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

<!-- Bootstrap JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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

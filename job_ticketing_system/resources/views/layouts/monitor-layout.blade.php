<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor: Unassigned Request</title>
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
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Sans:ital,wght@0,100..800;1,100..800&display=swap">
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

        .navbar-brand,
        .navbar-nav .nav-link {
            color: #FFC55A;
        }

        .nav-link:hover {
            color: #fff;
        }

        .action {
            text-align: center;
        }

        .truncate {
            max-width: 100px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
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

        th,
        td {
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

        div.dt-container .dt-paging .dt-paging-button {
            padding: 0px !important;
            margin: 0px !important;
        }

        .circle-icons p {
            display: inline-block;
        }

        .fa-eye:hover, .fa-user-pen:hover {
            color: #FFC55A !important;
        }
        .assign-btn {
            margin-top: 5px;
        }
        #assignform {
            background-color: #ffffff;
            padding: 25px;
            max-width: 35%;
            border: none;
            border-radius: 4px;

        }
        .form-select {
            border-radius: 2px 4px 6px;
            border-bottom-color: #23408E;
            border-right-color: #23408E;
        }
        .form-control{
            border-radius: 2px 4px 6px;
            border-bottom-color: #F46A34;
            border-right-color: #F46A34;
        }
        #title-client {
            letter-spacing: 3px;
            font-weight: bolder;
            background-color: #23408E;
            padding: 5px;
        }
        .text-center {

        }
        .btn-update {
            background-color: #23408E;
            border-radius: 4px;
            border: none;
            color: #fff;
            text-align: center;
            width: 200px;
            padding: 10px;
            margin-bottom: 10px;
            margin-top: 0px;
        }
        .btn-update:hover {
            background-color: #192f6a;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Monitor</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('monitor.dashboard') }}">Monitoring Unassigned Request |</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                            </li>
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

    @yield('content')
    <!-- Jquery JS CDN  -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Data Tables JS CDN -->
    <script src="https://cdn.datatables.net/2.0.6/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.6/js/dataTables.bootstrap5.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Script For View Modal --}}
    <script>
        document.querySelectorAll('.view').forEach(item => {
            item.addEventListener('click', event => {
                const name = item.getAttribute('data-name');
                const number = item.getAttribute('data-number');
                const problem = item.getAttribute('data-problem');
                const remarks = item.getAttribute('data-remarks');
                const datetimeStarted = item.getAttribute('data-datetime-started');
                const datetimeAccomplished = item.getAttribute('data-datetime-accomplished');
                const transactionCode = item.getAttribute('data-transaction-code');
                const units = item.getAttribute('data-units');
                const status = item.getAttribute('data-status');

                document.getElementById('modalName').textContent = name;
                document.getElementById('modalNumber').textContent = number;
                document.getElementById('modalProblem').textContent = problem;
                document.getElementById('modalRemarks').textContent = remarks;
                document.getElementById('modalDatetimeStarted').textContent = datetimeStarted;
                document.getElementById('modalDatetimeAccomplished').textContent = datetimeAccomplished;
                document.getElementById('modalTransactionCode').textContent = transactionCode;
                document.getElementById('modalUnits').textContent = units;
                document.getElementById('modalStatus').textContent = status;
            });
        });
    </script>
    {{-- Dropdown Office --}}
    <script>
        // AJAX request to fetch attending personnel based on selected office
        document.getElementById('office').addEventListener('change', function() {
            var officeId = this.value;
            var attendingPersonnelDropdown = document.getElementById('attending_personnel');

            // Clear existing options
            attendingPersonnelDropdown.innerHTML = '';

            // Add default option "Select Personnel"
            var defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Select Personnel';
            defaultOption.selected = true;
            defaultOption.disabled = true;
            attendingPersonnelDropdown.appendChild(defaultOption);

            // Fetch attending personnel based on selected office using AJAX
            fetch('/fetch-attending-personnel/' + officeId)
                .then(response => response.json())
                .then(data => {
                    // Populate attending personnel dropdown with fetched data
                    data.forEach(person => {
                        var option = document.createElement('option');
                        option.value = person.name; // Set the user's name as the option value
                        option.textContent = person.name;
                        attendingPersonnelDropdown.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
    {{-- HIDE Released and Voided from Assigned Task Table --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hide rows with status "Released" or "Voided" initially
            const hiddenRows = document.querySelectorAll('#tableBody tr.hidden');
            hiddenRows.forEach(row => row.style.display = 'none');
        });
    </script>
</body>
</body>

</html>

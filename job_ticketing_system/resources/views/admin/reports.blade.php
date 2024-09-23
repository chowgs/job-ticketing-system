<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Personnel: Reports</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Sans:ital,wght@0,100..800;1,100..800&display=swap"
        rel="stylesheet">
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

        .truncate {
            max-width: 100px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
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

        .btn-container {
            text-align: center;
        }

        .btn {
            background-color: #F46A34;
            color: #fff;
        }

        .btn:hover {
            background-color: #923f1e;
            color: #fff;

        }
    </style>

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <p class="navbar-brand">IT Personnel</p>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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

    {{-- Main Content --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('service_pdf') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <h4 align="center">Service Report</h4>
                                <label for="from" class="form-label">From:</label>
                                <input type="date" class="form-control" id="from" name="from" required>
                            </div>
                            <div class="mb-3">
                                <label for="to" class="form-label">To:</label>
                                <input type="date" class="form-control" id="to" name="to" required>
                            </div>
                            <div class="btn-container">
                                <h6>Generate PDF for List of Service</h6>
                                <button type="submit" name="generate_service" class="btn">Generate Service</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('transact_pdf') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <h4 align="center">Transaction Report</h4>
                                <label for="from" class="form-label">From:</label>
                                <input type="date" class="form-control" id="from" name="from" required>
                            </div>
                            <div class="mb-3">
                                <label for="to" class="form-label">To:</label>
                                <input type="date" class="form-control" id="to" name="to" required>
                            </div>
                            <div class="btn-container">
                                <h6>Generate PDF for List of Transactions</h6>
                                <button type="submit" name="generate_transaction" class="btn">Generate
                                    Transaction</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Personnel: IT & Repair Maintenance</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Data Tables CSS CDN-->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.bootstrap5.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #2C4E80;
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

        /* Form Container */
        .form-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
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

        .form-item {
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
            float: left;
            text-decoration: none;
            color: #484848;
        }

        .back:hover {
            color: #ffffff;
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
    </style>

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">IT Personnel</a>
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


    <div class="form-container">
        <!-- Back Button -->
        <form action="{{ route('save-data-it') }}" method="POST" target="pdf_frame" class="form-item">
            @csrf
            <!-- Display Client's Info -->
            <h3 class="back"><a href="{{ route('dashboard') }}" class="back"><i
                        class="fa-solid fa-arrow-left"></i></a></h3>
            <h3 class="title">CLIENT'S INFORMATION</h3>
            <input type="hidden" id="name" name="name" value="{{ auth()->user()->name }}">
            <input type="hidden" id="email" name="email" value="{{ auth()->user()->email }}">
            <input type="hidden" id="contact_number" name="contact_number"
                value="{{ auth()->user()->contact_number }}">
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
            <button type="submit" class="submit-button">Submit and Generate</button>
        </div>
        </form>
        <iframe name="pdf_frame" class="pdf-frame"></iframe>
    </div>

    <!-- Font Awesome JS CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

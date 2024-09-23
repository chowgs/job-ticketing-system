    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administrator: Reports</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                max-width: 140%;
                height: 100%;
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

            .btns {
                background-color: #F46A34;
                color: white;
                padding: 8px 16px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                text-align: center;
                margin-bottom: 5px;
                width: 60%;
            }

            .btn-container,
            .btn-gen-container {
                text-align: center;
            }

            .all-btn-container {
                text-align: center;
            }

            .btn-gen {
                text-align: center;
                background-color: #F46A34;
                color: white;
                padding: 8px 16px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                text-align: center;
                margin-bottom: 5px;
                width: 60%;
            }

            .btns:hover,
            .btn-gen:hover {
                background-color: #9d4522;
                color: white;
            }
            .attending_personnel, .office {
                border:solid #F46A34;
                border-radius: 4px;
                padding: 4px;
                margin-bottom: 4px;
                max-width: 41%;
            }
            .dropdown {
                display: flex;
            justify-content: center;
            }
        </style>

    </head>

    <body>
        {{-- Nav bar --}}
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="#">Administrator</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('administrator.dashboard') }}">User Management |</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('administrator.void-request') }}">Void Request Management
                                |</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('administrator.void-list') }}">Void List |</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.reports') }}">Reports |</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('administrator.department') }}">Department Management
                                |</a>
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
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <br><br><br>

        {{-- Main Content --}}
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('administrator_service_pdf') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <h4 align="center" class="card-title">Copy of List</h4>
                                    <label for="from" class="form-label">From:</label>
                                    <input type="date" class="form-control" id="from" name="from" required>
                                </div>
                                <div class="mb-3">
                                    <label for="to" class="form-label">To:</label>
                                    <input type="date" class="form-control" id="to" name="to" required>
                                </div>
                                {{-- Division --}}
                                <div class="dropdown">
                                    <select id="office" name="office" class="office">
                                        <option value="" selected disabled>Select Division</option>
                                        <option value="1">Creative Works</option>
                                        <option value="2">IT Repair & Maintenance</option>
                                        <option value="3">System Development</option>
                                    </select>
                                </div>
                                {{-- Attending Personnel --}}
                                <div class="dropdown">
                                    <select id="attending_personnel" name="attending_personnel"
                                        class="attending_personnel">
                                        <option value="" class="" selected disabled>Select Personnel</option>
                                    </select>
                                </div><br>
                                <div class="btn-container">
                                    <h6>Generate PDF for each IT Personnel</h6>
                                    <button type="submit" name="generate_service" class="btns">
                                        Service List</button>
                                    <button type="submit" name="generate_transaction" class="btns">
                                        Transaction List</button>
                                </div>
                                <div class="all-btn-container">
                                    <h6>Generate PDF for each Division</h6>
                                    <button type="submit" name="generate_all_service" class="btns">
                                        By Division Service</button>
                                    <button type="submit" name="generate_all_transaction" class="btns">
                                        By Division Transaction</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('administrator_summary_pdf') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <h4 align="center" class="card-title">Summary of Request</h4>
                                    <label for="from" class="form-label">From:</label>
                                    <input type="date" class="form-control" id="from" name="from"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="to" class="form-label">To:</label>
                                    <input type="date" class="form-control" id="to" name="to"
                                        required>
                                </div>
                                <div class="dropdown">
                                    <select id="office" name="office" class="office">
                                        <option value="" selected disabled>Select Division</option>
                                        <option value="1">Creative Works</option>
                                        <option value="2">IT Repair & Maintenance</option>
                                        <option value="3">System Development</option>
                                    </select>
                                </div><br>
                                <div class="btn-gen-container">
                                    <h6>Generate PDF for each Division</h6>
                                    <button type="submit" name="generate_summary_office" class="btn-gen">
                                        Office Requests</button>
                                    <button type="submit" name="generate_pending_list" class="btn-gen">Pending
                                        Request List</button>
                                    <h6>Generate PDF for All Divison</h6>
                                    <button type="submit" name="generate_all_pending_list" class="btn-gen">Pending
                                        Request List</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        {{-- For personnel dropdown JS --}}
        <script>
            document.getElementById('office').addEventListener('change', function() {
                var officeId = this.value;
                var attendingPersonnelDropdown = document.getElementById('attending_personnel');

                // Clear existing options
                attendingPersonnelDropdown.innerHTML = '';

                // Fetch attending personnel based on selected office using AJAX
                fetch('/fetch-attending-personnel/' + officeId)
                    .then(response => response.json())
                    .then(data => {
                        // Populate attending personnel dropdown with fetched data
                        data.forEach(person => {
                            var option = document.createElement('option');
                            option.value = person.id;
                            option.textContent = person.name;
                            attendingPersonnelDropdown.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error:', error));
            });
        </script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>

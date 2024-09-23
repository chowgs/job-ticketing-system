<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator: Department Management</title>
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
        /* Search Table */
        .form-input {
            border-radius: 0;
            border-top-right-radius: 0.375rem;
            border-bottom-right-radius: 0.375rem;
        }
        div.dt-container .dt-paging .dt-paging-button {
                padding: 0px !important;
                margin: 0px !important;
        }
        .addDept {
            background-color: #F46A34;
            border: 1px solid #F46A34;
            border-top-left-radius: 6px;
            border-top-right-radius: 25px;
            border-bottom-right-radius: 25px;
            border-bottom-left-radius: 6px;
            color: #fff;
            padding: 10px;
        }
        .addDept:hover {
            background-color: #cd5a2c;
        }
</style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Administrator</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('administrator.dashboard') }}">User Management |</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('administrator.void-request') }}">Void Request Management |</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('administrator.void-list') }}">Void List |</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('administrator.reports') }}">Reports |</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('administrator.department') }}">Department Management |</a>
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

<!-- Main Content -->
<div class="py-12 d-flex justify-content-center">
    <div class="container">
        <div class="card">
            <div class="card-body table-responsive">
                <div class="row mb-4">
                    <div class="col-md-6 text-start">
                        <button type="button" class="addDept" data-bs-toggle="modal" data-bs-target="#addDepartmentModal">
                            Add New Department
                        </button>
                    </div>
                </div>
                <table id="myTable" class="table table-bordered hover">
                    <thead>
                        <tr>
                            <th>Acronym</th>
                            <th>Department Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @if($departments->isEmpty())
                            <tr>
                                <td colspan="3" class="text-center">No available department</td>
                            </tr>
                        @else
                            @foreach($departments->chunk(8) as $chunk)
                                @foreach($chunk as $department)
                                    <tr>
                                        <td>{{ $department->dept_acronym }}</td>
                                        <td class="truncate">{{ $department->dept_name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editDepartmentModal{{ $department->id }}">
                                                Edit
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Modal for Editing Department -->
                                    <div class="modal fade" id="editDepartmentModal{{ $department->id }}" tabindex="-1" aria-labelledby="editDepartmentModalLabel{{ $department->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editDepartmentModalLabel{{ $department->id }}">Edit Department</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('updateDepartment', $department->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="editDepartmentInput{{ $department->id }}" class="form-label">Department:</label>
                                                            <input type="text" name="dept_acronym" class="form-control" id="editDepartmentInput{{ $department->id }}" value="{{ $department->dept_acronym }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="editDepartmentName{{ $department->id }}" class="form-label">Department Name:</label>
                                                            <input type="text" name="dept_name" class="form-control" id="editDepartmentName{{ $department->id }}" value="{{ $department->dept_name }}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        @endif
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

    <!-- Modal for Adding New Department -->
    <div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDepartmentModalLabel">Add New Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('storeDepartment') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="departmentInput" class="form-label">Department:</label>
                            <input type="text" name="dept_acronym" class="form-control" id="departmentInput" placeholder="Add department acronym">
                        </div>
                        <div class="mb-3">
                            <label for="departmentName" class="form-label">Department Name:</label>
                            <input type="text" name="dept_name" class="form-control" id="departmentName" placeholder="Add department name">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
<!-- Font Awesome JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

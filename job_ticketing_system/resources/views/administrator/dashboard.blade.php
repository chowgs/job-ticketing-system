@extends('layouts.administrator-layout')

@section('content')
    <title>Administrator: User Management</title>

<div class="py-12 d-flex justify-content-center">
    <div class="container">
        <div class="card">
            <div class="card-body table-responsive">
                <table id="myTable" class="table table-bordered table hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact No.</th>
                            <th>Department</th>
                            <th>UserType</th>
                            <th>Office</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="truncate">{{ $user->name }}</td>
                            <td class="truncate">{{ $user->email }}</td>
                            <td class="truncate">{{ $user->contact_number }}</td>
                            <td class="truncate">{{ $user->department }}</td>
                            <td>
                            <form action="{{ route('saveUserType', $user->id) }}" method="POST">
                                @csrf
                                <select class="form-select" name="usertype">
                                    <option value="client" {{ $user->usertype == 'client' ? 'selected' : '' }}>Client</option>
                                    <option value="admin" {{ $user->usertype == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="administrator" {{ $user->usertype == 'administrator' ? 'selected' : '' }}>Administrator</option>
                                    <option value="monitor" {{ $user->usertype == 'monitor' ? 'selected' : '' }}>Monitor</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-select" name="office">
                                    <option value="">None</option>
                                    <option value="1" {{ $user->office == '1' ? 'selected' : '' }}>Creative Works</option>
                                    <option value="2" {{ $user->office == '2' ? 'selected' : '' }}>IT Repair & Maintenance</option>
                                    <option value="3" {{ $user->office == '3' ? 'selected' : '' }}>System Development</option>
                                </select>
                            </td>
                            <td style="text-align: center">
                                <button type="submit" class="btn"><i class="fa-solid fa-floppy-disk fa-2xl" style="color: #0857aa;"></i></button>
                            </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
@endsection

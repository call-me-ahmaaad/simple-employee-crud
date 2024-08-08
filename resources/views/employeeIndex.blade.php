@extends('layouts.main')
@section('head')
    <link rel="stylesheet" href="{{ URL::asset('/css/employeeIndex.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
@endsection
@section('container')
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if (session('success'))
                    Swal.fire({
                        icon: "success",
                        title: "Done!",
                        html: "{!! session('success') !!}",
                        timer: 3000
                    });
                @endif
            });
        </script>
    @endif

    <div class="container">
        <div class="header">
            <h1>SIMPLE EMPLOYEE CRUD</h1>
            <a href="{{ route('employee.add') }}" class="btn addEmployee">Add New Employee</a>
        </div>
        <table id="employeeTable" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Birth Date</th>
                    <th>Position</th>
                    <th>Phone Number</th>
                    <th>Religion</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee['id'] }}</td>
                        <td>{{ $employee['name'] }}</td>
                        <td>{{ $employee['birth_date'] }}</td>
                        <td>{{ $employee['position'] }}</td>
                        <td>{{ $employee['phone_number'] }}</td>
                        <td>{{ $employee['religion'] }}</td>
                        <td>
                            <a href="employee-edit/{{ $employee['id'] }}" class="act update">UPDATE</a>
                            <a href="employee-delete/{{ $employee['id'] }}" class="act delete">DELETE</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <script>
            $(document).ready(function() {
                // Configuration object to map screen height to pageLength
                var pageLengthConfig = {
                    768: 8,
                    675: 7,
                    594: 6,
                    495: 4,
                    default: 9 // Default page length for larger heights
                };

                function getPageLength() {
                    var screenHeight = window.innerHeight;

                    // Find the appropriate page length based on screen height
                    for (var height in pageLengthConfig) {
                        if (screenHeight <= height) {
                            return pageLengthConfig[height];
                        }
                    }

                    return pageLengthConfig.default; // Return default if no match found
                }

                function initializeDataTable() {
                    var pageLength = getPageLength();

                    $('#employeeTable').DataTable({
                        "paging": true,
                        "searching": true,
                        "ordering": true,
                        "info": true,
                        "pageLength": pageLength,
                        "lengthChange": false,
                        pagingType: 'full_numbers',
                        destroy: true // Allow reinitialization of the table
                    });
                }

                // Initialize DataTable on page load
                initializeDataTable();

                // Reinitialize DataTable on window resize
                $(window).resize(function() {
                    $('#employeeTable').DataTable().destroy();
                    initializeDataTable();
                });
            });
        </script>
    </div>
@endsection

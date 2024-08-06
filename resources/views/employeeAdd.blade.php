@extends('layouts.main')
@section('head')
    <link rel="stylesheet" href="{{ URL::asset('/css/employeeForm.css') }}">
@endsection
@section('container')
    <!-- Display error messages -->
    @if ($errors->any())
        <script>
            let errorMessage = '<ul style="text-align: left;">';
            @foreach ($errors->all() as $error)
                errorMessage += '<li>{!! $error !!}</li>';
            @endforeach
            errorMessage += '</ul>';

            Swal.fire({
                icon: "error",
                title: "Oops...",
                html: errorMessage, // Use html to render the <ul> and <li> tags
                timer: 3000
            });
        </script>
    @endif


    <div class="container">
        <h2>ADD NEW EMPLOYEE</h2>
        <form class="employeeForm Add" id="addForm" action="{{ route('employee.store') }}" method="POST" novalidate>
            @csrf
            <div class="inputField name">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required placeholder="Enter employee name">
            </div>
            <div class="inputField birthDate">
                <label for="birth_date">Birth Date</label>
                <input type="date" name="birth_date" id="birth_date" required>
            </div>
            <div class="inputField position">
                <label for="position">Position</label>
                <select name="position" id="position" required>
                    @php
                        $positions = ['Operator', 'Leader', 'Supervisor', 'Manager', 'Director'];
                    @endphp
                    @foreach ($positions as $position)
                        <option value="{{ $position }}">{{ $position }}</option>
                    @endforeach
                </select>
            </div>
            <div class="inputField phoneNumber">
                <label for="phone_number">Phone Number</label>
                <input type="tel" name="phone_number" id="phone_number" pattern="[0-9]{4}-[0-9]{4}-[0-9]{2,5}"
                    placeholder="0812-3456-7891" required>
            </div>
            <div class="inputField religion">
                <label for="religion">Religion</label>
                <select name="religion" id="religion" required>
                    @php
                        $religions = ['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
                    @endphp
                    @foreach ($religions as $religion)
                        <option value="{{ $religion }}">{{ $religion }}</option>
                    @endforeach
                </select>
            </div>
            <div class="action">
                <button class="btnForm cancel" type="button"
                    onclick="location.href='{{ route('employee.index') }}'">Cancel</button>
                <button class="btnForm submit" type="submit">Submit</button>
            </div>
        </form>
    </div>
    <script>
        document.getElementById('addForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission
            const form = this;
            Swal.fire({
                title: "Add New Employee?",
                text: "Are you sure you want to add this new employee?",
                icon: "question",
                confirmButtonText: "Yes, add it!",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form manually
                    form.submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: "Cancelled!",
                        text: "The addition of the new employee has been cancelled.",
                        icon: "error"
                    });
                }
            });
        });
    </script>
@endsection

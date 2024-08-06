@extends('layouts.main')
@section('head')
    <link rel="stylesheet" href="{{ URL::asset('/css/employeeForm.css') }}">
@endsection
@section('container')
    <!-- Display error messages -->
    @if ($errors->any())
        <script>
            let errorMessage = '';
            @foreach ($errors->all() as $error)
                errorMessage += '{{ $error }}\n';
            @endforeach

            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: errorMessage,
                timer: 3000
            });
        </script>
    @endif

    <div class="container">
        <h1>DELETE EMPLOYEE DATA</h1>
        <form class="employeeForm Delete" id="deleteForm" action="{{ route('employee.destroy', $employee->id) }}"
            method="POST">
            @csrf
            @method('DELETE')
            <div class="inputField name">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ $employee->name }}" readonly>
            </div>
            <div class="inputField birthDate">
                <label for="birth_date">Birth Date</label>
                <input type="date" name="birth_date" id="birth_date" value="{{ $employee->birth_date }}" readonly>
            </div>
            <div class="inputField position">
                <label for="position">Position</label>
                <input type="text" name="position" id="position" value="{{ $employee->position }}" readonly>
            </div>
            <div class="inputField phoneNumber">
                <label for="phone_number">Phone Number</label>
                <input type="tel" name="phone_number" id="phone_number" value="{{ $employee->phone_number }}" readonly>
            </div>
            <div class="inputField religion">
                <label for="religion">Religion</label>
                <input type="text" name="religion" id="religion" value="{{ $employee->religion }}" readonly>
            </div>
            <div class="action">
                <button class="btnForm cancel" type="button"
                    onclick="location.href='{{ route('employee.index') }}'">Cancel</button>
                <button class="btnForm submit" type="submit">Submit</button>
            </div>
        </form>
    </div>
    <script>
        document.getElementById('deleteForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission
            const form = this;
            Swal.fire({
                title: "Delete Employee Data?",
                text: "Are you sure you want to delete this employee's data? This action cannot be undone.",
                icon: "warning",
                confirmButtonText: "Yes, delete it!",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form manually
                    form.submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: "Cancelled!",
                        text: "The employee deletion has been cancelled.",
                        icon: "error"
                    });
                }
            });
        });
    </script>
@endsection

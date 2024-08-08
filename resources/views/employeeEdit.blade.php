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
        <h2>EDIT EMPLOYEE DATA</h2>
        <form class="employeeForm Edit" id="editForm" action="{{ route('employee.update', $employee->id) }}" method="POST"
            novalidate>
            @csrf
            @method('PUT')
            <div class="inputField name">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ $employee->name }}" required>
            </div>
            <div class="inputField birthDate">
                <label for="birth_date">Birth Date</label>
                <input type="date" name="birth_date" id="birth_date" value="{{ $employee->birth_date }}" required>
            </div>
            <div class="inputField position">
                <label for="position">Position</label>
                <select name="position" id="position" required>
                    <option value="{{ $employee->position }}">{{ $employee->position }}</option>
                    @php
                        $positions = ['Operator', 'Leader', 'Supervisor', 'Manager', 'Director'];
                    @endphp
                    @foreach ($positions as $position)
                        @if ($position != $employee->position)
                            <option value="{{ $position }}">{{ $position }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="inputField phoneNumber">
                <label for="phone_number">Phone Number</label>
                <input type="tel" name="phone_number" id="phone_number" pattern="[0-9]{4}-[0-9]{4}-[0-9]{2,5}"
                    placeholder="0812-3456-7891" value="{{ $employee->phone_number }}" required>
            </div>
            <div class="inputField religion">
                <label for="religion">Religion</label>
                <select name="religion" id="religion" required>
                    <option value="{{ $employee->religion }}">{{ $employee->religion }}</option>
                    @php
                        $religions = ['Islam', 'Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
                    @endphp
                    @foreach ($religions as $religion)
                        @if ($religion != $employee->religion)
                            <option value="{{ $religion }}">{{ $religion }}</option>
                        @endif
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
        document.getElementById('editForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission
            const form = this;
            Swal.fire({
                title: "Update {{ $employee->name }} data?",
                text: "Are you sure you want to update this employee data?",
                icon: "question",
                confirmButtonText: "Yes, update it!",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form via AJAX
                    $.ajax({
                        url: form.action,
                        method: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            Swal.fire({
                                title: "Success!",
                                html: response.success,
                                icon: "success",
                                timer: 3000
                            }).then(() => {
                                window.location.href = "{{ route('employee.index') }}";
                            });
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                let errorMessage = '<ul style="text-align: left;">';
                                const errors = xhr.responseJSON.errors;
                                for (let field in errors) {
                                    if (errors.hasOwnProperty(field)) {
                                        errorMessage += '<li>' + errors[field][0] + '</li>';
                                    }
                                }
                                errorMessage += '</ul>';

                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    html: errorMessage,
                                    timer: 3000
                                });
                            }
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: "Cancelled!",
                        text: "The employee update has been cancelled.",
                        icon: "error"
                    });
                }
            });
        });
    </script>
@endsection

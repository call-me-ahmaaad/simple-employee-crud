<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function web_employee_index()
    {
        return view("employeeIndex", [
            "employees" => Employee::all()
        ]);
    }

    public function web_employee_add()
    {
        return view("employeeAdd");
    }

    public function web_employee_store(Request $request)
    {
        $messages = [
            'name.required' => 'The <strong>Name</strong> field is mandatory.',
            'birth_date.required' => 'The <strong>Birth Date</strong> field is mandatory.',
            'position.required' => 'The <strong>Position</strong> field is mandatory.',
            'phone_number.required' => 'The <strong>Phone Number</strong> field is mandatory.',
            'phone_number.unique' => 'The <strong>phone number</strong> has already been taken.',
            'religion.required' => 'The <strong>Religion</strong> field is mandatory.',
        ];

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'position' => 'required|string|max:255',
            'phone_number' => 'required|string|unique:employees,phone_number',
            'religion' => 'required|string|max:255',
        ], $messages);

        $employeeName = $validatedData['name'];
        Employee::create($validatedData);

        return redirect()->route('employee.index')->with('success', 'Succesfully added <strong>'. $employeeName .'</strong> as a new employee');
    }

    public function web_employee_edit($id)
    {
        $employee = Employee::find($id);
        return view('employeeEdit', compact('employee'));
    }

    public function web_employee_update(Request $request, $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return redirect()->route('employee.index')->with('error', 'Employee not found');
        }

        // Simpan nama karyawan sebelum diperbarui
        $employeeName = $employee->name;

        $messages = [
            'name.required' => 'The <strong>Name</strong> field is mandatory.',
            'birth_date.required' => 'The <strong>Birth Date</strong> field is mandatory.',
            'position.required' => 'The <strong>Position</strong> field is mandatory.',
            'phone_number.required' => 'The <strong>Phone Number</strong> field is mandatory.',
            'phone_number.unique' => 'The <strong>phone number</strong> has already been taken.',
            'religion.required' => 'The <strong>Religion</strong> field is mandatory.',
        ];

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'position' => 'required|string|max:255',
            'phone_number' => 'required|string|unique:employees,phone_number,' . $employee->id,
            'religion' => 'required|string|max:255',
        ], $messages);

        $employee->update($validatedData);

        return redirect()->route('employee.index')->with('success', 'Employee <strong>' . $employeeName . '</strong> successfully updated');
    }

    public function web_employee_delete($id)
    {
        $employee = Employee::find($id);
        return view('employeeDelete', compact('employee'));
    }

    public function web_employee_destroy(Request $request, $id)
    {
        $deletedEmployee = Employee::find($id);

        if (!$deletedEmployee) {
            return redirect()->route('employee.index')->with('error', 'Employee not found');
        }

        $employeeName = $deletedEmployee->name;
        $deletedEmployee->delete();

        return redirect()->route('employee.index')->with('success', 'Employee <strong>' . $employeeName . '</strong> successfully deleted');
    }
}

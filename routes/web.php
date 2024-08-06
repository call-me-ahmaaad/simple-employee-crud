<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

// Employee Index Page
Route::get('/', [EmployeeController::class, 'web_employee_index'])->name('employee.index');

// Employee Add Page
Route::get('/employee-add', [EmployeeController::class, 'web_employee_add'])->name('employee.add');
Route::post('/employee-store', [EmployeeController::class, 'web_employee_store'])->name('employee.store');

// Employee Edit Page
Route::get('/employee-edit/{id}', [EmployeeController::class, 'web_employee_edit'])->name('employee.edit');
Route::put('/employee-update/{id}', [EmployeeController::class, 'web_employee_update'])->name('employee.update');

// Employee Delete Page
Route::get('/employee-delete/{id}', [EmployeeController::class, 'web_employee_delete'])->name('employee.delete');
Route::delete('/employee-destroy/{id}', [EmployeeController::class, 'web_employee_destroy'])->name('employee.destroy');

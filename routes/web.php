<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeManagementController;
use App\Http\Controllers\AttendanceManagementController;

Route::get('/', function () {
    return view('welcome');
});

// Employee Management Route 
Route::get('/emp',[EmployeeManagementController::class,'index'])->name('employees.index');
Route::post('/employees/store', [EmployeeManagementController::class, 'store'])->name('employees.store');
Route::post('/employees/update', [EmployeeManagementController::class, 'update'])->name('employees.update');
Route::post('/employees/delete', [EmployeeManagementController::class, 'destroy'])->name('employees.destroy');


// Attendance  Management Route 
Route::get('/Att', [AttendanceManagementController::class, 'index'])->name('Attendance.index');

Route::get('/attendance', [AttendanceManagementController::class, 'attendanceForm'])->name('attendance.form');
Route::post('/attendance/store', [AttendanceManagementController::class, 'storeAttendance'])->name('attendance.store');

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;


class AttendanceManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = DB::table('employees')->get();
        return view('AttendanceManagement.AttendanceManagement', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   public function storeAttendance(Request $request)
{
    DB::table('employee_attendance')->insert([
        'employee_id' => $request->employee_id,
        'payperday' => $request->payperday,
        'ot_amount' => $request->ot_amount,
        'ot_hours' => $request->ot_hours,
        'total_amount' => $request->total_amount,
        'attendance_status' => $request->attendance_status,
        'attendance_date' => now()->toDateString(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return response()->json(['success' => true]);
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

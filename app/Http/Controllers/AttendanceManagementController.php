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
public function index(Request $request)
{
    if ($request->ajax()) {
        $today = now()->toDateString();

        $latestAttendance = DB::table('employee_attendance as ea1')
            ->select('ea1.*')
            ->whereDate('ea1.attendance_date', $today)
            ->whereRaw('ea1.id = (
                SELECT MAX(ea2.id) 
                FROM employee_attendance as ea2 
                WHERE ea2.employee_id = ea1.employee_id 
                AND DATE(ea2.attendance_date) = DATE(ea1.attendance_date)
            )');

        $data = DB::table('employees')
            ->leftJoinSub($latestAttendance, 'employee_attendance', function ($join) {
                $join->on('employees.id', '=', 'employee_attendance.employee_id');
            })
            ->select(
                'employees.id',
                'employees.name',
                'employees.empid',
                'employees.payperday',
                'employee_attendance.ot_amount',
                'employee_attendance.ot_hours',
                'employee_attendance.total_amount',
                'employee_attendance.attendance_status',
                DB::raw('CASE WHEN employee_attendance.id IS NOT NULL THEN "Added" ELSE "Pending" END as status')
            )
            ->orderBy('employees.id', 'desc')
            ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('status', function ($row) {
                return $row->status === "Added"
                    ? '<span class="badge bg-success">Added</span>'
                    : '<span class="badge bg-warning">Pending</span>';
            })
            ->editColumn('attendance_status', function ($row) {
                return $row->attendance_status ?? '<span class="text-muted"></span>';
            })
            ->editColumn('total_amount', function ($row) {
                return $row->total_amount ?? '';
            })
            ->rawColumns(['status', 'attendance_status', 'total_amount'])
            ->make(true);
    }

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

    public function bulkUpdate(Request $request)
{
    $employee_ids = $request->employee_id;
    $ot_amounts = $request->ot_amount;
    $ot_hours = $request->ot_hours;
    $statuses = $request->attendance_status;
    $totals = $request->total_amount;

    foreach($employee_ids as $i => $emp_id) {
        DB::table('employee_attendance')->updateOrInsert(
            ['employee_id' => $emp_id, 'attendance_date' => now()->toDateString()],
            [
                'payperday' => DB::table('employees')->where('id', $emp_id)->value('payperday'),
                'ot_amount' => $ot_amounts[$i],
                'ot_hours' => $ot_hours[$i],
                'total_amount' => $totals[$i],
                'attendance_status' => $statuses[$i],
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );
    }

    return response()->json(['success' => true]);
}

public function update(Request $request)
{
    DB::table('employee_attendance')->upsert([
        [
            'employee_id' => $request->emaployee_atten_id,
            'attendance_date' => now()->toDateString(),
            'payperday' => $request->emaployee_atten_payperday,
            'ot_amount' => $request->emaployee_atten_ot_amount,
            'ot_hours' => $request->emaployee_atten_ot_hours,
            'total_amount' => $request->emaployee_atten_total_amount,
            'attendance_status' => $request->attendance_status,
            'updated_at' => now(),
            'created_at' => now(),
        ]
    ],
    ['employee_id', 'attendance_date'],
    ['payperday', 'ot_amount', 'ot_hours', 'total_amount', 'attendance_status', 'updated_at']
    );
    return response()->json(['success' => true]);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

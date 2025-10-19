<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class EmployeeManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */

      public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('employees')->orderBy('id', 'desc')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('EmployeeManagement.ViewEmployee');
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
    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required|string|max:255',
            'empid' => 'required|string|max:255|unique:employees',
            'payperday' => 'required|numeric|min:0',
        ]);

        DB::table('employees')->insert([
            'name' => $request->name,
            'empid' => $request->empid,
            'payperday' => $request->payperday,
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
    
    public function update(Request $request)
    {
     
         DB::table('employees')->where('id', $request->id)->update([
        'name' => $request->name,
        'empid' => $request->empid,
        'payperday' => $request->payperday,
        'updated_at' => now(),
    ]);
    

          return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        DB::table('employees')->where('id', $request->id)->delete();

    return response()->json(['success' => true]);
    }
}

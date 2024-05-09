<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $employees = Employee::all();

    // Format the data as needed by the DataTable
    $data = [];
    foreach ($employees as $employee) {
        $data[] = [
            'id' => $employee->id,
            'name' => $employee->name,
            'email' => $employee->email,
            'address' => $employee->address,
            'phone' => $employee->phone,
        ];
    }

    // Return the data as JSON response
    return response()->json(['data' => $data]);
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
    try {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:employees,email',
            'address' => 'required|string',
            'phone' => 'required|string',
        ]);

        $employee = Employee::create($validatedData);

        return response()->json($employee);
    } catch (\Exception $e) {
        // Log the error for debugging
        \Log::error('Error creating employee: ' . $e->getMessage());

        // Return an error response
        return response()->json(['error' => 'Failed to create employee. Please try again.'], 500);
    }
}


    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return response()->json($employee);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
{
    try {
        // Validate the request data
        $validatedData = $request->validate([
            'edit_name' => 'required|string',
            'edit_email' => 'required|email|unique:employees,email,' . $employee->id,
            'edit_address' => 'required|string',
            'edit_phone' => 'required|string',
        ]);

        // Update the employee data
       // Update the employee data
       $employee->name = $validatedData['edit_name'];
       $employee->email = $validatedData['edit_email'];
       $employee->address = $validatedData['edit_address'];
       $employee->phone = $validatedData['edit_phone'];
       $employee->save();

        // Return a success response with updated employee data
        return response()->json($employee);
    } catch (\Exception $e) {
        // Log the error to Laravel's default log file (storage/logs/laravel.log)
        \Log::error('Error updating employee: ' . $e->getMessage());
        
        // Handle the error or return a response indicating the failure
        return response()->json(['error' => 'Failed to update employee.'], 422);
    }
}
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            // Delete the employee record
            $employee->delete();
    
            // Return a success response
            return response()->json(['message' => 'Employee deleted successfully'], 200);
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error deleting employee: ' . $e->getMessage());
    
            // Return an error response
            return response()->json(['error' => 'Failed to delete employee.'], 422);
        }
    }
}

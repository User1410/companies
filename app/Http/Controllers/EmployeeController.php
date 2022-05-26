<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Employee::class, 'employee');
    }

    public function index()
    {    
        return EmployeeResource::collection(
            Employee::with('company')->paginate(10)
        );
    }

    public function store(StoreEmployeeRequest $request)
    {
        $validated = $request->validated();

        $employee = Employee::create(
            $request->only('first_name', 'last_name', 'email', 'phone', 'company_id')
        );

        return response()->json([
            'success' => "Employee \"$employee->first_name $employee->last_name\" successfuly created"
        ]);
    }

    public function update(Employee $employee, StoreEmployeeRequest $request)
    {
        $validated = $request->validated();

        $employee->update([
            'first_name' => $request->input('first_name') ?? $employee->first_name,
            'last_name' => $request->input('last_name') ?? $employee->last_name,
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'company_id' => $request->input('company_id')
        ]);

        return response()->json(['success' => 'Employee was updated successfuly']);
    }

    public function destroy(Employee $employee)
    {
        $fullName = $employee->first_name.' '.$employee->last_name;

        $employee->delete();

        return response()->json(['success' => "Employee \"$fullName\" deleted successfuly"]);
    }
}

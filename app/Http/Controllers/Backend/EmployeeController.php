<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function index(Request $request) {
        if($request->ajax()){
            return DataTables::of(Employee::with('user'))
                ->addColumn('full_name', function($employee){
                    return $employee->user->first_name . ' ' . $employee->user->last_name;
                })
                ->addColumn('email', function($employee){
                    return $employee->user->email;
                })
                ->addColumn('mobile', function($employee){
                    return $employee->user->mobile;
                })
                ->addColumn('status', function($employee){
                    return $employee->user->status;
                })
                ->addColumn('actions', function($employee) {
                    $buttons = '<a href="'.route('employee.edit', $employee->user_id).'" class="btn btn-sm btn-primary">Edit</a>';
                    
                    if(auth()->user()->hasRole('admin')){
                        $buttons .= '&nbsp; <a href="'.route('impersonate.start', $employee->user_id).'" class="btn btn-sm btn-secondary">Impersonate</a>';
                    }
                    
                    return $buttons;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.employee.index');
    }

    public function create() {
        return view('backend.employee.create');
    }

    public function edit($id) {
        $user = User::with('employee')->findOrFail($id);
        $employee = $user->employee;
        return view('backend.employee.edit', compact('user', 'employee'));
    }

    public function store(Request $request) {
        $authUser = auth()->user();

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email',
            'password' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive',

            'employee_identifier' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'salary_type' => 'required|string|max:255',
            'base_salary' => 'required|numeric|min:0',
            'joining_date' => 'required|date',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $image = null;
        if($request->hasFile('image')) {
            $image = $request->file('image')->store('employees', 'public');
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $image,
            'status' => $request->status,
            'registration_type' => $authUser->hasRole('admin') ? 'admin' : 'self',
            'created_by_admin' => $authUser->hasRole('admin') ? 1 : 0,
            'parent_id' => $authUser->getParentId(),
        ]);

        Employee::create([
            'user_id' => $user->id,
            'employee_identifier' => $request->employee_identifier,
            'job_title' => $request->job_title,
            'salary_type' => $request->salary_type,
            'base_salary' => $request->base_salary,
            'joining_date' => $request->joining_date,
        ]);

        $user->assignRole('employee');
        
        return response()->json([
            'success' => true,
            'message' => 'Employee created successfully',
            'redirect_url' => route('employee.index')
        ]);
    }

    public function update(Request $request, $id) {
        $user = User::with('employee')->find($id);

        if(!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }
        
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email,' . $id . ',id',
            'password' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive',

            'employee_identifier' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'salary_type' => 'required|string|max:255',
            'base_salary' => 'required|numeric|min:0',
            'joining_date' => 'required|date',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $image = $user->image;

        if($request->hasFile('image')) {
            $image = $request->file('image')->store('businesses', 'public');
        }

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'image' => $image,
            'status' => $request->status,
        ]);

        $user->employee->update([
            'employee_identifier' => $request->employee_identifier,
            'job_title' => $request->job_title,
            'salary_type' => $request->salary_type,
            'base_salary' => $request->base_salary,
            'joining_date' => $request->joining_date,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Employee updated successfully',
            'redirect_url' => route('employee.index')
        ]);
    }
}

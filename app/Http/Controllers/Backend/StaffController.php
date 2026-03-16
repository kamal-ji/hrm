<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class StaffController extends Controller
{
    public function index(Request $request) {
        if($request->ajax()){
            return DataTables::of(Staff::with('user'))
                ->addColumn('actions', function($staff) {
                    $buttons = '<a href="'.route('staff.edit', $staff->user_id).'" class="btn btn-sm btn-primary">Edit</a>';
                    
                    if(auth()->user()->hasRole('admin')){
                        $buttons .= '<a href="'.route('impersonate.start', $staff->user_id).'" class="btn btn-sm btn-warning">Impersonate</a>';
                    }
                    
                    return $buttons;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.staff.index');
    }

    public function create() {
        return view('backend.staff.create');
    }

    public function edit($id) {
        $user = User::with('staff')->findOrFail($id);
        $staff = $user->staff;
        return view('backend.staff.edit', compact('user', 'staff'));
    }

    public function store(Request $request) {
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
            $image = $request->file('image')->store('staffs', 'public');
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $image,
            'status' => $request->status,
        ]);

        Staff::create([
            'business_id' => auth()->user()->business_id,
            'user_id' => $user->id,
            'employee_identifier' => $request->employee_identifier,
            'job_title' => $request->job_title,
            'salary_type' => $request->salary_type,
            'base_salary' => $request->base_salary,
            'joining_date' => $request->joining_date,
        ]);

        $user->assignRole('staff');
        
        return response()->json([
            'success' => true,
            'message' => 'Staff created successfully',
            'redirect_url' => route('staff.index')
        ]);
    }

    public function update(Request $request, $id) {
        $user = User::with('staff')->find($id);

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

        $user->staff->update([
            'employee_identifier' => $request->employee_identifier,
            'job_title' => $request->job_title,
            'salary_type' => $request->salary_type,
            'base_salary' => $request->base_salary,
            'joining_date' => $request->joining_date,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Staff updated successfully',
            'redirect_url' => route('staff.index')
        ]);
    }
}

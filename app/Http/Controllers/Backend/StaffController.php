<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Allowance;
use App\Models\Deduction;
use App\Models\Department;
use App\Models\Staff;
use App\Models\StaffContribution;
use App\Models\StaffDeduction;
use App\Models\StaffDeductionRelation;
use App\Models\StaffEarning;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Staff::with('user'))
                ->addColumn('full_name', function ($staff) {
                    return $staff->user->first_name . ' ' . $staff->user->last_name;
                })
                ->addColumn('email', function ($staff) {
                    return $staff->user->email;
                })
                ->addColumn('mobile', function ($staff) {
                    return $staff->user->mobile;
                })
                ->addColumn('status', function ($staff) {
                    return $staff->user->status;
                })
                ->addColumn('actions', function ($staff) {
                    $buttons = '<a href="' . route('staff.edit', $staff->user_id) . '" class="btn btn-sm btn-primary">Edit</a>';

                    if (auth()->user()->hasRole('admin')) {
                        $buttons .= '&nbsp; <a href="' . route('impersonate.start', $staff->user_id) . '" class="btn btn-sm btn-secondary">Impersonate</a>';
                    }

                    return $buttons;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.staff.index');
    }

    public function create()
    {
        $user = auth()->user();

        $departments = Department::where('business_id', $user->getParentBusiness()->id)->where('is_active', 1)->orderBy('name')->get();
        $allowances = Allowance::where('business_id', $user->getParentBusiness()->id)->where('is_active', 1)->orderBy('name')->get();
        $deductions = Deduction::where('business_id', $user->getParentBusiness()->id)->where('is_active', 1)->orderBy('name')->get();

        return view('backend.staff.create', compact('departments', 'allowances', 'deductions'));
    }

    public function edit($id)
    {
        $user = User::with('staff')->findOrFail($id);
        $staff = $user->staff;
        return view('backend.staff.edit', compact('user', 'staff'));
    }

    public function store(Request $request)
    {
        $authUser = auth()->user();

        $validator = Validator::make($request->all(), [
            // User
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:active,inactive',

            // Staff
            'employee_identifier' => 'required|string|max:255',
            'department' => 'required|exists:departments,id',
            'designation' => 'required|exists:designations,id',
            'joining_date' => 'required|date',

            // Salary
            'salary_cycle' => 'required',
            'staff_type' => 'required',
            'opening_balance' => 'nullable|numeric|min:0',
            'opening_balance_type' => 'required|in:pending,paid',
            'salary_details_access' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Upload image
        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('staffs', 'public');
        }

        // Create user
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

        // Create staff
        $staff = Staff::create([
            'business_id' => $user->parent_id,
            'user_id' => $user->id,
            'employee_identifier' => $request->employee_identifier,
            'department_id' => $request->department,
            'designation_id' => $request->designation,

            // You didn’t define base_salary in form → default 0
            'base_salary' => 0,

            // Map from staff_type
            'salary_type' => str_contains($request->staff_type, 'monthly') ? 'monthly' : 'daily',

            'salary_cycle' => $request->salary_cycle,
            'staff_type' => $request->staff_type,

            'opening_balance_type' => $request->opening_balance_type,
            'opening_balance' => $request->opening_balance ?? 0,

            'salary_details_access' => $request->salary_details_access,
            'joining_date' => $request->joining_date,
            'is_active' => $request->status === 'active',
        ]);

        $user->assignRole('staff');

        if ($request->has('allowance')) {
            foreach ($request->allowance as $allowanceId => $data) {
                if (!isset($data['enabled'])) continue;

                StaffEarning::create([
                    'staff_id' => $staff->id,
                    'allowance_id' => $allowanceId,
                    'amount' => $data['amount'] ?? 0
                ]);
            }
        }

        if ($request->has('deductions')) {
            foreach ($request->deductions as $deductionId => $data) {
                if (!isset($data['enabled'])) continue;

                $deduction = StaffDeduction::create([
                    'staff_id' => $staff->id,
                    'deduction_id' => $deductionId,
                    'type' => $data['type'] ?? 'fixed',
                    'fixed_amount' => $data['fixed_amount'] ?? 0,
                    'variable_percentage' => $data['variable_percentage'] ?? 0,
                ]);

                // relations (allowances)
                $relations = [];

                if ($data['type'] === 'fixed' && isset($data['fixed'])) {
                    $relations = $data['fixed'];
                }

                if ($data['type'] === 'variable' && isset($data['variable'])) {
                    $relations = $data['variable'];
                }

                foreach ($relations as $allowanceId) {
                    StaffDeductionRelation::create([
                        'staff_deduction_id' => $deduction->id,
                        'allowance_id' => $allowanceId
                    ]);
                }
            }
        }

        if ($request->has('contributions')) {
            foreach ($request->contributions as $deductionId => $data) {
                if (!isset($data['enabled'])) continue;

                StaffContribution::create([
                    'staff_id' => $staff->id,
                    'deduction_id' => $deductionId,
                    'amount' => $data['amount'] ?? 0
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Staff created successfully',
            'redirect_url' => route('staff.index')
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::with('staff')->find($id);

        if (!$user) {
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

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $image = $user->image;

        if ($request->hasFile('image')) {
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

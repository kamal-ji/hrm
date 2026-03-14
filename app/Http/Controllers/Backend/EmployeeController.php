<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\BinaryTree;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        return $this->getEmployees($request, 'all');
    }
    // Active employees
    public function active(Request $request)
    {
        return $this->getEmployees($request, 'active');
    }

    // Inactive employees
    public function inactive(Request $request)
    {

        return $this->getEmployees($request, 'inactive');
    }

    // Pending employees (New Registrations)
    public function pending(Request $request)
    {
        return $this->getEmployees($request, 'pending');
    }
    // Common method for all employee types
    private function getEmployees(Request $request, $type = 'all')
    {

        // NORMAL PAGE LOAD
        if (!$request->ajax()) {
            $countries = Country::where('status', 1)
                ->orderBy('name')
                ->get();

            return view('backend.employees.index', compact('countries', 'type'));
        }
        $type = $request->input('type');
        // DATATABLE AJAX REQUEST
        $authUser = auth()->user();
        $query = User::role('employee');
       if (!$authUser->is_superadmin) {
    $query->where('user_id', $authUser->id);
}
        // Apply status filter based on type
        switch ($type) {
            case 'active':
                $query->where('status', 'active');
                break;
            case 'inactive':
                $query->where('status', 'inactive');
                break;
            case 'pending':
                $query->where('status', 'pending')
                    ->whereNull('approved_at'); // New registrations
                break;
            // 'all' shows all employees regardless of status
        }


        if ($request->search_text) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', "%{$request->search_text}%")
                    ->orWhere('last_name', 'like', "%{$request->search_text}%")
                    ->orWhere('email', 'like', "%{$request->search_text}%")
                    ->orWhere('mobile', 'like', "%{$request->search_text}%");
            });
        }


        if ($request->countryid) {
            $query->where('countryid', $request->countryid);
        }


        if ($request->regionid) {
            $query->where('regionid', $request->regionid);
        }

        $totalRecords = $query->count();

        // PAGINATION
        $employees = $query
            ->with(['country', 'state'])
            ->offset($request->start)
            ->limit($request->length)
            ->orderBy('id', 'desc')
            ->get();

        $data = [];
        foreach ($employees as $employee) {
            // Status badge based on employee status
            $statusBadge = match ($employee->status) {
                'active' => '<span class="badge bg-success">Active</span>',
                'inactive' => '<span class="badge bg-danger">Inactive</span>',
                'pending' => '<span class="badge bg-warning">Pending</span>',
                default => '<span class="badge bg-secondary">Unknown</span>'
            };
            $platformBadge = match ($employee->registration_type) {
                'self' => '<span class="badge bg-success">Frontend</span>',
                'admin' => '<span class="badge bg-danger">System</span>',
                'import' => '<span class="badge bg-warning">Sheet</span>',
                default => '<span class="badge bg-secondary">Unknown</span>'
            };
            $referralUrl = url('/register?ref=' . $employee->referral_code);

            $sponsorInfo = $employee->sponsor
                ? $employee->sponsor->first_name . ' ' . $employee->sponsor->last_name . '<br><small class="text-muted">' . ($employee->sponsor->employee_id ?? 'N/A') . '</small>'
                : '<span class="text-muted">No Sponsor</span>';
            // Approval badge for pending employees
            $approvalBadge = '';
            if ($type == 'pending') {
                $approvalBadge = '
                    <div class="mt-1">
                        <button class="btn btn-xs btn-success btn-approve" data-id="' . $employee->id . '">Approve</button>
                        <button class="btn btn-xs btn-danger btn-reject" data-id="' . $employee->id . '">Reject</button>
                    </div>
                ';
            }



            $data[] = [
                'checkbox' => '<input type="checkbox" value="' . $employee->id . '">',
                'employee' => '
                    <div class="d-flex align-items-center">
                        <img src="' . $employee->profile_image . '" class="avatar avatar-sm me-2">
                        <div>
                            <strong>' . $employee->first_name . ' ' . $employee->last_name . '
                             <a href="javascript:void(0)" 
                   class="ms-1 text-primary"
                   title="Copy referral link"
                   onclick="copyReferralLink(\'' . $referralUrl . '\')">
                    <i class="isax isax-copy"></i>
                </a>
                <a href="javascript:void(0)" 
                   class="ms-1 text-success"
                   title="Share referral link"
                   onclick="shareReferralLink(\'' . $referralUrl . '\')">
                    <i class="isax isax-send-2"></i>
                </a>
                            </strong>
                            ' . $approvalBadge . '
                        </div>
                    </div>',
                'employee_id' => $employee->employee_id,
                'sponsor' => $sponsorInfo,
                'mobile' => $employee->mobile ?? '-',
                'email' => $employee->email,
                'country' => optional($employee->country)->name ?? '-',
                'status' => $statusBadge,
                'platform' => $platformBadge,
                'actions' => '
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Actions
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="' . route('employees.edit', $employee->id) . '"><i class="isax isax-edit me-2"></i>Edit</a></li>
                            ' . ($employee->status == 'active' ?
                    '<li><a class="dropdown-item" href="#" onclick="toggleStatus(' . $employee->id . ', \'inactive\')"><i class="isax isax-user-tag me-2"></i>Deactivate</a></li>' :
                    '<li><a class="dropdown-item" href="#" onclick="toggleStatus(' . $employee->id . ', \'active\')"><i class="isax isax-user-tick me-2"></i>Activate</a></li>'
                ) . '
                            <li><a class="dropdown-item" href="#" onclick="deleteemployee(' . $employee->id . ')"><i class="isax isax-trash me-2"></i>Delete</a></li>
                           </ul>
                    </div>
                ',
            ];
        }

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $data,
        ]);
    }

    // Update employee status
    public function updateStatus(Request $request, $id)
    {

        try {
            $employee = User::findOrFail($id);

            $validated = $request->validate([
                'status' => 'required|in:active,inactive,pending',
            ]);

            $employee->update([
                'status' => $request->status,
                'approved_at' => $request->status == 'active' ? now() : null,
                'approved_by' => $request->status == 'active' ? auth()->id() : null,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'employee status updated successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update status'
            ], 500);
        }
    }

    // Approve pending employee
    public function approve(Request $request, $id)
    {
        try {
            $employee = User::findOrFail($id);

            $employee->update([
                'status' => 'active',
                'approved_at' => now(),
                'approved_by' => auth()->id(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'employee approved successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to approve employee'
            ], 500);
        }
    }

 public function create()
{
    $authUser = auth()->user();

    $countries = Country::where('status', 1)
        ->orderBy('name')
        ->get();

    $states = State::orderBy('name')->get();

    $sponsors = User::role('employee')
        ->where('status', 'active')
        ->whereNotNull('approved_at');

    if (!$authUser->is_superadmin) {

        // Find users sponsored by me
        $downlineIds = User::where('user_id', $authUser->id)
            ->pluck('id')
            ->toArray();

        if (empty($downlineIds)) {
            // Case 1: No one sponsored by me → only myself
            $sponsors->where('id', $authUser->id);
        } else {
            // Case 2: I sponsor others → myself + my sponsored users
            $sponsors->whereIn(
                'id',
                array_merge([$authUser->id], $downlineIds)
            );
        }

        $defaultSponsorId = $authUser->id;

    } else {
        $defaultSponsorId = null;
    }

    $sponsors = $sponsors->orderBy('first_name')
        ->get(['id', 'first_name', 'last_name', 'mobile', 'employee_id']);

    return view(
        'backend.employees.create',
        compact('countries', 'states', 'sponsors', 'defaultSponsorId')
    );
}




    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'mobile' => 'required|string|max:20',
                'dob' => 'nullable|date',
                'anniversary' => 'nullable|date',
                'address1' => 'nullable|string|max:500',
                'address2' => 'nullable|string|max:500',
                'city' => 'nullable|string|max:100',
                'zip' => 'nullable|string|max:20',
                'countryid' => 'nullable|exists:countries,id',
                'regionid' => 'nullable|exists:states,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'password' => 'required|string|min:8',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }


            $employeeId = User::generateemployeeId();
            $data = $request->all();
            //$data['role_id'] = $employeeRole->id;
            $data['name'] = $request->first_name . ' ' . $request->last_name;
            $data['password'] = Hash::make($request->password);
            $data['email_verified_at'] = now();
            $data['approved_at'] = now();
            $data['employee_id'] = $employeeId;
            $data['registration_type'] = 'admin';
            $data['approved_by'] = Auth::id();
            $data['status'] = 'active';
            $data['created_by_admin'] = Auth::id();
            $data['referral_code'] = User::generateReferralCode();

            // Validate sponsor (if provided)
            // Check if this is the first employee
           

             
             $data['user_id'] = Auth::id();
            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'users/' . $imageName;

                // Resize and save image
                $resizedImage = Image::read($image)->resize(300, 300);
                Storage::disk('public')->put($imagePath, (string) $resizedImage->encode());

                $data['image'] = $imagePath;
            }

            // Create employee
            $employee = User::create($data);
            $employee->assignRole('employee');
           

            return response()->json([
                'success' => true,
                'message' => 'employee created successfully',
                'redirect_url' => route('employees.index')
            ]);

        } catch (\Exception $e) {
            Log::error('employee creation error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create employee: ' . $e->getMessage()
            ], 500);
        }
    }


    public function edit($id)
    {
        $employee = User::role('employee')->findOrFail($id);

        $countries = Country::where('status', 1)
            ->orderBy('name')
            ->get();

        // Get states based on user's country
        $states = [];
        if ($employee->countryid) {
            $states = State::where('country_id', $employee->countryid)
                ->orderBy('name')
                ->get();
        }

      

        return view('backend.employees.edit', compact('employee', 'countries', 'states'));
    }

    public function update(Request $request, $id)
    {
        try {
            $employee = User::role('employee')->findOrFail($id);

            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users')->ignore($employee->id)
                ],
                'mobile' => 'required|string|max:20',
                'dob' => 'nullable|date',
                'anniversary' => 'nullable|date',
                'address1' => 'nullable|string|max:500',
                'address2' => 'nullable|string|max:500',
                'city' => 'nullable|string|max:100',
                'zip' => 'nullable|string|max:20',
                'countryid' => 'nullable|exists:countries,id',
                'regionid' => 'nullable|exists:states,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'password' => 'nullable|string|min:8',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $request->except('password');
            $data['name'] = $request->first_name . ' ' . $request->last_name;

            // Handle password update
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($employee->image && Storage::disk('public')->exists($employee->image)) {
                    Storage::disk('public')->delete($employee->image);
                }

                $image = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'users/' . $imageName;

                // Resize and save image
                $resizedImage = Image::make($image)->fit(300, 300);
                Storage::disk('public')->put($imagePath, (string) $resizedImage->encode());

                $data['image'] = $imagePath;
            }



            // Update employee
            $employee->update($data);

            return response()->json([
                'success' => true,
                'message' => 'employee updated successfully',
                'redirect_url' => route('employees.index')
            ]);

        } catch (\Exception $e) {
            Log::error('employee update error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update employee: ' . $e->getMessage()
            ], 500);
        }
    }
    // In employeeController
    
    public function destroy($id)
    {
        try {
            $employee = User::role('employee')->findOrFail($id);

            // Delete image if exists
            if ($employee->image && Storage::disk('public')->exists($employee->image)) {
                Storage::disk('public')->delete($employee->image);
            }

            $employee->delete();

            return response()->json([
                'success' => true,
                'message' => 'employee deleted successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('employee deletion error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete employee'
            ], 500);
        }
    }
}
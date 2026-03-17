<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BusinessController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = auth()->user();

            return DataTables::of(
                Business::with('user')
                    ->when($user->hasRole('business_owner'), function ($query) use ($user) {
                        $query->where(function ($q) use ($user) {
                            if ($user->parent_id) {
                                $q->where('owner_id', $user->id)->orWhereRaw('owner_id IN (SELECT id FROM users WHERE parent_id = ?)', [$user->parent_id]);
                            } else {
                                $q->where('owner_id', $user->id)->orWhereRaw('owner_id IN (SELECT id FROM users WHERE parent_id = ?)', [$user->id]);
                            }
                        });
                    })
            )
                ->addColumn('actions', function ($business) use ($user) {
                    $buttons = '<a href="' . route('business.edit', $business->owner_id) . '" class="btn btn-sm btn-primary">Edit</a>';

                    if ($user->hasRole('admin') || $user->hasRole('business_owner') || $user->id != $business->owner_id) {
                        $buttons .= '&nbsp; <a href="' . route('impersonate.start', $business->owner_id) . '" class="btn btn-sm btn-secondary">Impersonate</a>';
                    }

                    return $buttons;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.business.index');
    }

    public function create()
    {
        return view('backend.business.create');
    }

    public function edit($id)
    {
        $user = User::with('business')->findOrFail($id);
        $business = $user->business;
        return view('backend.business.edit', compact('user', 'business'));
    }

    public function store(Request $request)
    {
        $authUser = auth()->user();

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email',
            'password' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive',
            'business_name' => 'required|string|max:255',
            'business_type' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('businesses', 'public');
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
            'parent_id' => $authUser->hasRole('admin') ? null : $authUser->getParentId(),
        ]);

        $businessData = $request->only([
            'business_name',
            'business_type',
            'industry_type',
            'business_category',
            'number_of_employees',

            'alternate_mobile',
            'designation',

            'address_line_1',
            'address_line_2',
            'city',
            'state',
            'pincode',
            'country',

            'gst_number',
            'pan_number',
            'business_registration_number',

            'subscription_plan',
            'billing_cycle',

            'payment_method',
            'invoice_email',

            'salary_cycle',
            'salary_payment_date',
            'working_days_per_month',
            'default_shift_time',

            'sms_notifications',
            'whatsapp_alerts',
            'email_alerts',

            'max_employees_allowed',
            'current_employees',

            'upgrade_plan_option',
        ]);

        $businessData['owner_id'] = $user->id;
        Business::create($businessData);

        $user->assignRole('business_owner');

        return response()->json([
            'success' => true,
            'message' => 'Business created successfully',
            'redirect_url' => route('business.index')
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::with('business')->find($id);

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
            'password' => 'nullable|string|min:8|max:22',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive',
            'business_name' => 'required|string|max:255',
            'business_type' => 'required|string|max:255',
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

        $businessData = $request->only([
            'business_name',
            'business_type',
            'industry_type',
            'business_category',
            'number_of_employees',

            'alternate_mobile',
            'designation',

            'address_line_1',
            'address_line_2',
            'city',
            'state',
            'pincode',
            'country',

            'gst_number',
            'pan_number',
            'business_registration_number',

            'subscription_plan',
            'billing_cycle',

            'payment_method',
            'invoice_email',

            'salary_cycle',
            'salary_payment_date',
            'working_days_per_month',
            'default_shift_time',

            'sms_notifications',
            'whatsapp_alerts',
            'email_alerts',

            'max_employees_allowed',
            'current_employees',

            'upgrade_plan_option',
        ]);

        $user->business->update($businessData);

        return response()->json([
            'success' => true,
            'message' => 'Business updated successfully',
            'redirect_url' => route('business.index')
        ]);
    }
}

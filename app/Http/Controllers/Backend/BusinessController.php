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
    public function index(Request $request) {
        if($request->ajax()){
            return DataTables::of(Business::with('user'))
                ->addColumn('actions', function($business) {
                    return '<a href="'.route('business.edit', $business->owner_id).'" class="btn btn-sm btn-primary">Edit</a>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.business.index');
    }

    public function create() {
        return view('backend.business.create');
    }

    public function edit($id) {
        $user = User::with('business')->findOrFail($id);
        $business = $user->business;
        return view('backend.business.edit', compact('user', 'business'));
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
            'business_name' => 'required|string|max:255',
            'business_type' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'subscription' => 'required|in:trial,active,expired,cancelled',
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
        ]);

        Business::create([
            'owner_id' => $user->id,
            'business_name' => $request->business_name,
            'business_type' => $request->business_type,
            'address' => $request->address,
            'city' => $request->city,
            'subscription' => $request->subscription,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Business created successfully',
            'redirect_url' => route('business.index')
        ]);
    }

    public function update(Request $request, $id) {
        $user = User::with('user')->find($id);

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
            'password' => 'nullable|string|min:8|max:22',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive',
            'business_name' => 'required|string|max:255',
            'business_type' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'subscription' => 'required|in:trial,active,expired,cancelled',
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

        $user->business->update([
            'business_name' => $request->business_name,
            'business_type' => $request->business_type,
            'address' => $request->address,
            'city' => $request->city,
            'subscription' => $request->subscription,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Business updated successfully',
            'redirect_url' => route('business.index')
        ]);
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DesignationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = auth()->user();

            return DataTables::of(
                Designation::with('department')->where('business_id', $user->getParentBusiness()->id)
            )
                ->addColumn('department', function ($designation) {
                    return $designation->department->name;
                })
                ->addColumn('status', function ($designation) {
                    return $designation->is_active ? 'Active' : 'Inactive';
                })
                ->addColumn('actions', function ($designation) use ($user) {
                    $buttons = '<a href="' . route('designation.edit', $designation->id) . '" class="btn btn-sm btn-primary">Edit</a>';
                    $buttons .= '<a href="' . route('designation.destroy', $designation->id) . '" class="btn btn-sm btn-danger">Delete</a>';

                    return $buttons;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.designation.index');
    }

    public function create()
    {
        $departments = Department::where('business_id', auth()->user()->getParentBusiness()->id)->get();
        return view('backend.designation.create', compact('departments'));
    }

    public function edit($id)
    {
        $designation = Designation::where('business_id', auth()->user()->getParentBusiness()->id)->findOrFail($id);
        $departments = Department::where('business_id', auth()->user()->getParentBusiness()->id)->get();
        return view('backend.designation.edit', compact('designation', 'departments'));
    }

    public function store(Request $request)
    {
        $authUser = auth()->user();

        $validator = Validator::make($request->all(), [
            'department_id' => 'required|exists:departments,id',
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $designation = Designation::create([
            'department_id' => $request->department_id,
            'name' => $request->name,
            'is_active' => $request->is_active,
            'business_id' => $authUser->getParentBusiness()->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Designation created successfully',
            'data' => $designation,
            'redirect_url' => route('designation.index')
        ]);
    }

    public function update(Request $request, $id)
    {
        $authUser = auth()->user();

        $validator = Validator::make($request->all(), [
            'department_id' => 'required|exists:departments,id',
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $designation = Designation::where('business_id', $authUser->getParentBusiness()->id)->findOrFail($id);

        $designation->update([
            'department_id' => $request->department_id,
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Designation updated successfully',
            'data' => $designation,
            'redirect_url' => route('designation.index')
        ]);
    }

    public function destroy($id)
    {
        $authUser = auth()->user();

        $designation = Designation::where('business_id', $authUser->getParentBusiness()->id)->findOrFail($id);

        $designation->delete();

        return response()->json([
            'success' => true,
            'message' => 'Designation deleted successfully'
        ]);
    }
}
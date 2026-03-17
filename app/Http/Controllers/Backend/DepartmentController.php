<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = auth()->user();

            return DataTables::of(
                Department::where('business_id', $user->getParentBusiness()->id)
            )
                ->addColumn('status', function ($designation) {
                    return $designation->is_active ? 'Active' : 'Inactive';
                })
                ->addColumn('actions', function ($department) use ($user) {
                    $buttons = '<a href="' . route('department.edit', $department->id) . '" class="btn btn-primary">Edit</a>';
                    $buttons .= '<a href="' . route('department.destroy', $department->id) . '" class="btn btn-danger">Delete</a>';

                    return $buttons;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.department.index');
    }

    public function create()
    {
        return view('backend.department.create');
    }

    public function edit($id)
    {
        $department = Department::where('business_id', auth()->user()->getParentBusiness()->id)->findOrFail($id);
        return view('backend.department.edit', compact('department'));
    }

    public function store(Request $request)
    {
        $authUser = auth()->user();

        $validator = Validator::make($request->all(), [
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

        $department = Department::create([
            'name' => $request->name,
            'is_active' => $request->is_active ?? 0,
            'business_id' => $authUser->getParentBusiness()->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Department created successfully',
            'data' => $department,
            'redirect_url' => route('department.index')
        ]);
    }

    public function update(Request $request, $id)
    {
        $authUser = auth()->user();

        $validator = Validator::make($request->all(), [
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

        $department = Department::where('business_id', $authUser->getParentBusiness()->id)->findOrFail($id);

        $department->update([
            'name' => $request->name,
            'is_active' => $request->is_active ?? 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Department updated successfully',
            'data' => $department,
            'redirect_url' => route('department.index')
        ]);
    }

    public function destroy($id)
    {
        $authUser = auth()->user();

        $department = Department::where('business_id', $authUser->getParentBusiness()->id)->findOrFail($id);

        $department->delete();

        return response()->json([
            'success' => true,
            'message' => 'Department deleted successfully'
        ]);
    }
}
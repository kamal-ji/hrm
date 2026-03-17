<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Allowance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AllowanceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = auth()->user();

            return DataTables::of(
                Allowance::where('business_id', $user->getParentBusiness()->id)
            )
                ->addColumn('status', function ($allowance) {
                    return $allowance->is_active ? 'Active' : 'Inactive';
                })
                ->addColumn('actions', function ($allowance) use ($user) {
                    $buttons = '<a href="' . route('allowance.edit', $allowance->id) . '" class="btn btn-primary">Edit</a>';
                    $buttons .= '<a href="' . route('allowance.destroy', $allowance->id) . '" class="btn btn-danger">Delete</a>';

                    return $buttons;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.allowance.index');
    }

    public function create()
    {
        return view('backend.allowance.create');
    }

    public function edit($id)
    {
        $allowance = Allowance::where('business_id', auth()->user()->getParentBusiness()->id)->findOrFail($id);
        return view('backend.allowance.edit', compact('allowance'));
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

        $allowance = Allowance::create([
            'name' => $request->name,
            'is_active' => $request->is_active ?? 0,
            'business_id' => $authUser->getParentBusiness()->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Allowance created successfully',
            'data' => $allowance,
            'redirect_url' => route('allowance.index')
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

        $allowance = Allowance::where('business_id', $authUser->getParentBusiness()->id)->findOrFail($id);

        $allowance->update([
            'name' => $request->name,
            'is_active' => $request->is_active ?? 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Allowance updated successfully',
            'data' => $allowance,
            'redirect_url' => route('allowance.index')
        ]);
    }

    public function destroy($id)
    {
        $authUser = auth()->user();

        $allowance = Allowance::where('business_id', $authUser->getParentBusiness()->id)->findOrFail($id);

        $allowance->delete();

        return response()->json([
            'success' => true,
            'message' => 'Allowance deleted successfully'
        ]);
    }
}
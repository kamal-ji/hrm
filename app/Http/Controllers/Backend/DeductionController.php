<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Deduction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DeductionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = auth()->user();

            return DataTables::of(
                Deduction::where('business_id', $user->getParentBusiness()->id)
            )
                ->addColumn('status', function ($deduction) {
                    return $deduction->is_active ? 'Active' : 'Inactive';
                })
                ->addColumn('actions', function ($deduction) use ($user) {
                    $buttons = '<a href="' . route('deduction.edit', $deduction->id) . '" class="btn btn-primary">Edit</a>';
                    $buttons .= '<a href="' . route('deduction.destroy', $deduction->id) . '" class="btn btn-danger">Delete</a>';

                    return $buttons;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.deduction.index');
    }

    public function create()
    {
        return view('backend.deduction.create');
    }

    public function edit($id)
    {
        $deduction = Deduction::where('business_id', auth()->user()->getParentBusiness()->id)->findOrFail($id);
        return view('backend.deduction.edit', compact('deduction'));
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

        $deduction = Deduction::create([
            'name' => $request->name,
            'is_active' => $request->is_active ?? 0,
            'business_id' => $authUser->getParentBusiness()->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Deduction created successfully',
            'data' => $deduction,
            'redirect_url' => route('deduction.index')
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

        $deduction = Deduction::where('business_id', $authUser->getParentBusiness()->id)->findOrFail($id);

        $deduction->update([
            'name' => $request->name,
            'is_active' => $request->is_active ?? 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Deduction updated successfully',
            'data' => $deduction,
            'redirect_url' => route('deduction.index')
        ]);
    }

    public function destroy($id)
    {
        $authUser = auth()->user();

        $deduction = Deduction::where('business_id', $authUser->getParentBusiness()->id)->findOrFail($id);

        $deduction->delete();

        return response()->json([
            'success' => true,
            'message' => 'Deduction deleted successfully'
        ]);
    }
}
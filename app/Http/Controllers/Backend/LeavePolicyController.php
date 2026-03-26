<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\LeavePolicy;
use Illuminate\Http\Request;

class LeavePolicyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $policies = LeavePolicy::where('business_id', auth()->user()->getParentBusiness()->id);
            
            return datatables()->of($policies)
                ->addColumn('actions', function ($policy) {
                    return view('backend.leave-policies.actions', compact('policy'))->render();
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.leave-policies.index');
    }

    public function create(Request $request){
        return view('backend.leave-policies.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            // todo
        ]);
        
        $policy = new LeavePolicy();
        $policy->business_id = auth()->user()->getParentBusiness()->id;
        $policy->name = $request->name;
        $policy->save();

        return response()->json([
            'success' => true,
            'message' => 'Leave policy created successfully',
            'redirect_url' => route('leave-policy.index')
        ]);
    }
    
    public function edit(Request $request, $id){
        $policy  = LeavePolicy::findOrFail($id);
        return view('backend.leave-policies.edit', compact('policy'));
    }
    
    public function update(Request $request, $id){
        $policy = LeavePolicy::findOrFail($id);
        $policy->name = $request->name;
        $policy->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Leave policy updated successfully',
            'redirect_url' => route('leave-policy.index')
        ]);
    }
    
    public function destroy(Request $request, $id){
        $policy = LeavePolicy::findOrFail($id);
        $policy->delete();
        
        return redirect()->route('backend.leave-policies.index')->with('success', 'Leave policy deleted successfully');
    }
}

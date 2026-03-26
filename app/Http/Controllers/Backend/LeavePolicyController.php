<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\LeaveTemplate;
use Illuminate\Http\Request;

class LeavePolicyController extends Controller
{
  public function index(Request $request)
{
    if ($request->ajax()) {
        $policies = LeaveTemplate::where('business_id', auth()->user()->getParentBusiness()->id);

        return datatables()->of($policies)

            ->addColumn('total_leaves', function ($policy) {
                // Example: sum of all leave days (adjust field name as per your DB)
                return $policy->leaves()->sum('leave_count'); 
                // OR if you already have a column:
                // return $policy->total_leaves;
            })

            ->addColumn('assigned_staff', function ($policy) {
                return 0; // static for now
            })

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
            'cycle'=> 'required',
            // todo
        ]);
        
        $policy = new LeaveTemplate();
        $policy->business_id = auth()->user()->getParentBusiness()->id;
        $policy->name = $request->name;
        $policy->leave_cycle = $request->cycle;
        $policy->save();
         
        foreach ($request->categories as $category) {
            $policy->categories()->create([
                'leave_count' => $category['max_leave'],
                'name' => $category['name'],
                'leave_rule' => $category['unused_leave_rule'],
                'carry_forward_limit' => $category['carry_forward_limit'],
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Leave policy created successfully',
            'redirect_url' => route('leave-policy.index')
        ]);
    }
    
    public function edit(Request $request, $id){
        $policy  = LeaveTemplate::findOrFail($id);
        return view('backend.leave-policies.edit', compact('policy'));
    }
    
    public function update(Request $request, $id){
        $policy = LeaveTemplate::findOrFail($id);
        $policy->name = $request->name;
        $policy->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Leave policy updated successfully',
            'redirect_url' => route('leave-policy.index')
        ]);
    }
    
    public function destroy(Request $request, $id){
        $policy = LeaveTemplate::findOrFail($id);
        $policy->delete();
        
        return redirect()->route('backend.leave-policies.index')->with('success', 'Leave policy deleted successfully');
    }
}

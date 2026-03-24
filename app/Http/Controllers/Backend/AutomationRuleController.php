<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AutomationRule;
use Illuminate\Http\Request;

class AutomationRuleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $rules = AutomationRule::where('business_id', auth()->user()->getParentBusiness()->id);
            
            return datatables()->of($rules)
                ->addColumn('actions', function ($rule) {
                    return view('backend.automation-rules.actions', compact('rule'))->render();
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('backend.automation-rules.index');
    }

    public function create(Request $request){
        return view('backend.automation-rules.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        
        $rule = new AutomationRule();
        $rule->business_id = auth()->user()->getParentBusiness()->id;
        $rule->name = $request->name;
        // 
        $rule->save();

        return response()->json([
            'success' => true,
            'message' => 'Automation Rule created successfully',
            'redirect_url' => route('automation-rule.index')
        ]);
    }
    
    public function edit(Request $request, $id){
        $rule  = AutomationRule::find($id);
        return view('backend.automation-rules.edit', compact('rule'));
    }
    
    public function update(Request $request, $id){
        $rule = AutomationRule::find($id);
        $rule->name = $request->name;
        $rule->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Automation rule updated successfully',
            'redirect_url' => route('automation-rule.index')
        ]);
    }
    
    public function destroy(Request $request, $id){
        $rule = AutomationRule::findOrFail($id);
        $rule->delete();
        
        return redirect()->route('backend.automation-rules.index')->with('success', 'Automation rule deleted successfully');
    }
}

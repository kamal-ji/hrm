<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Constants;
use App\Http\Controllers\Controller;
use App\Models\AutomationRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $validatedData = $this->rules($request);
        $request->validate($validatedData['rules']);
        
        DB::beginTransaction();

        try {
            $automationRule = new AutomationRule();
            $automationRule->business_id = auth()->user()->getParentBusiness()->id;
            $automationRule->fill($validatedData['data']);
            $automationRule->save();

            $this->saver($automationRule, $request);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Automation Rule created successfully',
                'redirect_url' => route('automation-rule.index')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Automation Rule creation failed: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function edit(Request $request, $id){
        $rule  = AutomationRule::with('rules')->find($id);

        $formattedRules = [];
        foreach($rule->rules as $ruleItem){
            $hourMinute = hour_minute($ruleItem->hour_minute);
            
            $formattedRules[$ruleItem->rule_type][] = [
                'hours' => $hourMinute[0],
                'minutes' => $hourMinute[1],
                'type' => $ruleItem->type,
                'amount' => $ruleItem->amount
            ];
        }

        return view('backend.automation-rules.edit', compact('rule', 'formattedRules'));
    }
    
    public function update(Request $request, $id){
        $validatedData = $this->rules($request);
        $request->validate($validatedData['rules']);
        
        DB::beginTransaction();
                    
        try {
            $automationRule = AutomationRule::find($id);
            $automationRule->fill($validatedData['data']);
            $automationRule->save();

            $automationRule->rules()->delete();
            $this->saver($automationRule, $request);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Automation Rule updated successfully',
                'redirect_url' => route('automation-rule.index')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Automation Rule update failed: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function destroy(Request $request, $id){
        $rule = AutomationRule::findOrFail($id);
        $rule->rules()->delete();
        $rule->delete();
        
        return redirect()->route('backend.automation-rules.index')->with('success', 'Automation rule deleted successfully');
    }

    protected function rules($request){
        $rules = [
            'name' => 'required',
            'late_entry_deductions' => 'nullable|array',
            'early_exit_deductions' => 'nullable|array',
            'break_rules' => 'nullable|array',
            'overtime_rules' => 'nullable|array',
            'early_overtime_rules' => 'nullable|array',
        ];

        $data = [
            'name' => $request->name,
        ];

        if($request->has('late_entry_deductions') && in_array(Constants::LATE_ENTRY_DEDUCT_SOME_SALARY, $request->late_entry_deductions)){
            $rules = array_merge($rules, [
                'late_deduction_1_rules_hours' => 'required|array',
                'late_deduction_1_rules_minutes' => 'required|array',
                'late_deduction_1_rules_type' => 'required|array',
                'late_deduction_1_rules_amount' => 'required|array',
                'late_deduction_1_rules_hours.*.*' => 'required|integer',
                'late_deduction_1_rules_minutes.*.*' => 'required|integer',
                'late_deduction_1_rules_type.*.*' => 'required|integer',
                'late_deduction_1_rules_amount.*.*' => 'required|numeric',
            ]);
            $data['late_entry_deductions_1'] = 1;
        }

        if($request->has('late_entry_deductions') && in_array(Constants::LATE_ENTRY_DEDUCT_HALF_SALARY, $request->late_entry_deductions)){
            $rules = array_merge($rules, [
                'late_deduction_2_rules_hours' => 'required|array',
                'late_deduction_2_rules_minutes' => 'required|array',
                'late_deduction_2_rules_hours.*.*' => 'required|integer',
                'late_deduction_2_rules_minutes.*.*' => 'required|integer',
            ]);
            $data['late_entry_deductions_2'] = 1;
        }

        if($request->has('late_entry_deductions') && in_array(Constants::LATE_ENTRY_DEDUCT_FULL_SALARY, $request->late_entry_deductions)){
            $rules = array_merge($rules, [
                'late_deduction_3_rules_hours' => 'required|array',
                'late_deduction_3_rules_minutes' => 'required|array',
                'late_deduction_3_rules_hours.*.*' => 'required|integer',
                'late_deduction_3_rules_minutes.*.*' => 'required|integer',
            ]);
            $data['late_entry_deductions_3'] = 1;
        }

        if($request->has('early_exit_deductions') && in_array(Constants::EARLY_EXIT_DEDUCT_SOME_SALARY, $request->early_exit_deductions)){
            $rules = array_merge($rules, [
                'early_exit_deduction_1_rules_hours' => 'required|array',
                'early_exit_deduction_1_rules_minutes' => 'required|array',
                'early_exit_deduction_1_rules_type' => 'required|array',
                'early_exit_deduction_1_rules_amount' => 'required|array',
                'early_exit_deduction_1_rules_hours.*.*' => 'required|integer',
                'early_exit_deduction_1_rules_minutes.*.*' => 'required|integer',
                'early_exit_deduction_1_rules_type.*.*' => 'required|integer',
                'early_exit_deduction_1_rules_amount.*.*' => 'required|numeric',
            ]);
            $data['early_exit_deductions_1'] = 1;
        }

        if($request->has('early_exit_deductions') && in_array(Constants::EARLY_EXIT_DEDUCT_HALF_SALARY, $request->early_exit_deductions)){
            $rules = array_merge($rules, [
                'early_exit_deduction_2_rules_hours' => 'required|array',
                'early_exit_deduction_2_rules_minutes' => 'required|array',
                'early_exit_deduction_2_rules_hours.*.*' => 'required|integer',
                'early_exit_deduction_2_rules_minutes.*.*' => 'required|integer'
            ]);
            $data['early_exit_deductions_2'] = 1;
        }

        if($request->has('early_exit_deductions') && in_array(Constants::EARLY_EXIT_DEDUCT_FULL_SALARY, $request->early_exit_deductions)){
            $rules = array_merge($rules, [
                'early_exit_deduction_3_rules_hours' => 'required|array',
                'early_exit_deduction_3_rules_minutes' => 'required|array',
                'early_exit_deduction_3_rules_hours.*.*' => 'required|integer',
                'early_exit_deduction_3_rules_minutes.*.*' => 'required|integer',
            ]);
            $data['early_exit_deductions_3'] = 1;
        }

        if($request->has('break_rules') && in_array(Constants::BREAK_DEDUCT_SOME_SALARY, $request->break_rules)){
            $rules = array_merge($rules, [
                'break_rule_1_rules_hours' => 'required|array',
                'break_rule_1_rules_minutes' => 'required|array',
                'break_rule_1_rules_type' => 'required|array',
                'break_rule_1_rules_amount' => 'required|array',
                'break_rule_1_rules_hours.*.*' => 'required|integer',
                'break_rule_1_rules_minutes.*.*' => 'required|integer',
                'break_rule_1_rules_type.*.*' => 'required|integer',
                'break_rule_1_rules_amount.*.*' => 'required|numeric',
            ]);
            $data['break_rules_1'] = 1;
        }

        if($request->has('break_rules') && in_array(Constants::BREAK_DEDUCT_HALF_SALARY, $request->break_rules)){
            $rules = array_merge($rules, [
                'break_rule_2_rules_hours' => 'required|array',
                'break_rule_2_rules_minutes' => 'required|array',
                'break_rule_2_rules_hours.*.*' => 'required|integer',
                'break_rule_2_rules_minutes.*.*' => 'required|integer',
            ]);
            $data['break_rules_2'] = 1;
        }

        if($request->has('break_rules') && in_array(Constants::BREAK_DEDUCT_FULL_SALARY, $request->break_rules)){
            $rules = array_merge($rules, [
                'break_rule_3_rules_hours' => 'required|array',
                'break_rule_3_rules_minutes' => 'required|array',
                'break_rule_3_rules_hours.*.*' => 'required|integer',
                'break_rule_3_rules_minutes.*.*' => 'required|integer',
            ]);
            $data['break_rules_3'] = 1;
        }
        
        if($request->has('overtime_rules') && in_array(Constants::OVERTIME_SOME_SALARY, $request->overtime_rules)){
            $rules = array_merge($rules, [
                'overtime_rule_1_rules_hours' => 'required|array',
                'overtime_rule_1_rules_minutes' => 'required|array',
                'overtime_rule_1_rules_type' => 'required|array',
                'overtime_rule_1_rules_amount' => 'required|array',
                'overtime_rule_1_rules_hours.*.*' => 'required|integer',
                'overtime_rule_1_rules_minutes.*.*' => 'required|integer',
                'overtime_rule_1_rules_type.*.*' => 'required|integer',
                'overtime_rule_1_rules_amount.*.*' => 'required|numeric',
            ]);
            $data['overtime_rules_1'] = 1;
        }

        if($request->has('overtime_rules') && in_array(Constants::OVERTIME_HALF_SALARY, $request->overtime_rules)){
            $rules = array_merge($rules, [
                'overtime_rule_2_rules_hours' => 'required|array',
                'overtime_rule_2_rules_minutes' => 'required|array',
                'overtime_rule_2_rules_hours.*.*' => 'required|integer',
                'overtime_rule_2_rules_minutes.*.*' => 'required|integer',
            ]);
            $data['overtime_rules_2'] = 1;
        }

        if($request->has('overtime_rules') && in_array(Constants::OVERTIME_FULL_SALARY, $request->overtime_rules)){
            $rules = array_merge($rules, [
                'overtime_rule_3_rules_hours' => 'required|array',
                'overtime_rule_3_rules_minutes' => 'required|array',
                'overtime_rule_3_rules_hours.*.*' => 'required|integer',
                'overtime_rule_3_rules_minutes.*.*' => 'required|integer',
            ]);
            $data['overtime_rules_3'] = 1;
        }

        if($request->has('early_overtime_rules') && in_array(Constants::EARLY_OVERTIME_SOME_SALARY, $request->early_overtime_rules)){
            $rules = array_merge($rules, [
                'early_overtime_rule_1_rules_hours' => 'required|array',
                'early_overtime_rule_1_rules_minutes' => 'required|array',
                'early_overtime_rule_1_rules_type' => 'required|array',
                'early_overtime_rule_1_rules_amount' => 'required|array',
                'early_overtime_rule_1_rules_hours.*.*' => 'required|integer',
                'early_overtime_rule_1_rules_minutes.*.*' => 'required|integer',
                'early_overtime_rule_1_rules_type.*.*' => 'required|integer',
                'early_overtime_rule_1_rules_amount.*.*' => 'required|numeric',
            ]);
            $data['early_overtime_rules_1'] = 1;
        }

        if($request->has('early_overtime_rules') && in_array(Constants::EARLY_OVERTIME_HALF_SALARY, $request->early_overtime_rules)){
            $rules = array_merge($rules, [
                'early_overtime_rule_2_rules_hours' => 'required|array',
                'early_overtime_rule_2_rules_minutes' => 'required|array',
                'early_overtime_rule_2_rules_hours.*.*' => 'required|integer',
                'early_overtime_rule_2_rules_minutes.*.*' => 'required|integer',
            ]);
            $data['early_overtime_rules_2'] = 1;
        }

        if($request->has('early_overtime_rules') && in_array(Constants::EARLY_OVERTIME_FULL_SALARY, $request->early_overtime_rules)){
            $rules = array_merge($rules, [
                'early_overtime_rule_3_rules_hours' => 'required|array',
                'early_overtime_rule_3_rules_minutes' => 'required|array',
                'early_overtime_rule_3_rules_hours.*.*' => 'required|integer',
                'early_overtime_rule_3_rules_minutes.*.*' => 'required|integer',
            ]);
            $data['early_overtime_rules_3'] = 1;
        }

        return [
            'rules' => $rules,
            'data' => $data
        ];
    }

    public function saver($automationRule, $request){
        if($automationRule->late_entry_deductions_1){
            foreach($request->late_deduction_1_rules_hours ?? [] as $indexL0 => $hourL0){
                foreach($hourL0 as $index => $hour){
                    $automationRule->rules()->create([
                        'rule_type' => 'late_entry_deductions_1',
                        'hour_minute' => $hour . ':' . $request->late_deduction_1_rules_minutes[$indexL0][$index],
                        'type' => $request->late_deduction_1_rules_type[$indexL0][$index],
                        'amount' => $request->late_deduction_1_rules_amount[$indexL0][$index],
                    ]);
                }
            }
        }

        if($automationRule->late_entry_deductions_2){
            foreach($request->late_deduction_2_rules_hours ?? [] as $indexL0 => $hourL0){
                foreach($hourL0 as $index => $hour){
                    $automationRule->rules()->create([
                        'rule_type' => 'late_entry_deductions_2',
                        'hour_minute' => $hour . ':' . $request->late_deduction_2_rules_minutes[$indexL0][$index],
                        'type' => Constants::DEDUCTION_AMOUNT_TYPE_MULTIPLIER,
                        'amount' => 0.5,
                    ]);
                }
            }
        }

        if($automationRule->late_entry_deductions_3){
            foreach($request->late_deduction_3_rules_hours ?? [] as $indexL0 => $hourL0){
                foreach($hourL0 as $index => $hour){
                    $automationRule->rules()->create([
                        'rule_type' => 'late_entry_deductions_3',
                        'hour_minute' => $hour . ':' . $request->late_deduction_3_rules_minutes[$indexL0][$index],
                        'type' => Constants::DEDUCTION_AMOUNT_TYPE_MULTIPLIER,
                        'amount' => 1,
                    ]);
                }
            }
        }

        if($automationRule->early_exit_deductions_1){
            foreach($request->early_exit_deduction_1_rules_hours ?? [] as $indexL0 => $hourL0){
                foreach($hourL0 as $index => $hour){
                    $automationRule->rules()->create([
                        'rule_type' => 'early_exit_deductions_1',
                        'hour_minute' => $hour . ':' . $request->early_exit_deduction_1_rules_minutes[$indexL0][$index],
                        'type' => $request->early_exit_deduction_1_rules_type[$indexL0][$index],
                        'amount' => $request->early_exit_deduction_1_rules_amount[$indexL0][$index],
                    ]);
                }
            }
        }

        if($automationRule->early_exit_deductions_2){
            foreach($request->early_exit_deduction_2_rules_hours ?? [] as $indexL0 => $hourL0){
                foreach($hourL0 as $index => $hour){
                    $automationRule->rules()->create([
                        'rule_type' => 'early_exit_deductions_2',
                        'hour_minute' => $hour . ':' . $request->early_exit_deduction_2_rules_minutes[$indexL0][$index],
                        'type' => Constants::DEDUCTION_AMOUNT_TYPE_MULTIPLIER,
                        'amount' => 0.5,
                    ]);
                }
            }
        }

        if($automationRule->early_exit_deductions_3){
            foreach($request->early_exit_deduction_3_rules_hours ?? [] as $indexL0 => $hourL0){
                foreach($hourL0 as $index => $hour){
                    $automationRule->rules()->create([
                        'rule_type' => 'early_exit_deductions_3',
                        'hour_minute' => $hour . ':' . $request->early_exit_deduction_3_rules_minutes[$indexL0][$index],
                        'type' => Constants::DEDUCTION_AMOUNT_TYPE_MULTIPLIER,
                        'amount' => 1,
                    ]);
                }
            }
        }

        if($automationRule->break_rules_1){
            foreach($request->break_rule_1_rules_hours ?? [] as $indexL0 => $hourL0){
                foreach($hourL0 as $index => $hour){
                    $automationRule->rules()->create([
                        'rule_type' => 'break_rules_1',
                        'hour_minute' => $hour . ':' . $request->break_rule_1_rules_minutes[$indexL0][$index],
                        'type' => $request->break_rule_1_rules_type[$indexL0][$index],
                        'amount' => $request->break_rule_1_rules_amount[$indexL0][$index],
                    ]);
                }
            }
        }

        if($automationRule->break_rules_2){
            foreach($request->break_rule_2_rules_hours ?? [] as $indexL0 => $hourL0){
                foreach($hourL0 as $index => $hour){
                    $automationRule->rules()->create([
                        'rule_type' => 'break_rules_2',
                        'hour_minute' => $hour . ':' . $request->break_rule_2_rules_minutes[$indexL0][$index],
                        'type' => Constants::DEDUCTION_AMOUNT_TYPE_MULTIPLIER,
                        'amount' => 0.5,
                    ]);
                }
            }
        }

        if($automationRule->break_rules_3){
            foreach($request->break_rule_3_rules_hours ?? [] as $indexL0 => $hourL0){
                foreach($hourL0 as $index => $hour){
                    $automationRule->rules()->create([
                        'rule_type' => 'break_rules_3',
                        'hour_minute' => $hour . ':' . $request->break_rule_3_rules_minutes[$indexL0][$index],
                        'type' => Constants::DEDUCTION_AMOUNT_TYPE_MULTIPLIER,
                        'amount' => 1,
                    ]);
                }
            }
        }

        if($automationRule->overtime_rules_1){
            foreach($request->overtime_rule_1_rules_hours ?? [] as $indexL0 => $hourL0){
                foreach($hourL0 as $index => $hour){
                    $automationRule->rules()->create([
                        'rule_type' => 'overtime_rules_1',
                        'hour_minute' => $hour . ':' . $request->overtime_rule_1_rules_minutes[$indexL0][$index],
                        'type' => $request->overtime_rule_1_rules_type[$indexL0][$index],
                        'amount' => $request->overtime_rule_1_rules_amount[$indexL0][$index],
                    ]);
                }
            }
        }

        if($automationRule->overtime_rules_2){
            foreach($request->overtime_rule_2_rules_hours ?? [] as $indexL0 => $hourL0){
                foreach($hourL0 as $index => $hour){
                    $automationRule->rules()->create([
                        'rule_type' => 'overtime_rules_2',
                        'hour_minute' => $hour . ':' . $request->overtime_rule_2_rules_minutes[$indexL0][$index],
                        'type' => Constants::DEDUCTION_AMOUNT_TYPE_MULTIPLIER,
                        'amount' => 0.5,
                    ]);
                }
            }
        }

        if($automationRule->overtime_rules_3){
            foreach($request->overtime_rule_3_rules_hours ?? [] as $indexL0 => $hourL0){
                foreach($hourL0 as $index => $hour){
                    $automationRule->rules()->create([
                        'rule_type' => 'overtime_rules_3',
                        'hour_minute' => $hour . ':' . $request->overtime_rule_3_rules_minutes[$indexL0][$index],
                        'type' => Constants::DEDUCTION_AMOUNT_TYPE_MULTIPLIER,
                        'amount' => 1,
                    ]);
                }
            }
        }

        if($automationRule->early_overtime_rules_1){
            foreach($request->early_overtime_rule_1_rules_hours ?? [] as $indexL0 => $hourL0){
                foreach($hourL0 as $index => $hour){
                    $automationRule->rules()->create([
                        'rule_type' => 'early_overtime_rules_1',
                        'hour_minute' => $hour . ':' . $request->early_overtime_rule_1_rules_minutes[$indexL0][$index],
                        'type' => $request->early_overtime_rule_1_rules_type[$indexL0][$index],
                        'amount' => $request->early_overtime_rule_1_rules_amount[$indexL0][$index],
                    ]);
                }
            }
        }

        if($automationRule->early_overtime_rules_2){
            foreach($request->early_overtime_rule_2_rules_hours ?? [] as $indexL0 => $hourL0){
                foreach($hourL0 as $index => $hour){
                    $automationRule->rules()->create([
                        'rule_type' => 'early_overtime_rules_2',
                        'hour_minute' => $hour . ':' . $request->early_overtime_rule_2_rules_minutes[$indexL0][$index],
                        'type' => Constants::DEDUCTION_AMOUNT_TYPE_MULTIPLIER,
                        'amount' => 0.5,
                    ]);
                }
            }
        }

        if($automationRule->early_overtime_rules_3){
            foreach($request->early_overtime_rule_3_rules_hours ?? [] as $indexL0 => $hourL0){
                foreach($hourL0 as $index => $hour){
                    $automationRule->rules()->create([
                        'rule_type' => 'early_overtime_rules_3',
                        'hour_minute' => $hour . ':' . $request->early_overtime_rule_3_rules_minutes[$indexL0][$index],
                        'type' => Constants::DEDUCTION_AMOUNT_TYPE_MULTIPLIER,
                        'amount' => 1,
                    ]);
                }
            }
        }
    }
}

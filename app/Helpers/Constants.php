<?php

namespace App\Helpers;

class Constants
{
    const ATTENDANCE_MODE_MARK_PRESENT_BY_DEFAULT = 1;
    const ATTENDANCE_MODE_MANUAL_ATTENDANCE = 2;
    const ATTENDANCE_MODE_LOCATION_BASED = 3;
    const ATTENDANCE_MODE_SELFIE_LOCATION_BASED = 4;

    public static function getAttendanceModes()
    {
        return [
            [
                'id' => self::ATTENDANCE_MODE_MARK_PRESENT_BY_DEFAULT,
                'name' => 'Mark Present by Default',
                'description' => 'Default auto present, can be changed manually',
            ],
            [
                'id' => self::ATTENDANCE_MODE_MANUAL_ATTENDANCE,
                'name' => 'Manual Attendance',
                'description' => 'Attendance is neutral by default, should be marked manually',
            ],
            [
                'id' => self::ATTENDANCE_MODE_LOCATION_BASED,
                'name' => 'Location Based',
                'description' => 'Staff can mark their own attendance. Location will be captured automatically',
            ],
            [
                'id' => self::ATTENDANCE_MODE_SELFIE_LOCATION_BASED,
                'name' => 'Selfie & Location Based',
                'description' => 'Staff can mark their own attendance with Selfie. Location will be captured automatically',
            ],
        ];
    }

    const HOLIDAY_ATTENDANCE_MODE_DO_NOT_ALLOW = 1;
    const HOLIDAY_ATTENDANCE_MODE_ALLOW = 2;
    const HOLIDAY_ATTENDANCE_MODE_COMP_OFF = 3;

    public static function getHolidayAttendanceModes()
    {
        return [
            [
                'id' => self::HOLIDAY_ATTENDANCE_MODE_DO_NOT_ALLOW,
                'name' => 'Do NOT Allow attendance on paid holidays',
                'description' => 'Do not let PagarBook let staff mark attendance on paid holidays',
            ],
            [
                'id' => self::HOLIDAY_ATTENDANCE_MODE_ALLOW,
                'name' => 'Allow attendance on paid holidays',
                'description' => 'Allow PagarBook to let staff mark attendance on paid holidays',
            ],
            [
                'id' => self::HOLIDAY_ATTENDANCE_MODE_COMP_OFF,
                'name' => 'Comp Off',
                'description' => 'Allow PagarBook to credit a comp off leave if a staff works on a holiday',
            ],
        ];
    }

    const ATTENDANCE_ITEM_LENS_ATTENDANCE = 1;
    const ATTENDANCE_ITEM_LOCATION_ATTENDANCE = 2;
    const ATTENDANCE_ITEM_SELFIE_LOCATION_ATTENDANCE = 3;

    public static function getAttendanceItems()
    {
        return [
            [
                'id' => self::ATTENDANCE_ITEM_LENS_ATTENDANCE,
                'name' => 'Lens Attendance',
            ],
            [
                'id' => self::ATTENDANCE_ITEM_LOCATION_ATTENDANCE,
                'name' => 'Location Attendance',
            ],
            [
                'id' => self::ATTENDANCE_ITEM_SELFIE_LOCATION_ATTENDANCE,
                'name' => 'Selfie & Location Attendance',
            ],
        ];
    }

    const AUTOMATION_ITEM_OVERTIMES = 1;
    const AUTOMATION_ITEM_FINES = 2;

    public static function getAutomationItems()
    {
        return [
            [
                'id' => self::AUTOMATION_ITEM_OVERTIMES,
                'name' => 'Overtimes',
            ],
            [
                'id' => self::AUTOMATION_ITEM_FINES,
                'name' => 'Fines',
            ],
        ];
    }

    const EFFECTIVE_WORKING_HOURS_RULE_1 = 1;
    const EFFECTIVE_WORKING_HOURS_RULE_2 = 2;
    const EFFECTIVE_WORKING_HOURS_RULE_3 = 3;
    const EFFECTIVE_WORKING_HOURS_RULE_4 = 4;
    const EFFECTIVE_WORKING_HOURS_DO_NOT_SHOW = 5;

    public static function getEffectiveWorkingHours()
    {
        return [
            [
                'id' => self::EFFECTIVE_WORKING_HOURS_RULE_1,
                'name' => 'Rule 1',
                'description' => 'Overtime and paid breaks will be deducted from the total time',
            ],
            [
                'id' => self::EFFECTIVE_WORKING_HOURS_RULE_2,
                'name' => 'Rule 2',
                'description' => 'Total time only, no deductions',
            ],
            [
                'id' => self::EFFECTIVE_WORKING_HOURS_RULE_3,
                'name' => 'Rule 3',
                'description' => 'Overtime will be deducted from total time',
            ],
            [
                'id' => self::EFFECTIVE_WORKING_HOURS_RULE_4,
                'name' => 'Rule 4',
                'description' => 'All breaks will be deducted from total time',
            ],
            [
                'id' => self::EFFECTIVE_WORKING_HOURS_DO_NOT_SHOW,
                'name' => 'Do not show',
                'description' => '',
            ],
        ];
    }

    const SHIFT_TYPE_FIXED = 1;
    const SHIFT_TYPE_OPEN = 2;
    const SHIFT_TYPE_ROTATIONAL = 3;

    public static function getShiftTypes()
    {
        return [
            [
                'id' => self::SHIFT_TYPE_FIXED,
                'name' => 'Fixed',
            ],
            [
                'id' => self::SHIFT_TYPE_OPEN,
                'name' => 'Open',
            ],
            [
                'id' => self::SHIFT_TYPE_ROTATIONAL,
                'name' => 'Rotational',
            ],
        ];
    }

    const PAY_TYPE_PAID = 1;
    const PAY_TYPE_UNPAID = 2;

    public static function getPayTypes()
    {
        return [
            [
                'id' => self::PAY_TYPE_PAID,
                'name' => 'Paid',
            ],
            [
                'id' => self::PAY_TYPE_UNPAID,
                'name' => 'Unpaid',
            ],
        ];
    }

    const AMOUNT_TYPE_FIXED = 1;
    const AMOUNT_TYPE_PERCENT = 2;

    public static function getAmountTypes()
    {
        return [
            [
                'id' => self::AMOUNT_TYPE_FIXED,
                'name' => 'Fixed',
            ],
            [
                'id' => self::AMOUNT_TYPE_PERCENT,
                'name' => 'Percentage',
            ],
        ];
    }

    const DEDUCTION_AMOUNT_TYPE_FIXED = 1;
    const DEDUCTION_AMOUNT_TYPE_MULTIPLIER = 2;

    public static function getDeductionAmountTypes()
    {
        return [
            [
                'id' => self::DEDUCTION_AMOUNT_TYPE_FIXED,
                'name' => 'Fixed',
            ],
            [
                'id' => self::DEDUCTION_AMOUNT_TYPE_MULTIPLIER,
                'name' => 'Multiplier',
            ],
        ];
    }

    const TIME_PERIOD_DURATION = 1;
    const TIME_PERIOD_INTERVAL = 2;

    public static function getTimePeriodTypes()
    {
        return [
            [
                'id' => self::TIME_PERIOD_DURATION,
                'name' => 'Duration',
            ],
            [
                'id' => self::TIME_PERIOD_INTERVAL,
                'name' => 'Interval',
            ],
        ];
    }

    const LATE_ENTRY_DEDUCT_SOME_SALARY = 1;
    const LATE_ENTRY_DEDUCT_HALF_SALARY = 2;
    const LATE_ENTRY_DEDUCT_FULL_SALARY = 3;

    public static function getLateEntryDeductions(){
        return [
            [
                'id' => self::LATE_ENTRY_DEDUCT_SOME_SALARY,
                'name' => 'Deduct salary if staff is late by more than',
            ],
            [
                'id' => self::LATE_ENTRY_DEDUCT_HALF_SALARY,
                'name' => 'Deduct half day salary if staff is late by more than',
            ],
            [
                'id' => self::LATE_ENTRY_DEDUCT_FULL_SALARY,
                'name' => 'Deduct full day salary if staff is late by more than',
            ],
        ];
    }

    const EARLY_EXIT_DEDUCT_SOME_SALARY = 1;
    const EARLY_EXIT_DEDUCT_HALF_SALARY = 2;
    const EARLY_EXIT_DEDUCT_FULL_SALARY = 3;

    public static function getEarlyExitDeductions(){
        return [
            [
                'id' => self::EARLY_EXIT_DEDUCT_SOME_SALARY,
                'name' => 'Deduct salary if staff leaves early by more than',
            ],
            [
                'id' => self::EARLY_EXIT_DEDUCT_HALF_SALARY,
                'name' => 'Deduct half day salary if staff leaves early by more than',
            ],
            [
                'id' => self::EARLY_EXIT_DEDUCT_FULL_SALARY,
                'name' => 'Deduct full day salary if staff leaves early by more than',
            ],
        ];
    }

    const BREAK_DEDUCT_SOME_SALARY = 1;
    const BREAK_DEDUCT_HALF_SALARY = 2;
    const BREAK_DEDUCT_FULL_SALARY = 3;

    public static function getBreakDeductions(){
        return [
            [
                'id' => self::BREAK_DEDUCT_SOME_SALARY,
                'name' => 'Deduct salary if staff takes breaks more than',
            ],
            [
                'id' => self::BREAK_DEDUCT_HALF_SALARY,
                'name' => 'Deduct half day salary if staff takes breaks more than',
            ],
            [
                'id' => self::BREAK_DEDUCT_FULL_SALARY,
                'name' => 'Deduct full day salary if staff takes breaks more than',
            ],
        ];
    }

    const OVERTIME_SOME_SALARY = 1;
    const OVERTIME_HALF_SALARY = 2;
    const OVERTIME_FULL_SALARY = 3;

    public static function getOvertimePayTypes(){
        return [
            [
                'id' => self::OVERTIME_SOME_SALARY,
                'name' => 'Give overtime if staff works more than',
            ],
            [
                'id' => self::OVERTIME_HALF_SALARY,
                'name' => 'Give half day overtime if staff works more than',
            ],
            [
                'id' => self::OVERTIME_FULL_SALARY,
                'name' => 'Give full day overtime if staff works more than',
            ],
        ];
    }

    const EARLY_OVERTIME_SOME_SALARY = 1;
    const EARLY_OVERTIME_HALF_SALARY = 2;
    const EARLY_OVERTIME_FULL_SALARY = 3;

    public static function getEarlyOvertimePayTypes(){
        return [
            [
                'id' => self::EARLY_OVERTIME_SOME_SALARY,
                'name' => 'Give overtime if staff work before shift start by more than',
            ],
            [
                'id' => self::EARLY_OVERTIME_HALF_SALARY,
                'name' => 'Give half day overtime if staff work before shift start by more than',
            ],
            [
                'id' => self::EARLY_OVERTIME_FULL_SALARY,
                'name' => 'Give full day overtime if staff work before shift start by more than',
            ],
        ];
    }

    const LEAVE_POLICY_CYCLE_MONTHLY = 1;
    const LEAVE_POLICY_CYCLE_ANNUALLY = 2;

    public static function getLeavePolicyCycles(){
        return [
            [
                'id' => self::LEAVE_POLICY_CYCLE_MONTHLY,
                'name' => 'Monthly',
            ],
            [
                'id' => self::LEAVE_POLICY_CYCLE_ANNUALLY,
                'name' => 'Annually',
            ],
        ];
    }

    const LEAVE_POLICY_UNUSED_LEAVE_RULE_EXPIRE = 1;
    const LEAVE_POLICY_UNUSED_LEAVE_RULE_CARRY_FORWARD = 2;
    const LEAVE_POLICY_UNUSED_LEAVE_RULE_ENCASH = 3;

    public static function getLeavePolicyUnusedLeaveRules(){
        return [
            [
                'id' => self::LEAVE_POLICY_UNUSED_LEAVE_RULE_EXPIRE,
                'name' => 'Expire',
            ],
            [
                'id' => self::LEAVE_POLICY_UNUSED_LEAVE_RULE_CARRY_FORWARD,
                'name' => 'Carry Forward',
            ],
            [
                'id' => self::LEAVE_POLICY_UNUSED_LEAVE_RULE_ENCASH,
                'name' => 'Encashment',
            ]
        ];
    }

    public static function getName($type, $code, $default = null){
        $array = [];

        switch($type){
            case 'attendance_mode':
                $array = self::getAttendanceModes();
                break;
            case 'holidy_attendance_mode':
                $array = self::getHolidayAttendanceModes();
                break;
            case 'attendance_item':
                $array = self::getAttendanceItems();
                break;
            case 'automation_item':
                $array = self::getAutomationItems();
                break;
            case 'effective_working_hour':
                $array = self::getEffectiveWorkingHours();
                break;
            case 'shift_type':
                $array = self::getShiftTypes();
                break;
            case 'pay_type':
                $array = self::getPayTypes();
                break;
            case 'late_entry_deduct':
                $array = self::getLateEntryDeductions();
                break;
            case 'early_exit_deduct':
                $array = self::getEarlyExitDeductions();
                break;
            case 'break_deduct':
                $array = self::getBreakDeductions();
                break;
            case 'overtime':
                $array = self::getOvertimePayTypes();
                break;
            case 'time_period':
                $array = self::getTimePeriodTypes();
                break;
            case 'amount_type':
                $array = self::getAmountTypes();
                break;
            case 'early_overtime':
                $array = self::getEarlyOvertimePayTypes();
                break;
            case 'leave_policy_cycle':
                $array = self::getLeavePolicyCycles();
                break;
            case 'leave_policy_unused_leave_rule':
                $array = self::getLeavePolicyUnusedLeaveRules();
                break;
        }

        foreach($array as $item){
            if($item['id'] == $code){
                return $item['name'];
            }
        }

        return $default;
    }
}

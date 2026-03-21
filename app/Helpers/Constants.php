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
}

<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
                'type'  => 'permission'
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
                'type'  => 'permission'
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
                'type'  => 'permission'
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
                'type'  => 'permission'
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
                'type'  => 'permission'
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
                'type'  => 'permission'
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
                'type'  => 'role'
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
                'type'  => 'role'
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
                'type'  => 'role'
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
                'type'  => 'role'
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
                'type'  => 'role'
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
                'type'  => 'user'
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
                'type'  => 'user'
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
                'type'  => 'user'
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
                'type'  => 'user'
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
                'type'  => 'user'
            ],
            [
                'id'    => 17,
                'title' => 'approval_status_create',
                'type'  => 'approval'
            ],
            [
                'id'    => 18,
                'title' => 'approval_status_edit',
                'type'  => 'approval'
            ],
            [
                'id'    => 19,
                'title' => 'approval_status_show',
                'type'  => 'approval'
            ],
            [
                'id'    => 20,
                'title' => 'approval_status_delete',
                'type'  => 'approval'
            ],
            [
                'id'    => 21,
                'title' => 'approval_status_access',
                'type'  => 'approval'
            ],
            [
                'id'    => 22,
                'title' => 'task_management_access',
                'type'  => 'task'
            ],
            [
                'id'    => 23,
                'title' => 'task_status_create',
                'type'  => 'task_status'
            ],
            [
                'id'    => 24,
                'title' => 'task_status_edit',
                'type'  => 'task_status'
            ],
            [
                'id'    => 25,
                'title' => 'task_status_show',
                'type'  => 'task_status'
            ],
            [
                'id'    => 26,
                'title' => 'task_status_delete',
                'type'  => 'task_status'
            ],
            [
                'id'    => 27,
                'title' => 'task_status_access',
                'type'  => 'task_status'
            ],
            [
                'id'    => 28,
                'title' => 'task_tag_create',
                'type'  => 'task_tag'
            ],
            [
                'id'    => 29,
                'title' => 'task_tag_edit',
                'type'  => 'task_tag'
            ],
            [
                'id'    => 30,
                'title' => 'task_tag_show',
                'type'  => 'task_tag'
            ],
            [
                'id'    => 31,
                'title' => 'task_tag_delete',
                'type'  => 'task_tag'
            ],
            [
                'id'    => 32,
                'title' => 'task_tag_access',
                'type'  => 'task_tag'
            ],
            [
                'id'    => 33,
                'title' => 'task_create',
                'type'  => 'task'
            ],
            [
                'id'    => 34,
                'title' => 'task_edit',
                'type'  => 'task'
            ],
            [
                'id'    => 35,
                'title' => 'task_show',
                'type'  => 'task'
            ],
            [
                'id'    => 36,
                'title' => 'task_delete',
                'type'  => 'task'
            ],
            [
                'id'    => 37,
                'title' => 'task_access',
                'type'  => ''
            ],
            [
                'id'    => 38,
                'title' => 'tasks_calendar_access',
                'type'  => 'tasks_calendar'
            ],
            [
                'id'    => 39,
                'title' => 'tags_and_remark_access',
                'type'  => 'tags_and_remark'
            ],
            [
                'id'    => 40,
                'title' => 'illness_tag_create',
                'type'  => 'illness_tag'
            ],
            [
                'id'    => 41,
                'title' => 'illness_tag_edit',
                'type'  => 'illness_tag'
            ],
            [
                'id'    => 42,
                'title' => 'illness_tag_show',
                'type'  => 'illness_tag'
            ],
            [
                'id'    => 43,
                'title' => 'illness_tag_delete',
                'type'  => 'illness_tag'
            ],
            [
                'id'    => 44,
                'title' => 'illness_tag_access',
                'type'  => 'illness_tag'
            ],
            [
                'id'    => 45,
                'title' => 'vaccine_tag_create',
                'type'  => 'vaccine_tag'
            ],
            [
                'id'    => 46,
                'title' => 'vaccine_tag_edit',
                'type'  => 'vaccine_tag'
            ],
            [
                'id'    => 47,
                'title' => 'vaccine_tag_show',
                'type'  => 'vaccine_tag'
            ],
            [
                'id'    => 48,
                'title' => 'vaccine_tag_delete',
                'type'  => 'vaccine_tag'
            ],
            [
                'id'    => 49,
                'title' => 'vaccine_tag_access',
                'type'  => 'vaccine_tag'
            ],
            [
                'id'    => 50,
                'title' => 'users_info_create',
                'type'  => 'users_info'
            ],
            [
                'id'    => 51,
                'title' => 'users_info_edit',
                'type'  => 'users_info'
            ],
            [
                'id'    => 52,
                'title' => 'users_info_show',
                'type'  => 'users_info'
            ],
            [
                'id'    => 53,
                'title' => 'users_info_delete',
                'type'  => 'users_info'
            ],
            [
                'id'    => 54,
                'title' => 'users_info_access',
                'type'  => 'users_info'
            ],
            [
                'id'    => 55,
                'title' => 'appointment_create',
                'type'  => 'appointment'
            ],
            [
                'id'    => 56,
                'title' => 'appointment_edit',
                'type'  => 'appointment'
            ],
            [
                'id'    => 57,
                'title' => 'appointment_show',
                'type'  => 'appointment'
            ],
            [
                'id'    => 58,
                'title' => 'appointment_delete',
                'type'  => 'appointment'
            ],
            [
                'id'    => 59,
                'title' => 'appointment_access',
                'type'  => 'appointment'
            ],
            [
                'id'    => 60,
                'title' => 'appointment_time_create',
                'type'  => 'appointment_time'
            ],
            [
                'id'    => 61,
                'title' => 'appointment_time_edit',
                'type'  => 'appointment_time'
            ],
            [
                'id'    => 62,
                'title' => 'appointment_time_show',
                'type'  => 'appointment_time'
            ],
            [
                'id'    => 63,
                'title' => 'appointment_time_delete',
                'type'  => 'appointment_time'
            ],
            [
                'id'    => 64,
                'title' => 'appointment_time_access',
                'type'  => 'appointment_time'
            ],
            [
                'id'    => 65,
                'title' => 'profile_password_edit',
                'type'  => 'profile_password'
            ],
        ];

        Permission::insert($permissions);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class departmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            [
                'department_name' => 'DDL'
            ],

            [
                'department_name' => 'DDL'
            ],
            [
                'department_name' => 'DDL'
            ],
            [
                'department_name' => 'DDL'
            ],
        ];
        foreach ($departments as $key => $value) {
            Department::create($value);
        }
    }
}
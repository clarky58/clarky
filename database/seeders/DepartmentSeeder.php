<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(Department::count() > 0){
            return;
        }
        Department::create([
            'name' => 'Finance',
            'code' => 'FIN',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Sequence;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = Company::all();

        Employee::factory()->count(20)->state(
            new Sequence(
                fn ($s) => ['company_id' => $companies->random()->id]
            )
        )->create();
    }
}

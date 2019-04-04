<?php

use Illuminate\Database\Seeder;

class PatientAllergySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\PatientAllergy::class, 10)->create();   
    }
}

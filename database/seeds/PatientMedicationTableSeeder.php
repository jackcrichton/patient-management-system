<?php

use Illuminate\Database\Seeder;

class PatientMedicationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\PatientMedication::class, 5)->create();   
    }
}

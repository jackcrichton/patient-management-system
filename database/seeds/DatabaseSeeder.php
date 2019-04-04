<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PatientsTableSeeder::class);
        $this->call(AllergyTableSeeder::class);
        $this->call(PatientAllergySeeder::class);
        $this->call(MedicationTableSeeder::class);
        $this->call(PatientMedicationTableSeeder::class);
    }
}

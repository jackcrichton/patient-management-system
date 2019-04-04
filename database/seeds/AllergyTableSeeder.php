<?php

use Illuminate\Database\Seeder;

class AllergyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Allergy::class, 5)->create();   
    }
}

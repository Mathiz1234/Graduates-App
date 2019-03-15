<?php

use Illuminate\Database\Seeder;

class GraduatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Graduate::class, 100)->create();
    }
}

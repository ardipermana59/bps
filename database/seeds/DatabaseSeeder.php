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
        $this->call([
            PositionSeeder::class,
            ActivitySeeder::class,
            CriteriaSeeder::class,
            EmployeeSeeder::class,
            AmbilKegiatanSeeder::class,
            PenilaiSeeder::class,
            PenilaiPegawaiSeeder::class,
        ]);
    }
}

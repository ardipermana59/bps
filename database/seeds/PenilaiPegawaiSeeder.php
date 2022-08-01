<?php

use App\Models\PenilaiPegawai;
use Illuminate\Database\Seeder;

class PenilaiPegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=5; $i < 20; $i++) { 
            PenilaiPegawai::create([
                'employee_id' => $i,
                'evaluator_id' => rand(1, 3),
            ]);
        }
    }
}

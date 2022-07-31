<?php

use App\Models\Evaluator;
use Illuminate\Database\Seeder;

class PenilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // bikin seeder untuk penilai
        for ($i = 2; $i <= 4; $i++) {
            Evaluator::create([
                'employee_id' => $i,
            ]);
        }
    }
}

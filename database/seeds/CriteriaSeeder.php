<?php

use App\Models\Criteria;
use Illuminate\Database\Seeder;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $criterias = [
            [
                'name' => 'Target dan Realisasi',
            ],
            [
                'name' => 'Kerjasama',
            ],
            [
                'name' => 'Ketepatan Waktu',
            ],
            [
                'name' => 'Kualitas',
            ],
        ];

        foreach ($criterias as $criteria) {
            Criteria::create([
                'name' => $criteria['name'],
            ]);
        }
    }
}

<?php

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activies = [
            [
                'name' => 'Print Document',
                'description' => 'Ngeprint 100',
                'satuan' => 'lembar',
            ],
            [
                'name' => 'Fotokopi Document',
                'description' => 'Fotokopi 50',
                'satuan' => 'lembar',
            ], 
            [
                'name' => 'Jilid Document',
                'description' => 'Jilid Document',
                'satuan' => 'lembar',
            ],
            [
                'name' => 'Input Data Penduduk',
                'description' => 'Input Data Penduduk',
                'satuan' => 'lembar',
            ],
        ];

        foreach ($activies as $activity) {
            Activity::create([
                'name' => $activity['name'],
                'description' => $activity['description'],
                'satuan' => $activity['satuan'],
            ]);
        }
    }
}

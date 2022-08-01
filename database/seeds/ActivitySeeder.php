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
            ],
            [
                'name' => 'Fotokopi Document',
            ], 
            [
                'name' => 'Jilid Document',
            ],
            [
                'name' => 'Input Data Penduduk',
            ],
        ];

        foreach ($activies as $activity) {
            Activity::create([
                'name' => $activity['name'],
            ]);
        }
    }
}

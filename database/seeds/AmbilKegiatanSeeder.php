<?php

use App\Models\AmbilKegiatan;
use Illuminate\Database\Seeder;

class AmbilKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jumlahCriteria = 4;
        $idKegiatan = rand(1,4);
        $target = ['100 Lembar','50 Lembar'];
        for ($i=5; $i <= 15 ; $i++) { 
            // ini looping buat nge insert criteria
            for ($a=1; $a <= $jumlahCriteria; $a++) { 
                AmbilKegiatan::create([
                    'employee_id' => $i,
                    'activity_id' => $idKegiatan,
                    'criteria_id' => $a,
                    'target' => 5 * rand(1,20) . 'Lembar',
                ]);
            }
        }
    }
}

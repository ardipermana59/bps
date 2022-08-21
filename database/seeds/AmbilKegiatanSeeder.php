<?php

use App\Models\AmbilKegiatan;
use App\Models\Nilai;
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
        $idKegiatan = rand(1, 4);

        for ($i = 5; $i <= 15; $i++) {
            $ambilKegiatan = AmbilKegiatan::create([
                'employee_id' => $i,
                'activity_id' => $idKegiatan,
                'target' => rand(1, 5),
            ]);
            Nilai::create([
                'ambil_kegiatan_id' => $ambilKegiatan->id,
                'target_realisasi' => rand(1, 5) * 20,
                'kerjasama' => rand(1, 5) * 20,
                'ketepatan_waktu' => rand(1, 5) * 20,
                'kualitas' => rand(1, 5) * 20,
            ]);
        }

       
    }
}

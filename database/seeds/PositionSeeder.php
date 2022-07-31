<?php

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = ['Ketua BPS', 'Wakil Ketua BPS', 'Kabid', 'Staff Pegawai'];

        foreach ($positions as $position) {
            Position::create([
                'name' => $position,
            ]);
        }
    }
}

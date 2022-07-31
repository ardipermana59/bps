<?php

use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'status' => 'active',
                'role' => 'admin',
                'password' => Hash::make('admin'),
            ],
            [
                'name' => 'penilai 1',
                'username' => 'penilai1',
                'email' => 'penilai1@gmail.com',
                'status' => 'active',
                'role' => 'penilai',
                'password' => Hash::make('admin'),
            ],
            [
                'name' => 'penilai 2',
                'username' => 'penilai2',
                'email' => 'penilai2@gmail.com',
                'status' => 'active',
                'role' => 'penilai',
                'password' => Hash::make('admin'),
            ],
            [
                'name' => 'penilai 3',
                'username' => 'penilai3',
                'email' => 'penilai3@gmail.com',
                'status' => 'active',
                'role' => 'penilai',
                'password' => Hash::make('admin'),
            ],
        ];

        $positions = ['Ketua BPS','Wakil Ketua','Sekretaris','Bendahara','Anggota'];

        foreach ($positions as $position) {
            Position::create([
                'name' => $position,
            ]);

        }
        $faker = Faker\Factory::create();
        // insert data admin dan penilai
        foreach ($users as $user) {
           $user = User::create([
                'name' => $user['name'],
                'username' => $user['username'],
                'email' => $user['email'],
                'status' => $user['status'],
                'role' => $user['role'],
                'password' => $user['password'],
            ]);

            Employee::create([
                'user_id' => $user->id,
                'position_id' => rand(1,5),
                'nip' => rand(100000000,999999999),
                'full_name' => $faker->name,
            ]);

        }

        for ($i = 0; $i < 15; $i++) {
           $user = User::create([
                'name' => $faker->name,
                'username' => $faker->username,
                'email' => $faker->email,
                'status' => 'active',
                'role' => 'pegawai',
                'password' => Hash::make('admin'),
            ]);

            Employee::create([
                'user_id' => $user->id,
                'position_id' => rand(1,5),
                'nip' => rand(100000000,999999999),
                'full_name' => $faker->name,
            ]);
        }
    }
}

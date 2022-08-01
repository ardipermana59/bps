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

        $nip = 100000001;
        $faker = Faker\Factory::create('id_ID');

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
                'position_id' => rand(1, 4),
                'nip' => $nip,
                'full_name' => $faker->name,
            ]);
            $nip++;
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
                'position_id' => 4,
                'nip' => $nip,
                'full_name' => $faker->name,
            ]);
            $nip++;
        }
    }
}

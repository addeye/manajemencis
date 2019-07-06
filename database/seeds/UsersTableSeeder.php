<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'role_id' => 1,
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('1234'),
        ]);

        DB::table('users')->insert([
            'name' => 'Admin ',
            'role_id' => 2,
            'email' => 'admin@gmail.com',
            'password' => bcrypt('1234'),
        ]);

        DB::table('users')->insert([
            'name' => 'Konsultan',
            'role_id' => 3,
            'email' => 'konsultan@gmail.com',
            'password' => bcrypt('1234'),
        ]);

        DB::table('users')->insert([
            'name' => 'UMKM',
            'role_id' => 4,
            'email' => 'umkm@gmail.com',
            'password' => bcrypt('1234'),
        ]);
    }
}

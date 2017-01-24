<?php

use Illuminate\Database\Seeder;

class PendidikansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pendidikans')->insert([
            'name' => 'Diploma I',
        ]);
        DB::table('pendidikans')->insert([
            'name' => 'Diploma II',
        ]);
        DB::table('pendidikans')->insert([
            'name' => 'Diploma III',
        ]);
        DB::table('pendidikans')->insert([
            'name' => 'Diploma IV',
        ]);
        DB::table('pendidikans')->insert([
            'name' => 'S1',
        ]);
        DB::table('pendidikans')->insert([
            'name' => 'S2',
        ]);
        DB::table('pendidikans')->insert([
            'name' => 'S3',
        ]);
    }
}

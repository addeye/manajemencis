<?php

use Illuminate\Database\Seeder;

class TingkatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tingkats')->insert([
            'id' => 1,
            'name' => 'None',
        ]);
        DB::table('tingkats')->insert([
            'id' => 2,
            'name' => 'Nasional',
        ]);
        DB::table('tingkats')->insert([
            'id' => 3,
            'name' => 'Provinsi',
        ]);
        DB::table('tingkats')->insert([
            'id' => 4,
            'name' => 'Kabupaten-Kota',
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class BidangLayananTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bidang_layanans')->insert(
            [
                [
                    'name' => 'Kelembagaan',
                ],
                [
                    'name' => 'SDM',
                ],
                [
                    'name' => 'Produksi',
                ],
                [
                    'name' => 'Pembiayaan',
                ],
                [
                    'name' => 'Pemasaran',
                ],
                [
                    'name' => 'Pengembangan IT',
                ],
                [
                    'name' => 'Pengembangan Jaringan Kerjasama',
                ]
            ]
        );
    }
}

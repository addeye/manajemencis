<?php

use Illuminate\Database\Seeder;

class KontaksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kontaks')->insert([
            'identitas' => 'Asdep Pendampingan Usaha Kedeputian Restrukturisasi Usaha Kementerian Koperasi dan UKM Republik Indonesia',
            'alamat' => 'Jl. H.R. Rasuna Said, Kuningan, Jakarta Selatan',
            'email' => 'cis.nasional@gmail.com',
            'website' => 'www.cis-nasional.id',
        ]);
    }
}

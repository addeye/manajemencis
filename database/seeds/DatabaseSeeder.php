<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(TingkatsTableSeeder::class);
        $this->call(PendidikansTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(BidangLayananTableSeeder::class);
    }
}

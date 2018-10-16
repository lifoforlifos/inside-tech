<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeed::class);
        $this->call(ItemsTableSeed::class);
        $this->call(CartsTableSeed::class);
        $this->call(PaymentsTableSeed::class);
    }
}

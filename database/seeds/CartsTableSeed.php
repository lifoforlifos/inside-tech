<?php

use Illuminate\Database\Seeder;
use App\Item;
use App\User;
use App\Cart;
use Faker\Factory;

class CartsTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        Cart::truncate();

        $usersIDs = DB::table('users')->pluck('id');
        $itemsIDs= DB::table('items')->pluck('id');

        foreach (range(10, 50) as $i) {
            Cart::create([
                'user_id' => $faker->randomElement($usersIDs),
                'item_id' => $faker->randomElement($itemsIDs),
                'quantity' => mt_rand(1, 10000),
                'price' => mt_rand(1,100),
            ]);
        }
    }
}

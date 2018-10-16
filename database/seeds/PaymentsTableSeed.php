<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Cart;
use App\Payment;
use Faker\Factory;

class PaymentsTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        Payment::truncate();

        $usersIDs = DB::table('users')->pluck('id');
        $cartsIDs = DB::table('carts')->pluck('id');

        foreach (range(10, 50) as $i) {
            Payment::create([
                'user_id' => $faker->randomElement($usersIDs),
                'cart_id' => $faker->randomElement($cartsIDs),
                'credit_type' => $faker->creditCardType,
                'credit_number' => $faker->creditCardNumber,
                'phone_number' => $faker->e164PhoneNumber,
                'address' => $faker->address
            ]);
        }
    }
}

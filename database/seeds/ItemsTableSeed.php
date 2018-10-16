<?php

use Illuminate\Database\Seeder;
use App\Item;
use Faker\Factory;

class ItemsTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        Item::truncate();

        $category = ['vente', 'acces', 'solaire', 'temps', 'video', 'alarme', 'incendie', 'rfid'];

        foreach (range(10, 50) as $i) {
            Item::create([
                'reference' => 'IT #'.$i,
                'name' => $faker->word,
                'description' => $faker->text,
                'category' => $faker->randomElement($category),
                'price' => mt_rand(0, 10000),
                'discount' => mt_rand(0, 100),
                'stock' => mt_rand(0, 40)
            ]);
        }
    }
}

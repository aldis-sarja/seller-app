<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        do {
            $product_id = rand(1, Product::count());
            $product = Product::find($product_id);
        } while ($product->reserved);

            $product->reserved = Carbon::now();
            $product->update();

            return [
                'client_id' => rand(1, Client::count()),
                'product_id' => $product_id,
                'price' => $this->faker->numberBetween(1, 1000000),
                'date' => $this->faker->dateTime(),
            ];


    }
}

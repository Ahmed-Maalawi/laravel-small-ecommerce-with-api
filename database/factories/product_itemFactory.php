<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product_item>
 */
class product_itemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sku' => $this->faker->randomAscii(),
            'qty_in_stock' => $this->faker->numberBetween(1, 5000),
            'product_image' => 'image/product.jpg',
            'price' => $this->faker->numberBetween(100, 100000),
        ];
    }
}

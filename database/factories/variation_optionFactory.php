<?php

namespace Database\Factories;

use App\Models\variation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\variation_option>
 */
class variation_optionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        static $id = 1;
        return [
            'value' => sprintf('value %s', $id++),
            'variation_id' => variation::factory(),
        ];
    }
}

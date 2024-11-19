<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'article' => $this->faker->unique()->word,
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'color' => $this->faker->colorName,
            'season' => $this->faker->randomElement(['зима', 'лето', 'осень', 'весна']),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'sizes' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            'material' => $this->faker->word,
            'brand' => $this->faker->word,
            'image' => 'products/product.jpg',
        ];
    }
}
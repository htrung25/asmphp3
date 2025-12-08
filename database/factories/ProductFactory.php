<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $category = Category::inRandomOrder()->first();

        if (! $category) {
            $category = Category::factory()->create();
        }

        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 10000, 1000000),
            'stock' => $this->faker->numberBetween(0, 500),
            'image_url' => $this->faker->imageUrl(640, 480, 'technics', true),
            'category_id' => $category->id,
        ];
    }
}

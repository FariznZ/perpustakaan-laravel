<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'author' => fake()->name(),
            'publisher' => fake()->company(),
            'year' => fake()->year(),
            'isbn' => fake()->unique()->isbn13(),
            'category_id' => Category::factory(),
            'pages' => fake()->numberBetween(100, 500),
            'stock' => fake()->numberBetween(1, 5),
            'description' => fake()->paragraph(),
            'cover_url' => null,
        ];
    }
}
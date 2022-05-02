<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categoriesIds = DB::table('categories')->pluck('id');
        $usersIds = DB::table('users')->pluck('id');
        return [
            'isbn' => $this->faker->isbn13,
            'title' => $this->faker->sentence,
            'authors' => $this->faker->name,
            'editor' => $this->faker->name,
            'summary' => $this->faker->text,
            'category_id' => $this->faker->randomElement($categoriesIds),
            'owner_id' => $this->faker->randomElement($usersIds),
        ];
    }
}

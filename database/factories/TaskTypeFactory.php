<?php

namespace Database\Factories;

use App\Models\TaskType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Class TaskTypeFactory
 * @package Database\Factories
 */
class TaskTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TaskType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
         return [
            'title' => $this->faker->name,
            'description' => $this->faker->text(),
        ];
    }
}

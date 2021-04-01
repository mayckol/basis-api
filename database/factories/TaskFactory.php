<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\TaskType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class TaskFactory
 * @package Database\Factories
 */
class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $taskTypeId = TaskType::all()->random(1)->first()->id;
        $countTaskStatusTypes = count(config('tasks.status'));

         return [
            'task_type_id' => $taskTypeId,
            'status' => rand(1, $countTaskStatusTypes),
            'obs' => $this->faker->text(),
        ];
    }
}

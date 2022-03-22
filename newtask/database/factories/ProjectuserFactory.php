<?php

namespace Database\Factories;

use App\Models\project;
use App\Models\tasks;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectuserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $project_id =  project::all()->random()->id;
        $taskid = tasks::where('project_id',$project_id)->inRandomOrder()->get(['id']);
        return [
            'user_id' => User::all()->random()->id,
            'project_id' => $project_id,
            'task_id' => $taskid['0']->id,
        ];
    }
}

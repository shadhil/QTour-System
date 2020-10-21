<?php

namespace Database\Factories;

use App\Models\CrewJobType;
use App\Models\CrewMember;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CrewMemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CrewMember::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_name' => $this->faker->name,
            'job_type_id' => $this->faker->numberBetween(1, 3),
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->phoneNumber
        ];
    }
}

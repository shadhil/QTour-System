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
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'job_title_id' => $this->faker->numberBetween(1, 3),
            'company_id' => $this->faker->numberBetween(1, 3),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->e164PhoneNumber,
            'location' => $this->faker->streetName,
        ];
    }
}

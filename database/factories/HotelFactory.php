<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class HotelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hotel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'location' => $this->faker->streetAddress,
            'region_id' => $this->faker->numberBetween(1, 31),
            'email' => $this->faker->unique()->companyEmail,
            'phones' => $this->faker->e164PhoneNumber
        ];
    }
}

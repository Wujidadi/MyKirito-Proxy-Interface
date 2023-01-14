<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PlayerTokensFactory extends Factory
{
    public function definition(): array
    {
        return [
            'player_name' => $this->faker->name(),
            'player_id' => $this->faker->word(),
            'section_2' => $this->faker->word(),
            'section_3' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'token' => Str::random(10),
        ];
    }
}

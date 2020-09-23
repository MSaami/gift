<?php

namespace Database\Factories;

use App\Models\Code;
use App\Models\Winner;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WinnerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Winner::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code_id' => Code::first()->id,
            'mobile' => $this->faker->phoneNumber
        ];
    }
}

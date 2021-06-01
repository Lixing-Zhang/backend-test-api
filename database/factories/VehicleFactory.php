<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vin' => $this->faker->bankAccountNumber,
            'make' => collect(['bmw', 'benz', 'audi'])->shuffle()->first(),
            'model' => collect(['x1', 'x5', 'a4', 'a8'])->shuffle()->first(),
            'year' => $this->faker->year,
            'colour' => $this->faker->colorName,
            'body_type' => collect(['sedan', 'suv', 'hatch', 'ute', 'wagon'])->shuffle()->first(),
            'status' =>  Vehicle::STATUS_AVAILABLE,
        ];
    }
}

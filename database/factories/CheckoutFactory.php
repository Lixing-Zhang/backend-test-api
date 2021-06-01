<?php

namespace Database\Factories;

use App\Models\Checkout;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class CheckoutFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Checkout::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vehicle_id' => Vehicle::factory()->create(['status' => Vehicle::STATUS_CHECKED_OUT]),
            'type' => Checkout::TYPE_LOAN,
            'customer_name' => $this->faker->name,
            'checkout_at' => now()
        ];
    }
}

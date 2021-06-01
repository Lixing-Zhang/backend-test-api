<?php

namespace Tests\Feature;

use App\Events\VehicleCheckedOut;
use App\Models\Checkout;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_vehicle_id_must_be_valid()
    {
        Event::fake();

        $customerName = $this->faker->name;
        $response = $this->postJson('/api/checkouts', [
            'vehicle_id' => 3,
            'type' => Checkout::TYPE_LOAN,
            'customer_name' => $customerName,
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'vehicle_id' => 'The selected vehicle id is invalid.'
        ]);
    }

    public function test_vehicle_must_be_available()
    {
        $vehicle = Vehicle::factory()->create([
            'status' => Vehicle::STATUS_CHECKED_OUT
        ]);

        $customerName = $this->faker->name;
        $response = $this->postJson('/api/checkouts', [
            'vehicle_id' => $vehicle->id,
            'type' => Checkout::TYPE_LOAN,
            'customer_name' => $customerName,
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'vehicle_id' => 'The vehicle status must be available'
        ]);
    }

    public function test_can_create_checkout_for_vehicle()
    {
        Event::fake();

        $vehicle = Vehicle::factory()->create();

        $customerName = $this->faker->name;
        $response = $this->postJson('/api/checkouts', [
            'vehicle_id' => $vehicle->id,
            'type' => Checkout::TYPE_LOAN,
            'customer_name' => $customerName,
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('checkouts', [
            'vehicle_id' => $vehicle->id,
            'type' => Checkout::TYPE_LOAN,
            'customer_name' => $customerName,
        ]);
        Event::assertDispatched(VehicleCheckedOut::class);
    }
}

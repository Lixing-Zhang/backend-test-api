<?php

namespace Tests\Feature;

use App\Events\VehicleCheckedIn;
use App\Events\VehicleCheckedOut;
use App\Models\Checkout;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class CheckinTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_vehicle_id_must_be_valid()
    {
        Event::fake();

        $conditionOfReturn = $this->faker->realText(200);
        $response = $this->postJson('/api/checkins', [
            'vehicle_id' => 1,
            'condition_of_return' => $conditionOfReturn,
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'vehicle_id' => 'The selected vehicle id is invalid.'
        ]);
    }

    public function test_vehicle_must_be_available()
    {
        $vehicle = Vehicle::factory()->create([
            'status' => Vehicle::STATUS_AVAILABLE
        ]);

        $conditionOfReturn = $this->faker->realText(200);
        $response = $this->postJson('/api/checkins', [
            'vehicle_id' => $vehicle->id,
            'condition_of_return' => $conditionOfReturn,
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'vehicle_id' => 'The vehicle status must be checked out'
        ]);
    }

    public function test_can_create_checkin_for_vehicle()
    {
        Event::fake();

        $checkout = Checkout::factory()->create();

        $conditionOfReturn = $this->faker->realText(200);
        $response = $this->postJson('/api/checkins', [
            'vehicle_id' => $checkout->vehicle->id,
            'condition_of_return' => $conditionOfReturn,
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('checkins', [
            'checkout_id' =>  $checkout->id,
            'condition_of_return' => $conditionOfReturn,
        ]);

        Event::assertDispatched(VehicleCheckedIn::class);
    }
}

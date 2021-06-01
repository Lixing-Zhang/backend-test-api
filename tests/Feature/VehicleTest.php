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

class VehicleTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_get_list_of_vehicles()
    {
        Vehicle::factory()->count(10)->create();

        $response = $this->getJson('/api/vehicles');

        $response->assertStatus(200);

        $response->assertJsonCount(10);
    }

}

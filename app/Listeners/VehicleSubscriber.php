<?php

namespace App\Listeners;

use App\Events\VehicleCheckedIn;
use App\Events\VehicleCheckedOut;
use App\Models\Vehicle;
use Illuminate\Events\Dispatcher;

class VehicleSubscriber
{
    /**
     * Handle user login events.
     */
    public function handleVehicleCheckout(VehicleCheckedOut $event)
    {
        $vehicle = $event->vehicle;

        $vehicle->update([
            'status' => Vehicle::STATUS_CHECKED_OUT
        ]);
    }

    /**
     * Handle user logout events.
     */
    public function handleVehicleCheckin(VehicleCheckedIn $event)
    {
        $vehicle = $event->vehicle;

        $vehicle->update([
            'status' => Vehicle::STATUS_AVAILABLE
        ]);
    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param Dispatcher $events
     *
     * @return void
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(
            VehicleCheckedOut::class,
            [VehicleSubscriber::class, 'handleVehicleCheckout']
        );

        $events->listen(
            VehicleCheckedIn::class,
            [VehicleSubscriber::class, 'handleVehicleCheckin']
        );
    }
}

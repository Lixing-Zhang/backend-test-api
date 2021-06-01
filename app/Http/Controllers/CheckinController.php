<?php

namespace App\Http\Controllers;

use App\Events\VehicleCheckedIn;
use App\Events\VehicleCheckedOut;
use App\Http\Requests\StoreCheckinRequest;
use App\Http\Resources\CheckinResource;
use App\Models\Checkin;
use App\Models\Checkout;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class CheckinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCheckinRequest $request
     *
     * @return CheckinResource
     */
    public function store(StoreCheckinRequest $request)
    {
        $validated = $request->validated();
        $vehicle = Vehicle::find($validated['vehicle_id']);

        /** @var Checkin $checkin */
        $checkin = Checkin::make([
            'condition_of_return' => $validated['condition_of_return']
        ]);
        $checkin->checkout()->associate($vehicle->checkout);
        $checkin->checkin_at = now();
        $checkin->save();

        VehicleCheckedIn::dispatch($vehicle);

        return new CheckinResource($checkin);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int    $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

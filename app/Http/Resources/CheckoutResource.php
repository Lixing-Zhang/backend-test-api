<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CheckoutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'vehicle' => new VehicleResource($this->vehicle),
            'checkoutAt' => $this->checkout_at,
            'customerName' => $this->customer_name,
            'type' => $this->type
        ];
    }
}

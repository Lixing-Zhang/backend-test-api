<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CheckinResource extends JsonResource
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
            'checkout' => new CheckoutResource($this->checkout),
            'checkinAt' => $this->checkin_at,
            'conditionOfReturn' => $this->condition_of_return,
        ];
    }
}

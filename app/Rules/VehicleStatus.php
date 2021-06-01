<?php

namespace App\Rules;

use App\Models\Vehicle;
use Illuminate\Contracts\Validation\Rule;

class VehicleStatus implements Rule
{

    public $requiredStatus;

    public function __construct(string $requiredStatus)
    {
        $this->requiredStatus = $requiredStatus;
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $vehicle = Vehicle::find($value);

        if (!$vehicle) {
            return false;
        }

        return $vehicle->status == $this->requiredStatus;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The vehicle status must be ' . $this->requiredStatus;
    }
}

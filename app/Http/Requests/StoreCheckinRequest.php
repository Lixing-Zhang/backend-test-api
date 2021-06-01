<?php

namespace App\Http\Requests;

use App\Models\Vehicle;
use App\Rules\VehicleStatus;
use Illuminate\Foundation\Http\FormRequest;

class StoreCheckinRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'vehicle_id' => [
                'required',
                'exists:App\Models\Vehicle,id',
                new VehicleStatus(Vehicle::STATUS_CHECKED_OUT)
            ],
            'condition_of_return' => 'required|max:255'
        ];
    }
}

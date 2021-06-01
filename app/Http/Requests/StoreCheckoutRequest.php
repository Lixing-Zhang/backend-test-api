<?php

namespace App\Http\Requests;

use App\Models\Checkout;
use App\Models\Vehicle;
use App\Rules\VehicleStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCheckoutRequest extends FormRequest
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
                new VehicleStatus(Vehicle::STATUS_AVAILABLE)
            ],
            'type' => ['required', Rule::in(Checkout::TYPE_LOAN, Checkout::TYPE_TEST_DRIVE)],
            'customer_name' => 'required|string|max:255',
        ];
    }
}

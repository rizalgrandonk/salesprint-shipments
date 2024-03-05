<?php

namespace App\Http\Requests\Admin\Shipment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreShipment extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool {
        return Gate::allows('admin.shipment.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array {
        return [
            // 'awb' => ['required', Rule::unique('shipments', 'awb'), 'string'],
            'courier' => ['required', 'string'],
            'service' => ['required', 'string'],
            'status' => ['required', 'string'],
            'desc' => ['required', 'string'],
            'amount' => ['required', 'integer'],
            'weight' => ['required', 'integer'],
            'origin' => ['required', 'string'],
            'destination' => ['required', 'string'],
            'shipper' => ['required', 'string'],
            'receiver' => ['required', 'string'],

        ];
    }

    /**
     * Modify input data
     *
     * @return array
     */
    public function getSanitized(): array {
        $sanitized = $this->validated();

        //Add your code for manipulation with request data here

        return $sanitized;
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAmbulanceRequest extends FormRequest
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
        $ambulanceId = $this->ambulance;    
        return [
            'car_number' => 'required|string|max:255',
            'car_model' => 'required|string|max:255',
            'car_year_made' => 'required|integer|min:1900|max:' . date('Y'),
            'driver_license_number' => 'required|string|max:255',
            'driver_phone' => 'required|string|max:20', 
            'is_available' => 'boolean',
            'car_type' => 'required|integer',
            'driver_name' => 'required|unique:ambulance_translations,driver_name,' . $ambulanceId . ',ambulance_id',
            'notes' => 'nullable|string|max:500', 
        ];
    }

    public function messages()
    {
        return [
            'car_number.required' => trans('validation.required'),
            'car_model.required' => trans('validation.required'),
            'car_year_made.required' => trans('validation.required'),
            'car_year_made.numeric' => trans('validation.numeric'),
            'car_type.required' => trans('validation.required'),
            'driver_name.required' => trans('validation.required'),
            'driver_name.unique' => trans('validation.unique'),
            'driver_license_number.required' => trans('validation.required'),
            'driver_license_number.numeric' => trans('validation.numeric'),
            'driver_phone.required' => trans('validation.required'),
            'driver_phone.numeric' => trans('validation.numeric'),
        ];
    }
}

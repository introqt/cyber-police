<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderCrudRequest extends FormRequest
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
//            'client_id' => 'email|required',
//            'service_id' => 'string|required',
//            'worker_id' => 'alpha'
        ];
    }

    public function messages()
    {
        return [
            'client_id.required' => trans('validation.required'),
            'client_id.email' => trans('validation.email'),
            'service_id.required' => trans('validation.required'),
            'service_id.string' => trans('validation.string'),
            'worker_id.alpha' => trans('validation.alpha'),
        ];
    }
}

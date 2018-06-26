<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkerCrudRequest extends FormRequest
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
            'name' => 'alpha|required',
            'surname' => 'alpha|required',
            'salary' => 'integer|required|min:0'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('validation.required'),
            'name.alpha' => trans('validation.alpha'),
            'surname.required' => trans('validation.required'),
            'surname.alpha' => trans('validation.alpha'),
            'salary.required' => trans('validation.required'),
            'salary.alpha' => trans('validation.alpha'),
        ];
    }
}

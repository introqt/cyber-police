<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'email' => 'email|required',
            'service' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('validation.required'),
            'name.alpha' => trans('validation.alpha'),
            'email.required' => trans('validation.required'),
            'email.email' => trans('validation.email'),
            'service.required' => trans('validation.required')
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Ваше имя',
            'email' => 'Ваш email',
            'service' => 'Выберите услугу'
        ];
    }
}

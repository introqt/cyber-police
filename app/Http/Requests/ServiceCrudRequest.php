<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// Класс для работы с запросом пользователя
class ServiceCrudRequest extends FormRequest
{
    /**
     * Определяет, должен ли пользователь быть авторизированным для
     * отправки запроса
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Возвращает правила валидации формы ввода
     *
     * @return array
     */
    public function rules()
    {
        return [
            // для поля наименования услуги следующие правила:
            // 1, должен выглядеть как строка
            // 2. быть заполненным (не пустым)
            'service' => 'string|required',
            // правила для цены:
            // 1. цена должна быть числом
            // 2. обязательно заполнено
            // 3. минимальное значение - 0, чтобы предотварить попадание
            // отрицательных чисел в столбец Цена услуги
            'price' => 'integer|required|min:0'
        ];
    }

    // метод который хранит в себе тексты ошибок, которые
    // выводятся пользователю если он не соблюдает правила валидации
    public function messages()
    {
        return [
            // если нарушается правило alpha для поля service
            // то выводится текст ошибки, который хранится в
            // файлике validation.php
            'service.string' => trans('validation.string'),
            'service.required' => trans('validation.required'),
            'price.required' => trans('validation.required'),
            'price.integer' => trans('validation.integer'),
            'price.min' => trans('validation.min'),
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        switch ($this->getMethod())
        {
            case 'GET':
                return true;
            case 'POST':
            case 'PUT':
            case 'PATCH':
            case 'DELETE':
                return auth()->check();
            default:
                return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|unique:users,name',
        ];

        //Обрабатываем правила валидации для методов
        switch ($this->getMethod())
        {
            case 'DELETE':
                return [];
            default:
                return $rules;
        }
    }
}

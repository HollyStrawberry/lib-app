<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(Request $request): array
    {
        $rules = [
            'title' => 'required|string|unique:books,title',
            'type' => 'required|in:graphical,digital,printed',
        ];

        //Обрабатываем правила валидации для методов
        switch ($this->getMethod())
        {
            //case 'POST':
            case 'PUT':
                return [
                        'book_id' => 'required|integer|exists:books,id', //должен существовать
                        'title' => [
                            'required',
                            Rule::unique('books')->ignore($this->title, 'title') //должен быть уникальным, за исключением себя же
                        ]
                    ] + $rules; // и берем все остальные правила
            // case 'PATCH':
            case 'DELETE':
                return [
                    'book_id' => 'required|integer|exists:books,id'
                ];
            default:
                return $rules;
        }
    }

    public function messages()
    {
        return [
            'title.required' => 'Введите название книги',
            'title.exists' => 'Книга с таким названием уже существет',
        ];
    }

}

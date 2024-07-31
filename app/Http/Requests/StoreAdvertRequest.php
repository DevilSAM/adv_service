<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdvertRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'         => 'required|string|max:200|min:4',
            'description'   => 'required|string|max:1000',
            'price'         => 'required|numeric',
            'images'        => 'array|nullable|max:3',
            'images.*'      => 'url',
        ];
    }

    public function attributes()
    {
        return [
            'title'             => 'Название',
            'description'       => 'Описание',
            'price'             => 'Цена',
            'images'            => 'Ссылки на фото',
            'images.*'          => 'Ссылка на фото',
        ];
    }
}

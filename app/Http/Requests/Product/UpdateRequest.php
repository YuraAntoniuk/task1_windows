<?php

namespace App\Http\Requests\Product;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:50|regex:/^[a-zA-Zа-яА-ЯіїєґІЇЄҐ0-9\(\)\.\-\_\,\@]+$/',
            'description' => 'required|string',
            'price' => 'required|integer',
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'title.regex' => 'Title contains prohibited characters',
            'title.required' => 'Title must be filled',
            'title.max' => 'Title must be less than 50',
            'title.unique' => 'Title must be unique',
            'description.required' => 'Description must be filled',
            'price.required' => 'Description must be filled',
            'category_id.required' => 'Category must be selected',
            'subcategory_id.required' => 'Subcategory must be selected',
        ];
    }

}

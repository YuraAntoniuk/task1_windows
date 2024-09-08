<?php

namespace App\Http\Requests\Category;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
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
            '*.title' => 'required|unique:categories|max:30|string|regex:/^[a-zA-Zа-яА-ЯіїєґІЇЄҐ0-9\(\)\.\-\_\,\@]+$/',
            '*.parent_id' => 'nullable|integer',
        ];
    }
    public function messages()
    {
        return [
            '*.title.regex' => 'Title contains prohibited characters',
            '*.title.required' => 'Title must be filled',
            '*.title.unique' => 'Title must be unique',
            '*.title.max' => 'Title must be less than 30 symbols',
            '*.title.string' => 'Title must be string',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ],422),
        );
    }
}

<?php

namespace App\Http\Requests\Publication;

use Illuminate\Foundation\Http\FormRequest;

class PublicationStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'price' => 'required|decimal:8,2',
            'title' => 'required|string|max:150',
            'ubication' => 'string|max:250',
            'description' => 'string|nullable',
            'room_count' => 'required|integer|min:0',
            'bathroom_count' => 'required|integer|min:0',
            'pets' => 'required|boolean',
            'numbre_people' => 'required|integer|min:1',
            'rent_type' => 'required|integer',
        ];
    }
}

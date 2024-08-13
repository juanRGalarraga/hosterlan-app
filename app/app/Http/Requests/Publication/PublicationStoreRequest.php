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
            'title' => 'required|string|max:150',
            'price' => 'required|decimal:8,2',
            'rent_type' => 'string',
            'room_count' => 'integer',
            'bathroom_count' => 'integer',
            'numbre_people' => 'required|integer',
            'ubication' => 'string|max:250',
            'description' => 'string|nullable',
            'pets' => 'boolean|nullable',
        ];
    }
}

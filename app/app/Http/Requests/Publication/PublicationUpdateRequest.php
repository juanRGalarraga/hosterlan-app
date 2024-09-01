<?php

namespace App\Http\Requests\Publication;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ValidatorRequest;

class PublicationUpdateRequest extends FormRequest
{

    use ValidatorRequest;

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
            'price' => 'required',
            'title' => 'required|string|max:150',
            'ubication' => 'string|max:250',
            'description' => 'string|nullable',
            'available_since' => 'required|date',
            'available_to' => 'required|after_or_equal:available_since',
            'room_count' => 'integer|min:0',
            'pets' => 'boolean',
            'numbre_people' => 'integer|min:1',
        ];
    }
}

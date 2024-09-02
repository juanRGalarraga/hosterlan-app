<?php

namespace App\Http\Requests\Publication;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ValidatorRequest;
class PublicationStoreRequest extends FormRequest
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
            'to.*' => 'required|date',
            'since.*' => 'required|date'
        ];
    }
}

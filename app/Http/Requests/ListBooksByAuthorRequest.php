<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListBooksByAuthorRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $this->merge([
            "authorId" => $this->route("id"),
        ]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "authorId" => ["uuid", "required"],
        ];
    }
}

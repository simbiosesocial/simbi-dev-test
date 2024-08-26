<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinalizeLoanRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $this->merge([
            "loanId" => $this->route("id"),
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
            "loanId" => ["uuid", "required"],
        ];
    }
}

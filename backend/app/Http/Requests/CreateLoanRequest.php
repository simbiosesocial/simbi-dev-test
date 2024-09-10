<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLoanRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "bookId" => ["string", "required"],
            "loanDate" => ["date", "nullable"],
            "returnDate" => ["date", "nullable"],
        ];
    }
}

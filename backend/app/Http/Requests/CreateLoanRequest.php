<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLoanRequest extends FormRequest
{
    public function rules()
    {
        return [
            "book_id" => ["string"],
            "loan_date" => ["string", "required"],
            "return_date" => ["string", "required"],
        ];
    }
}

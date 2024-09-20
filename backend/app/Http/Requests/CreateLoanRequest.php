<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLoanRequest extends FormRequest
{
    public function rules()
    {
        return [
            "book_id" => ["string", "required"],
            "start_loan_date" => ["string", "required"],
            "end_loan_date" => ["string", "required"],
        ];
    }
}
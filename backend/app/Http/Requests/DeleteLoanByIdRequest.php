<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteLoanByIdRequest extends FormRequest
{
    public function rules()
    {
        return [
            "loan_id" => ["string", "required"],
        ];
    }
}
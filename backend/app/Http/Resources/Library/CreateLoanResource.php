<?php

namespace App\Http\Resources\Library;

use App\Core\Domain\Library\Entities\Loan;
use Illuminate\Http\Resources\Json\JsonResource;

final class CreateLoanResource extends JsonResource
{
    public function __construct(private Loan $loan)
    {
    }

    public function toArray($request = null)
    {
        return [
            'id' => $this->loan->id,
            'loaned_book' => (new CreateBookResource($this->loan->book))->resolve(),
            'loan_date' => $this->loan->getFormatedLoanDate(),
            'return_date' => $this->loan->getFormatedLoanDate(),
        ];
    }
}

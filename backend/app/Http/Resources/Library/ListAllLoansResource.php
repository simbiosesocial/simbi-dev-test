<?php

namespace App\Http\Resources\Library;

use App\Core\Domain\Library\Entities\Loan;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListAllLoansResource extends JsonResource
{
    /**
     * @param Loan $loan
     */
    public function __construct(private Loan $loan)
    {
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request = null)
    {
        return [
            'id' => $this->loan->id,
            'loaned_book' => (new CreateBookResource($this->loan->book))->resolve(),
            'start_loan_date' => $this->loan->getFormatedStartLoanDate(),
            'end_loan_date' => $this->loan->getFormatedStartLoanDate(),
        ];
    }
}

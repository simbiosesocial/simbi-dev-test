<?php

namespace App\Http\Resources\Library;

use App\Core\Domain\Library\Entities\Loan;
use DateTimeInterface;
use Illuminate\Http\Resources\Json\JsonResource;

final class RenewLoanResource extends JsonResource
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
            'book' => (new BookDetailsResource($this->loan->book))->resolve(),
            'status' => $this->loan->status,
            'returnDate' => $this->loan->returnDate->format(DateTimeInterface::ATOM),
            'renewalCount' => $this->loan->renewalCount,
            'lastRenewedAt' => $this->loan->lastRenewedAt->format(DateTimeInterface::ATOM),
        ];
    }
}

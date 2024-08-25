<?php

namespace App\Http\Resources\Library;

use App\Core\Domain\Library\Entities\Loan;
use Illuminate\Http\Resources\Json\JsonResource;

final class DeleteLoanByIdResource extends JsonResource
{
    /**
     * @param string $loan
     */
    public function __construct(private string $loanId)
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
            'id' => $this->loanId,
        ];
    }
}

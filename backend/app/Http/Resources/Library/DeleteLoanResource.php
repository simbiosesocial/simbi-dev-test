<?php

namespace App\Http\Resources\Library;

use App\Core\Domain\Library\Entities\Loan;
use Illuminate\Http\Resources\Json\JsonResource;

final class DeleteLoanResource extends JsonResource
{
    public function __construct(private string $loanId)
    {
    }

    public function toArray($request = null)
    {
        return [
            'id' => $this->loanId,
        ];
    }
}

<?php

namespace App\Core\Domain\Library\Ports\UseCases\RenewLoan;

use App\Core\Common\Ports\ViewModel;

interface RenewLoanUseCase
{
    public function execute(RenewLoanRequestModel $requestMode): ViewModel;
}

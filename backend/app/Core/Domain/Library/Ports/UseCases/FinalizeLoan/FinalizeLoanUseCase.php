<?php

namespace App\Core\Domain\Library\Ports\UseCases\FinalizeLoan;

use App\Core\Common\Ports\ViewModel;

interface FinalizeLoanUseCase
{
    public function execute(FinalizeLoanRequestModel $requestMode): ViewModel;
}

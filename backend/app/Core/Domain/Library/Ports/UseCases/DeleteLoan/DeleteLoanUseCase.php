<?php

namespace App\Core\Domain\Library\Ports\UseCases\DeleteLoan;

use App\Core\Common\Ports\ViewModel;

interface DeleteLoanUseCase
{
    public function execute(DeleteLoanRequestModel $requestModel): ViewModel;
}

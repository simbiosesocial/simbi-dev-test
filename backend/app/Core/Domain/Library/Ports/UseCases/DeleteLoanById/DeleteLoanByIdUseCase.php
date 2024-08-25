<?php

namespace App\Core\Domain\Library\Ports\UseCases\DeleteLoanById;

use App\Core\Common\Ports\ViewModel;

interface DeleteLoanByIdUseCase
{
    public function execute(DeleteLoanByIdRequestModel $requestModel): ViewModel;
}

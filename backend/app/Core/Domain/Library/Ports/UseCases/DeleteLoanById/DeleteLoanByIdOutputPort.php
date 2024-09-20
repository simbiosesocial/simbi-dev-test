<?php

namespace App\Core\Domain\Library\Ports\UseCases\DeleteLoanById;

use App\Core\Common\Ports\ViewModel;

interface DeleteLoanByIdOutputPort
{
    public function present(DeleteLoanByIdResponseModel $responseModel): ViewModel;
}
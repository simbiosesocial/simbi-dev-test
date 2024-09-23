<?php

namespace App\Core\Domain\Library\Ports\UseCases\DeleteLoan;

use App\Core\Common\Ports\ViewModel;

interface DeleteLoanOutputPort
{
    public function present(DeleteLoanResponseModel $responseModel): ViewModel;
}

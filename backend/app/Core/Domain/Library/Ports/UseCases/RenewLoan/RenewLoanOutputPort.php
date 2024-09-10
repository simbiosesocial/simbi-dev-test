<?php

namespace App\Core\Domain\Library\Ports\UseCases\RenewLoan;

use App\Core\Common\Ports\ViewModel;

interface RenewLoanOutputPort
{
    /**
     * @param RenewLoanResponseModel $responseModel
     *
     * @return ViewModel
     */
    public function present(RenewLoanResponseModel $responseModel): ViewModel;
}

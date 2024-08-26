<?php

namespace App\Core\Domain\Library\Ports\UseCases\FinalizeLoan;

use App\Core\Common\Ports\ViewModel;

interface FinalizeLoanOutputPort
{
    /**
     * @param FinalizeLoanResponseModel $responseModel
     *
     * @return ViewModel
     */
    public function present(FinalizeLoanResponseModel $responseModel): ViewModel;
}

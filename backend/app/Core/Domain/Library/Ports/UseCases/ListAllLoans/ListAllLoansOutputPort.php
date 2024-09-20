<?php

namespace App\Core\Domain\Library\Ports\UseCases\ListAllLoans;

use App\Core\Common\Ports\ViewModel;

interface ListAllLoansOutputPort
{
    public function present(ListAllLoansResponseModel $responseModel): ViewModel;
}
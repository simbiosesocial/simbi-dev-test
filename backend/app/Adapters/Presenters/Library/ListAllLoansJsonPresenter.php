<?php

namespace App\Adapters\Presenters\Library;

use App\Adapters\ViewModel\JsonResourceViewModel;
use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Ports\UseCases\ListAllLoans\{ListAllLoansOutputPort, ListAllLoansResponseModel};
use App\Http\Resources\Library\ListAllLoansResource;

final class ListAllLoansJsonPresenter implements ListAllLoansOutputPort
{
    public function present(ListAllLoansResponseModel $responseModel): ViewModel
    {
        return new JsonResourceViewModel(ListAllLoansResource::collection($responseModel->getLoans()));
    }
}

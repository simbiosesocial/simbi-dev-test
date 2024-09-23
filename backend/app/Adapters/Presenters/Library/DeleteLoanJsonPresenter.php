<?php

namespace App\Adapters\Presenters\Library;

use App\Adapters\ViewModel\JsonResourceViewModel;
use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Ports\UseCases\DeleteLoan\{DeleteLoanOutputPort, DeleteLoanResponseModel};
use App\Http\Resources\Library\DeleteLoanResource;

final class DeleteLoanJsonPresenter implements DeleteLoanOutputPort
{
    public function present(DeleteLoanResponseModel $responseModel): ViewModel
    {
        return new JsonResourceViewModel(new DeleteLoanResource($responseModel->getLoanId()));
    }
}
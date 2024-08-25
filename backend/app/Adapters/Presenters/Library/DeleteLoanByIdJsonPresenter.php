<?php

namespace App\Adapters\Presenters\Library;

use App\Adapters\ViewModel\JsonResourceViewModel;
use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Ports\UseCases\DeleteLoanById\{DeleteLoanByIdOutputPort, DeleteLoanByIdResponseModel};
use App\Http\Resources\Library\DeleteLoanByIdResource;

final class DeleteLoanByIdJsonPresenter implements DeleteLoanByIdOutputPort
{
    /**
     * @param DeleteLoanByIdResponseModel $responseModel
     *
     * @return ViewModel
     */
    public function present(DeleteLoanByIdResponseModel $responseModel): ViewModel
    {
        return new JsonResourceViewModel(new DeleteLoanByIdResource($responseModel->getLoanId()));
    }
}

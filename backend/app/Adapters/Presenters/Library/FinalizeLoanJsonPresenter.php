<?php

namespace App\Adapters\Presenters\Library;

use App\Adapters\ViewModel\JsonResourceViewModel;
use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Ports\UseCases\FinalizeLoan\{FinalizeLoanOutputPort, FinalizeLoanResponseModel};
use App\Http\Resources\Library\FinalizeLoanResource;

final class FinalizeLoanJsonPresenter implements FinalizeLoanOutputPort
{
    /**
     * @param FinalizeLoanResponseModel $responseModel
     *
     * @return ViewModel
     */
    public function present(FinalizeLoanResponseModel $responseModel): ViewModel
    {
        return new JsonResourceViewModel(new FinalizeLoanResource($responseModel->getLoan()));
    }
}

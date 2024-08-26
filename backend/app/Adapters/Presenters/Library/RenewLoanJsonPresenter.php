<?php

namespace App\Adapters\Presenters\Library;

use App\Adapters\ViewModel\JsonResourceViewModel;
use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Ports\UseCases\RenewLoan\{RenewLoanOutputPort, RenewLoanResponseModel};
use App\Http\Resources\Library\RenewLoanResource;

final class RenewLoanJsonPresenter implements RenewLoanOutputPort
{
    /**
     * @param RenewLoanResponseModel $responseModel
     *
     * @return ViewModel
     */
    public function present(RenewLoanResponseModel $responseModel): ViewModel
    {
        return new JsonResourceViewModel(new RenewLoanResource($responseModel->getLoan()));
    }
}

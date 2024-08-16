<?php

namespace App\Adapters\Presenters\Library;

use App\Adapters\ViewModel\JsonResourceViewModel;
use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Ports\UseCases\CreateBook\{CreateBookOutputPort, CreateBookResponseModel};
use App\Http\Resources\Library\CreateBookResource;

final class CreateBookJsonPresenter implements CreateBookOutputPort
{
    /**
     * @param CreateBookResponseModel $responseModel
     *
     * @return ViewModel
     */
    public function present(CreateBookResponseModel $responseModel): ViewModel
    {
        return new JsonResourceViewModel(new CreateBookResource($responseModel->getBook()));
    }
}

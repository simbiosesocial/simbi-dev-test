<?php

namespace App\Adapters\Presenters\Library;

use App\Adapters\ViewModel\JsonResourceViewModel;
use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Ports\UseCases\ListBooksByAuthor\{
    ListBooksByAuthorOutputPort,
    ListBooksByAuthorResponseModel,
};
use App\Http\Resources\Library\ListBooksByAuthorResource;

final class ListBooksByAuthorJsonPresenter implements ListBooksByAuthorOutputPort
{
    /**
     * @param ListBooksByAuthorResponseModel $responseModel
     *
     * @return ViewModel
     */
    public function present(ListBooksByAuthorResponseModel $responseModel): ViewModel
    {
        return new JsonResourceViewModel(ListBooksByAuthorResource::collection($responseModel->getBooks()));
    }
}

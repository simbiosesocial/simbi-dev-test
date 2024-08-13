<?php

namespace App\Adapters\Presenters\Library;

use App\Adapters\ViewModel\JsonResourceViewModel;
use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Ports\UseCases\ListAllBooks\{ListAllBooksOutputPort, ListAllBooksResponseModel};
use App\Http\Resources\Library\ListAllBooksResource;

final class ListAllBooksJsonPresenter implements ListAllBooksOutputPort
{
    /**
     * @param ListAllBooksResponseModel $responseModel
     *
     * @return ViewModel
     */
    public function present(ListAllBooksResponseModel $responseModel): ViewModel
    {
        return new JsonResourceViewModel(ListAllBooksResource::collection($responseModel->getBooks()));
    }
}

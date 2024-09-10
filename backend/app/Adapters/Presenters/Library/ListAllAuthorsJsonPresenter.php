<?php

namespace App\Adapters\Presenters\Library;

use App\Adapters\ViewModel\JsonResourceViewModel;
use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Ports\UseCases\ListAllAuthors\{ListAllAuthorsOutputPort, ListAllAuthorsResponseModel};
use App\Http\Resources\Library\ListAllAuthorsResource;

final class ListAllAuthorsJsonPresenter implements ListAllAuthorsOutputPort
{
    /**
     * @param ListAllAuthorsResponseModel $responseModel
     *
     * @return ViewModel
     */
    public function present(ListAllAuthorsResponseModel $responseModel): ViewModel
    {
        return new JsonResourceViewModel(ListAllAuthorsResource::collection($responseModel->getAuthors()));
    }
}

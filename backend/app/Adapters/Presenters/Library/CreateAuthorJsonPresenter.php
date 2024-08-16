<?php

namespace App\Adapters\Presenters\Library;

use App\Adapters\ViewModel\JsonResourceViewModel;
use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Ports\UseCases\CreateAuthor\{CreateAuthorOutputPort, CreateAuthorResponseModel};
use App\Http\Resources\Library\CreateAuthorResource;

final class CreateAuthorJsonPresenter implements CreateAuthorOutputPort
{
    /**
     * @param CreateAuthorResponseModel $responseModel
     *
     * @return ViewModel
     */
    public function present(CreateAuthorResponseModel $responseModel): ViewModel
    {
        return new JsonResourceViewModel(new CreateAuthorResource($responseModel->getAuthor()));
    }
}

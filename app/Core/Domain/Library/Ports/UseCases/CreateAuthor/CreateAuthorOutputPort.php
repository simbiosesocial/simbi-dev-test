<?php

namespace App\Core\Domain\Library\Ports\UseCases\CreateAuthor;

use App\Core\Common\Ports\ViewModel;

interface CreateAuthorOutputPort
{
    /**
     * @return ViewModel
     */
    public function present(CreateAuthorResponseModel $responseModel): ViewModel;
}

<?php

namespace App\Core\Domain\Library\Ports\UseCases\CreateAuthor;

use App\Core\Common\Ports\ViewModel;

interface CreateAuthorUseCase
{
    public function execute(CreateAuthorRequestModel $requestModel): ViewModel;
}

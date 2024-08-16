<?php

namespace App\Core\Domain\Library\Ports\UseCases\ListBooksByAuthor;

use App\Core\Common\Ports\ViewModel;

interface ListBooksByAuthorUseCase
{
    public function execute(ListBooksByAuthorRequestModel $requestModel): ViewModel;
}

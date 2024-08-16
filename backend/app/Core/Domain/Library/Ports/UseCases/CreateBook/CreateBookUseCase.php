<?php

namespace App\Core\Domain\Library\Ports\UseCases\CreateBook;

use App\Core\Common\Ports\ViewModel;

interface CreateBookUseCase
{
    public function execute(CreateBookRequestModel $requestModel): ViewModel;
}

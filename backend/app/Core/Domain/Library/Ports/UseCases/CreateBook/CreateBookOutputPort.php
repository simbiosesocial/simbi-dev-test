<?php

namespace App\Core\Domain\Library\Ports\UseCases\CreateBook;

use App\Core\Common\Ports\ViewModel;

interface CreateBookOutputPort
{
    public function present(CreateBookResponseModel $responseModel): ViewModel;
}

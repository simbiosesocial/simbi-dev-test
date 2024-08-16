<?php

namespace App\Core\Domain\Library\Ports\UseCases\ListBooksByAuthor;

use App\Core\Common\Ports\ViewModel;

interface ListBooksByAuthorOutputPort
{
    /**
     * @param ListBooksByAuthorResponseModel $responseModel
     *
     * @return ViewModel
     */
    public function present(ListBooksByAuthorResponseModel $responseModel): ViewModel;
}

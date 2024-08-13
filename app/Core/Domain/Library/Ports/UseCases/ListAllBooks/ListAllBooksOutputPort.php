<?php

namespace App\Core\Domain\Library\Ports\UseCases\ListAllBooks;

use App\Core\Common\Ports\ViewModel;

interface ListAllBooksOutputPort
{
    /**
     * @param ListAllBooksResponseModel $responseModel
     *
     * @return ViewModel
     */
    public function present(ListAllBooksResponseModel $responseModel): ViewModel;
}

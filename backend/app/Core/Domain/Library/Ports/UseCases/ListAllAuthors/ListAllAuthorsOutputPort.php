<?php

namespace App\Core\Domain\Library\Ports\UseCases\ListAllAuthors;

use App\Core\Common\Ports\ViewModel;

interface ListAllAuthorsOutputPort
{
    /**
     * @param ListAllAuthorsResponseModel $responseModel
     *
     * @return ViewModel
     */
    public function present(ListAllAuthorsResponseModel $responseModel): ViewModel;
}

<?php

namespace App\Core\Domain\Library\Ports\UseCases\ListAllBooks;

use App\Core\Common\Ports\ViewModel;

interface ListAllBooksUseCase
{
    public function execute(): ViewModel;
}

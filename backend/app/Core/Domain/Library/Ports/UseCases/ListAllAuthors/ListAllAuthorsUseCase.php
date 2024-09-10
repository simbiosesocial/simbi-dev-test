<?php

namespace App\Core\Domain\Library\Ports\UseCases\ListAllAuthors;

use App\Core\Common\Ports\ViewModel;

interface ListAllAuthorsUseCase
{
    public function execute(): ViewModel;
}

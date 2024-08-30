<?php

namespace App\Core\Services\Library;

use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Ports\Persistence\AuthorRepository;
use App\Core\Domain\Library\Ports\UseCases\ListAllAuthors\{
    ListAllAuthorsOutputPort,
    ListAllAuthorsResponseModel,
    ListAllAuthorsUseCase,
};

final class ListAllAuthorsService implements ListAllAuthorsUseCase
{
    /**
     * @param ListAllAuthorsOutputPort $output
     * @param AuthorRepository $bookRepository
     */
    public function __construct(private ListAllAuthorsOutputPort $output, private AuthorRepository $bookRepository)
    {
    }

    public function execute(): ViewModel
    {
        $books = $this->bookRepository->getAll();
        return $this->output->present(new ListAllAuthorsResponseModel($books));
    }
}

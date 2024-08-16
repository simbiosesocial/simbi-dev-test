<?php

namespace App\Core\Services\Library;

use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Ports\Persistence\BookRepository;
use App\Core\Domain\Library\Ports\UseCases\ListAllBooks\{
    ListAllBooksOutputPort,
    ListAllBooksResponseModel,
    ListAllBooksUseCase,
};

final class ListAllBooksService implements ListAllBooksUseCase
{
    /**
     * @param ListAllBooksOutputPort $output
     * @param BookRepository $bookRepository
     */
    public function __construct(private ListAllBooksOutputPort $output, private BookRepository $bookRepository)
    {
    }

    public function execute(): ViewModel
    {
        $books = $this->bookRepository->getAll();
        return $this->output->present(new ListAllBooksResponseModel($books));
    }
}

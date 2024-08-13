<?php

namespace App\Core\Services\Library;

use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Exceptions\AuthorIdIsRequired;
use App\Core\Domain\Library\Ports\Persistence\BookRepository;
use App\Core\Domain\Library\Ports\UseCases\ListBooksByAuthor\{
    ListBooksByAuthorOutputPort,
    ListBooksByAuthorRequestModel,
    ListBooksByAuthorResponseModel,
    ListBooksByAuthorUseCase,
};

final class ListBooksByAuthorService implements ListBooksByAuthorUseCase
{
    /**
     * @param ListBooksByAuthorOutputPort $output
     * @param BookRepository $bookRepository
     */
    public function __construct(private ListBooksByAuthorOutputPort $output, private BookRepository $bookRepository)
    {
    }

    /**
     * @param ListBooksByAuthorRequestModel $requestModel
     *
     * @return ViewModel
     */
    public function execute(ListBooksByAuthorRequestModel $requestModel): ViewModel
    {
        $this->validate($requestModel);

        $books = $this->bookRepository->getBooksByAuthorId($requestModel->getAuthorId());

        return $this->output->present(new ListBooksByAuthorResponseModel($books));
    }

    /**
     * @param ListBooksByAuthorRequestModel $requestModel
     *
     * @return void
     */
    private function validate(ListBooksByAuthorRequestModel $requestModel): void
    {
        if (empty($requestModel->getAuthorId())) {
            throw new AuthorIdIsRequired();
        }
    }
}

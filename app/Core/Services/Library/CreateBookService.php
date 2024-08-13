<?php

namespace App\Core\Services\Library;

use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Entities\Book;
use App\Core\Domain\Library\Exceptions\{BookMustHaveAPublisher, BookMustHaveATitle, BookMustHaveAnAuthor};
use App\Core\Domain\Library\Ports\Persistence\BookRepository;
use App\Core\Domain\Library\Ports\UseCases\CreateBook\{
    CreateBookOutputPort,
    CreateBookRequestModel,
    CreateBookResponseModel,
    CreateBookUseCase,
};

final class CreateBookService implements CreateBookUseCase
{
    /**
     * @param CreateBookOutputPort $output
     */
    public function __construct(private CreateBookOutputPort $output, private BookRepository $bookRepository)
    {
    }

    /**
     * @param CreateBookRequestModel $requestModel
     *
     * @return ViewModel
     */
    public function execute(CreateBookRequestModel $requestModel): ViewModel
    {
        $this->validate($requestModel);

        $book = $this->bookRepository->create(
            new Book(
                title: $requestModel->getTitle(),
                publisher: $requestModel->getPublisher(),
                authorId: $requestModel->getAuthorId(),
            ),
        );

        return $this->output->present(new CreateBookResponseModel($book));
    }

    /**
     * @param CreateBookRequestModel $requestModel
     *
     * @return void
     */
    private function validate(CreateBookRequestModel $requestModel): void
    {
        if (empty($requestModel->getTitle())) {
            throw new BookMustHaveATitle();
        }

        if (empty($requestModel->getPublisher())) {
            throw new BookMustHaveAPublisher();
        }

        if (empty($requestModel->getAuthorId())) {
            throw new BookMustHaveAnAuthor();
        }
    }
}

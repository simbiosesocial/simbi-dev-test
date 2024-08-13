<?php

namespace App\Core\Services\Library;

use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Entities\Author;
use App\Core\Domain\Library\Exceptions\InvalidAuthorName;
use App\Core\Domain\Library\Ports\Persistence\AuthorRepository;
use App\Core\Domain\Library\Ports\UseCases\CreateAuthor\{
    CreateAuthorOutputPort,
    CreateAuthorRequestModel,
    CreateAuthorResponseModel,
    CreateAuthorUseCase,
};
use App\Core\Domain\Library\ValueObjects\AuthorName;

final class CreateAuthorService implements CreateAuthorUseCase
{
    /**
     * @param CreateAuthorOutputPort $output
     * @param AuthorRepository $authorRepository
     */
    public function __construct(private CreateAuthorOutputPort $output, private AuthorRepository $authorRepository)
    {
    }

    /**
     * @param CreateAuthorRequestModel $requestModel
     *
     * @return ViewModel
     */
    public function execute(CreateAuthorRequestModel $requestModel): ViewModel
    {
        $this->validate($requestModel);

        $authorName = new AuthorName($requestModel->getFirstName(), $requestModel->getLastName());
        $author = $this->authorRepository->create(new Author(name: $authorName));

        return $this->output->present(new CreateAuthorResponseModel($author));
    }

    /**
     * @param CreateAuthorRequestModel $requestModel
     *
     * @return void
     */
    private function validate(CreateAuthorRequestModel $requestModel): void
    {
        if (empty($requestModel->getFirstName())) {
            throw new InvalidAuthorName();
        }

        if (empty($requestModel->getLastName())) {
            throw new InvalidAuthorName();
        }
    }
}

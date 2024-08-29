<?php

namespace App\Core\Services\Library;

use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Entities\Loan;
use App\Core\Domain\Library\Exceptions\BookIsNotAvailable;
use App\Core\Domain\Library\Exceptions\BookNotFound;
use App\Core\Domain\Library\Exceptions\LoanMustHaveABook;
use App\Core\Domain\Library\Ports\Persistence\BookRepository;
use App\Core\Domain\Library\Ports\Persistence\LoanRepository;
use App\Core\Domain\Library\Ports\UseCases\CreateLoan\{
    CreateLoanOutputPort,
    CreateLoanRequestModel,
    CreateLoanResponseModel,
    CreateLoanUseCase,
};
use DateTime;

final class CreateLoanService implements CreateLoanUseCase
{
    /**
     * @var ?DateTime $loanDate
     */
    private ?DateTime $loanDate;
    /**
     * @var ?DateTime $returnDate
     */
    private ?DateTime $returnDate;

    /**
     * @param CreateLoanOutputPort $output
     * @param LoanRepository $loanRepository
     */
    public function __construct(
        private CreateLoanOutputPort $output,
        private LoanRepository $loanRepository,
        private BookRepository $bookRepository
        )
    {
        $this->loanDate = null;
        $this->returnDate = null;
    }
    /**
     * @param CreateLoanRequestModel $requestModel
     *
     * @return ViewModel
     */
    public function execute(CreateLoanRequestModel $requestModel): ViewModel
    {
        $bookId = $requestModel->getBookId();
        $this->validate($bookId);

        $this->checkLoanDate($requestModel);

        $this->checkReturnDate($requestModel);

        $loan = $this->loanRepository->create(new Loan(
            bookId: $bookId,
            loanDate: $this->loanDate,
            returnDate: $this->returnDate,
        ));

        $this->bookRepository->setAvailable($bookId, false);

        return $this->output->present(new CreateLoanResponseModel($loan));
    }

    /**
     * @param ?string $bookId
     *
     * @return void
     */
    private function validate(?string $bookId): void
    {
        if (empty($bookId)) {
            throw new LoanMustHaveABook();
        }

        $book = $this->bookRepository->findById($bookId);
        if (!$book) {
            throw new BookNotFound();
        }
        if (!$book->isAvailable) {
            throw new BookIsNotAvailable();
        };
    }

    /**
     * Check if the loan date exists; if not, set it to the current date.
     *
     * @param CreateLoanRequestModel $requestModel
     *
     * @return void
     */
    private function checkLoanDate(CreateLoanRequestModel $requestModel): void
    {
        if (empty($requestModel->getLoanDate())) {
            $now = new DateTime();
            $this->loanDate = $now;
        } else {
            $this->loanDate = new DateTime($requestModel->getLoanDate());
        }
    }

    /**
     * Check if the return date exists; if not, set it to the default value.
     *
     * The default loan period is 7 days.
     *
     * @param CreateLoanRequestModel $requestModel
     *
     * @return void
     */
    private function checkReturnDate(CreateLoanRequestModel $requestModel): void
    {
        if (empty($requestModel->getReturnDate())) {
            $this->returnDate = (clone $this->loanDate)->modify("+7 days");
        } else {
            $this->returnDate = new DateTime($requestModel->getReturnDate());
        }
    }
}

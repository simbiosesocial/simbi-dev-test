<?php

namespace App\Core\Services\Library;

use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Entities\Loan;
use App\Core\Domain\Library\Exceptions\{LoanMustHaveBookId, LoanMustHaveDates, LoanMustHaveValidDate};
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
    public function __construct(private CreateLoanOutputPort $output, private BookRepository $bookRepository, private LoanRepository $loanRepository)
    {
    }

    public function execute(CreateLoanRequestModel $requestModel): ViewModel
    {
        $this->validate($requestModel);

        $book = $this->bookRepository->getBookById($requestModel->getBookId());

        $datetimeFormat = 'Y-m-d';
        $startLoanDate = Datetime::createFromFormat($datetimeFormat, $requestModel->getLoanDate());
        $endLoanDate = Datetime::createFromFormat($datetimeFormat, $requestModel->getReturnDate());

        $loan = new Loan(
            null,
            $book,
            $startLoanDate,
            $endLoanDate,
        );

        $loan = $this->loanRepository->createOne($loan);

        return $this->output->present(new CreateLoanResponseModel($loan));
    }

    private function validate(CreateLoanRequestModel $requestModel): void
    {
        if (empty($requestModel->getBookId())) {
            throw new LoanMustHaveBookId();
        }

        $hasNoLoanStartDate = empty($requestModel->getLoanDate());
        $hasNoLoanEndDate = empty($requestModel->getReturnDate());
        if ($hasNoLoanStartDate || $hasNoLoanEndDate) {
            throw new LoanMustHaveValidDate();
        }

        $hasLoanStartDateRightFormat = preg_match('/^\d{4}-\d{2}-\d{2}$/', $requestModel->getLoanDate());
        if (!$hasLoanStartDateRightFormat) {
            throw new LoanMustHaveValidDate();
        }

        $hasLoanEndDateRightFormat = preg_match('/^\d{4}-\d{2}-\d{2}$/', $requestModel->getReturnDate());
        if (!$hasLoanEndDateRightFormat) {
            throw new LoanMustHaveValidDate();
        }
    }
}

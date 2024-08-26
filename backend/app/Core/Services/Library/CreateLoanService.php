<?php

namespace App\Core\Services\Library;

use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Entities\Loan;
use App\Core\Domain\Library\Exceptions\LoanMustHaveABook;
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
    public function __construct(private CreateLoanOutputPort $output, private LoanRepository $loanRepository)
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
        $this->validate($requestModel);

        $this->checkLoanDate($requestModel);

        $this->checkReturnDate($requestModel);

        $loan = $this->loanRepository->create(new Loan(
            bookId: $requestModel->getBookId(),
            loanDate: $this->loanDate,
            returnDate: $this->returnDate,
        ));

        return $this->output->present(new CreateLoanResponseModel($loan));
    }

    /**
     * @param CreateLoanRequestModel $requestModel
     *
     * @return void
     */
    private function validate(CreateLoanRequestModel $requestModel): void
    {
        if (empty($requestModel->getBookId())) {
            throw new LoanMustHaveABook();
        }
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
